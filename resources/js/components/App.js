import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Footer from './Footer';

class App extends Component {
    constructor() {
        super();
        this.state = {data: [], coor: [], beaches: [], most_recent: [], map_loading: false, city_name: "Bangkok"};
        
        this.infowindow = null;
        this.autoComplete = this.autoComplete.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleOnClick = this.handleOnClick.bind(this);
        this.handleReload = this.handleReload.bind(this);
    }

    componentDidMount() {
        const link= "https://maps.googleapis.com/maps/api/js?key=AIzaSyDjoHelMpE5RdVWUPQyDNknQpyxRQGBQpg&libraries=places&v=3.exp";
        const sc = document.createElement("script");
        sc.setAttribute("src", link);
        sc.setAttribute("type", "text/javascript");
        document.head.appendChild(sc);
        
        this.fetchTweets(this.state.city_name);
        this.handleOnClick();
    }

    fetchTweets(city_name) {
        this.setState({ map_loading: true }, () => {
                axios.get('/api/twitter',{
                    params: {
                        city: city_name
                    }
                }
                ).then(response => {
                this.setState({
                    data: response.data.data,
                    coor: response.data.coor,
                    beaches: response.data.beaches,
                    map_loading: false
                });
                
                $('#banner').html("<h1>Tweets about "+city_name+"</h1>");
                google.maps.event.addDomListener(window, 'load', this.initialize());
            });
        });
    }
    
    initialize() {
        const mapOptions = {
            zoom: 12,
            center: new google.maps.LatLng(this.state.coor.latitud, this.state.coor.longitud)
        };
         
        $('#map-canvas').css({ width: $(window).width(), height: $(window).height() * .7 });
        const map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        
        this.autoComplete();
        this.setMarkers(map, this.state.beaches);
    }

    setMarkers(map, locations) {
        const data = this.state.data;
        const tweet = []; 
        const tweet_date = [];
        const shape = {
            coord: [1, 1, 1, 100,100, 100, 100 , 1],//[beach.shape_coord],
            type:  'poly' //beach.shape_type
        };
        for (var i = 0; i < data.length; i++) {
            tweet_date.push(data[i]["fetch"]);
            tweet.push(data[i]["tweet"]);
        
            const beach = locations[i];
            const myLatLng = new google.maps.LatLng(beach.latitud, beach.longitud);
            const marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: {
                    url: data[i]['image_url'],
                    size: new google.maps.Size(100, 100),
                    origin: new google.maps.Point(0,0),
                    anchor: new google.maps.Point(25,0)
                },
                shape: shape,
                title: beach.name,
                zIndex: beach.zIndex
            });
            this.markerEventListener(map, marker, tweet[i], tweet_date[i]);
        }
    }
    
    markerEventListener(map, marker, tweet, tweet_date) {
        const contenido = "Tweet: "+tweet+"<br/>When: "+tweet_date;
        google.maps.event.addListener(marker, 'click', function(evt) {
            if(this.infowindow){
                this.infowindow.close();
            }
            
            this.infowindow = new google.maps.InfoWindow();
            this.infowindow.setContent(contenido);
            this.infowindow.setPosition(evt.latLng);
            this.infowindow.open(map);
        });
    }
    
    autoComplete() {
        const infowindow = new google.maps.InfoWindow();
        const infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        
        const input = document.getElementById('pac-input');
        const autocomplete = new google.maps.places.Autocomplete(input);
        
        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }
            console.log(place.name);
            this.setState({city_name: place.name});
            return place.name;
        }.bind(this));
    }

    handleSubmit(event) {
        this.fetchTweets(this.state.city_name);
        event.preventDefault();
    }

    handleReload(event) {
        this.fetchTweets(event.target.value);
        event.preventDefault();
    }
    
    handleOnClick() {
        this.setState({ loading: true, most_recent: [] }, () => {
            axios.get('/api/history')
                .then(response => this.setState({
                        loading: false,
                        most_recent: response.data
                }));
        });
    }
    
    render() {
        const { most_recent, map_loading, loading } = this.state;
    
        return (
            <div className='container'>
                <div className='row justify-content-center'>
                    <div className='col-sm-9'>
                        <div className='row'>
                            <div id="banner" className='col-sm-12 text-center'></div>
                            <div id="map-canvas">{map_loading ? <i className="fa fa-spinner fa-spin fa-4x"></i> : ''}</div>
                            <div className='col-sm-12' style={{ padding: '10px', background: '#f8f8f8' }}>
                            <div id="infowindow-content"style={{ display: 'none' }} >
                                <img src="" width="16" height="16" id="place-icon"/>
                                <span id="place-name" className="title"></span>
                                <span id="place-address"></span>
                            </div>
                            <input id="pac-input" type="text" className="form-control col-sm-6" placeholder="Enter a location" onChange={this.handleChange} />
                            <button type="submit" className="btn btn-primary col-sm-3" onClick={this.handleSubmit}>SEARCH</button>
                            <button type="button" className="btn btn-default col-sm-3" onClick={this.handleOnClick}>HISTORY</button>
                            </div>
                        </div>
                    </div>
                    <div className='col-sm-2'>
                        <h5>Most Recent</h5><hr/>
                        {loading ? <i className="fa fa-spinner fa-spin fa-4x"></i> : ''}
                        <ul className='list-group list-group-flush' id="history">
                            {most_recent.map(project => (
                                <button key={project.city} className="btn btn-default text-left" onClick={this.handleReload} value={project.city}>{project.city}</button>
                            ))}
                        </ul>
                    </div>
                </div>
                <Footer />
            </div>
        );
    }
}

ReactDOM.render(<App />, document.getElementById('app'));