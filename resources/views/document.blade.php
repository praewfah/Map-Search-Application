<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>GeoTwitter : Document</title>
    
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    
    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
</head>
<body>
    <main class="bd-masthead" id="content" role="main">
        <div class="container">
          <div class="row">
            <div class="col-12 mx-auto col-md-12"> 
                <div class="row">
                    <div class="col-2 col-md-2"></div>
                    <div class="col-8 col-md-8"> 
                        <div class="row" >
                            <h1 class="text-center">
                                GeoTwitter: Google Maps + Api Twitter
                            </h1><hr/>
                            <div class="text-center">
                                <img src="{{ url('/img/content1.png') }}" alt="--root--" width="90%" />
                            </div>
                            <hr/>
                            <h5>
                                To develop GeoTwitter we are going to use both server-side languages (PHP), 
                                client-side languages (HTML, React) as well as formats for data exchange (JSON). 
                            </h5><br/><br/>
                            <ul>
                                <li>
                                    The page is a responsive design<hr/>
                                </li>
                                <li>
                                    <p>Search Form with Auto-complete</p>
                                    <div class="text-teft">
                                        <img src="{{ url('/img/content2.png') }}" alt="Auto-Complete" width="70%" />
                                    </div><hr/>
                                </li>
                                <li>
                                    <p class="p-3">Profile image clickable</p>
                                    <div class="text-teft">
                                        <img src="{{ url('/img/content6.png') }}" alt="Profile images is clickable" width="50%" />
                                    </div><hr/>
                                </li>
                                <li>
                                    <p class="p-3">Click History button to fetch new <b>Most Recent</b></p>
                                    <div class="text-teft">
                                        <img src="{{ url('/img/content4.png') }}" alt="Most Recent" width="100%" />
                                    </div><hr/>
                                </li>
                                <li>
                                    <p class="p-3">When click the <b>Most Recent</b>, it will re-load tweets on the map</p>
                                    <div class="text-teft">
                                        <img src="{{ url('/img/content5.png') }}" alt="Most Recent" width="100%" />
                                    </div><hr/>
                                </li>
                                <li>
                                    <p class="p-3">The project's root --
                                    
                                    <a href='https://github.com/praewfah/Map-Search-Application.git' target="_blank">
                                        https://github.com/praewfah/Map-Search-Application.git
                                    </a>
                                    </p>
                                    <div class="text-teft">
                                        <img src="{{ url('/img/docs.png') }}" alt="root" width="100%" />
                                    </div><hr/>
                                </li>
                            </ul><br/><br/>
                            
                            Demo : 
                            <a href='http://map-search-application.herokuapp.com' target="_blank">
                                http://map-search-application.herokuapp.com
                            </a>
                            <br/>
                            GIT URL : 
                            <a href='https://github.com/praewfah/Map-Search-Application.git' target="_blank">
                                https://github.com/praewfah/Map-Search-Application.git
                            </a><br/><br/>
                        </div>
                    </div>
                    <div class="col-2 col-md-2"></div>
                </div>
            </div>
          </div>
        </div>
    </main>
</div>
</body>
</html>