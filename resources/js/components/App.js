import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'

class App extends Component {
    constructor() {
        super();
        this.state = {
            data: [],
            coor: [],
            beaches: []
        };
        
        this.infowindow = null;
        
        this.handleChange = this.handleChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    componentDidMount() {
        var sc = document.createElement("script");
        sc.setAttribute("src", "https://maps.googleapis.com/maps/api/js?key=AIzaSyDjoHelMpE5RdVWUPQyDNknQpyxRQGBQpg&v=3.exp");
        sc.setAttribute("type", "text/javascript");
        document.head.appendChild(sc);

        axios.get('/api/twitter').then(response => {
            this.setState({
                data: response.data.data,
                coor: response.data.coor,
                beaches: response.data.beaches
            });
            
            google.maps.event.addDomListener(window, 'load', this.initialize());
        });
        
        
    }

    initialize() {
        const mapOptions = {
            zoom: 14,
            center: new google.maps.LatLng(this.state.coor.latitud, this.state.coor.longitud)
        };
        
        $('#map-canvas').css({ width: $(window).width(), height: $(window).height() * .8 });
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        
        this.setMarkers(map, this.state.beaches);
    }

    setMarkers(map, locations) {
        const data = this.state.data;

        const image = [];
        const tweet = []; 
        const tweet_date = [];

        for (var i = 0; i < data.length; i++) {
            image.push({
                url: data[i]['image_url'],
                size: new google.maps.Size(100, 100),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(25,0)
            });
            tweet_date.push(data[i]["fetch"]);
            tweet.push(data[i]["tweet"]);
        }
        
        const shape = {
            coord: [1, 1, 1, 100, 100, 100, 100, 1],
            type: 'poly'
        };

        for (var i = 0; i < locations.length; i++) {
            var beach = locations[i];
            var myLatLng = new google.maps.LatLng(beach[1], beach[2]);

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: image[i],
                shape: shape,
                title: beach[0],
                zIndex: beach[3]
            });

            this.markerEventListener(map, marker, tweet[i], tweet_date[i]);
        }
    }
    
    markerEventListener(map, marker, tweet, tweet_date) {
        var contenido = "Tweet: "+tweet+"<br/>When: "+tweet_date;
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
    
    handleChange(event) {
        //this.setState({value: event.target.value});
    }

    handleSubmit(event) {
        alert('A name was submitted: ');
        event.preventDefault();
    }
    
    render() {
        return (
            <div className='container'>
              <div className='row justify-content-center'>
                    <div className='col-sm-9'>
                        <div className='row'>
                            <div id="banner"></div>

                            <div id="map-canvas"></div>

                            <div className='col-sm-12' style={{ padding: '10px', background: '#f8f8f8' }}>
                                <form onSubmit={this.handleSubmit}>
                                    <input type="text" className="form-control col-sm-6" id="city" placeholder="City" />
                                    <button type="submit" className="btn btn-primary col-sm-3">SEARCH</button>
                                    <button type="button" className="btn btn-default col-sm-3">HISTORY</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div className='col-sm-2'>
                        HisTORY
                        HisTORY
                    </div>
              </div>
            </div>
        );
    }
}

ReactDOM.render(<App />, document.getElementById('app'));