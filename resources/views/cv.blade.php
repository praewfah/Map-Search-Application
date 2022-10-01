<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Aumaporn CV</title>
    
    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
    
    <!-- Styles -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
</head>
<body>
    <main class="bd-masthead" id="content" role="main">
        <div class="container">
          <div class="row">
            <div class="col-12 mx-auto col-md-12"> 
                <div class="row justify-content-md-center">
                    <div class="col-md-10">  
                        <div class="row">
                            <div class="col-md-3">
                                <div class="row justify-content-md-center badge-dark">
                                    <div class="col-md-8 pt-3">
                                        <img src="{{ url('/img/profile.JPG') }}" class="card-img rounded-circle" alt="Praew" width="100px" >
                                    </div>
                                    <div class="col-md-12 pt-3">
                                        <h6 class="text-center text-uppercase">Miss Aumaporn Tangmanosodsikul</h6>
                                        <h6 class="text-center text-uppercase">Praew</h6>
                                        <p class="text-center">Software Developer</p>
                                    </div>
                                </div> <!--image-->

                                <div class="row justify-content-md-left badge-light pt-4 pl-3">
                                    <ul class="list-unstyled small">
                                        <li><b>Birthday:</b> 13 May 1987</li>
                                        <li><b>Height:</b> 155 cm</li>
                                        <li><b>Weight:</b> 48 kg</li>
                                        <li><b>Nationality:</b> Thai</li>
                                        <li><b>Religion:</b> Buddhism</li>
                                        <li><b>Marital Status:</b> Single</li>
                                    </ul>
                                </div>
                                <div class="row d-none d-sm-none d-md-block badge-light" style="min-height: 400px">
                                    &nbsp;
                                </div>
                                <div class="row justify-content-md-left badge-light pt-4 pl-3" style="position: relative; bottom: 0px;">
                                    <address class="small text-muted">
                                        2359/187 A-Space Sukhumvit<br>
                                        77 Building, Onnuch Road,<br>
                                        Suanluang, Bangkok 10250<br><br>
                                        <abbr title="Phone">P:</abbr> 084-659-5073<br><br>
                                        <a href="mailto:preawfah@hotmail.com">preawfah@hotmail.com</a>
                                    </address>
                                </div>  <!--address-->

                            </div>
                            <div class="col-md-9">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <h6 class="text-uppercase">
                                            Education
                                        </h6>
                                        <hr/>
                                        <p class="small"><b>Bachelor:</b> May 2006 - Mar 2009, The University of the 
                                            Thai Chamber of Commerce, Thailand, GPA.3.58 (First class honors), Major Computer Science</p>
                                    </div>
                                </div><!--Education-->

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <h6 class="text-uppercase">
                                            Experience
                                        </h6>
                                        <hr/>
                                        
                                        <div class="p-3 mb-2 bg-light text-dark small">
                                            <div class="row">
                                                <div class="col-md-7 text-left">
                                                    Senior Back-end Engineer at bluePi(Thailand) Co.,Ltd. 
                                                </div>
                                                <div class="col-md-5 text-right">
                                                    April 2021 - Present
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <ul class="small">
                                                <li>Engineered modern applications with Python(FastAPI), Docker, and PostgreSQL</li>
                                                <li>Built innovative microservices and Web Services (incl. REST)</li>
                                                <li>Efficiently deployed and integrated software engineered by team and 
                                                updated integration/deployment scripts to improve continuous integration practices</li>
                                                <li>Liaised with Product Managers to identify minimum viable product requirements 
                                                and clearly defined feature sets into well-scoped user stories for individual team members</li>
                                                <li>Agile methodology</li>
                                            </ul>
                                        </div><!-- bluepi -->
                                        
                                        <div class="p-3 mb-2 bg-light text-dark small">
                                            <div class="row">
                                                <div class="col-md-6 text-left">
                                                    Senior PHP Developer at UnixDev Co.,Ltd. 
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    July 2020 - March 2021
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <ul class="small">
                                                <li>Implementing DEEP (Digital Education Excellence Platform) 
                                                    project using PHP Laravel, MySql, Vue.js</li>
                                            </ul>
                                        </div><!-- unixdev -->
                                        
                                        <div class="p-3 mb-2 bg-light text-dark small">
                                            <div class="row">
                                                <div class="col-md-6 text-left">
                                                    Senior Developer at Common-services Co.,Ltd 
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    December 2013 - January 2020
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <ul class="small">
                                                <li>Providing Project Management, PHP Development for the Feed.biz website</li>
                                                <li>Created/Consuming Web Services coding in using SOAP, REST, XML Technologies</li>
                                                <li>Validated XML input versus XSD to ensure lead data accuracy</li>
                                                <li>Database Design and Query Optimization (Worked in backend with MySQL)</li>
                                                <li>Developed PDO Prepared Statements</li>
                                                <li>Designed applications in AJAX with rich user interfaces</li>
                                                <li>Worked on Apache Server, Linux</li>
                                                <li>Troubleshooting Daily Incidents & CodeIgniter based MVC Application Support as well
                                                as maintaining them</li>
                                                <li>Implemented the marketplaces feed submission module (Prestashop, Shopify) for
                                                Amazon, Cdiscount, Google Shopping and Mirakl</li>
                                                <li>Source control and release management using GIT</li>
                                                <li>Worked on XAMPP using the PHP based CodeIgniter MVC framework, Node.js
                                                    And REACT.js</li>
                                            </ul>
                                        </div><!--COMMON-->

                                        <div class="p-3 mb-2 bg-light text-dark small">
                                            <div class="row">
                                                <div class="col-md-6 text-left">
                                                    PHP Developer at Diversition Co., Ltd.
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    2011 - November 2013
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <ul class="small">
                                                <li>Developed Object Oriented PHP application</li>
                                                <li>Developed different system modules e.g Selection, Order, Material Receive and
                                                Invoice</li>
                                                <li>Designed different front end forms using Drupal and CSS</li>
                                                <li>Maintaining User groups with Drupal CMS.</li>
                                            </ul>
                                        </div><!--Diver-->

                                        <div class="p-3 mb-2 bg-light text-dark small">
                                            <div class="row">
                                                <div class="col-md-7 text-left">
                                                    Programmer at A-Gape Consulting (Thailand) Co., Ltd.
                                                </div>
                                                <div class="col-md-5 text-right">
                                                    2009 - 2010
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <ul class="small">
                                                <li>Tester at FocusOne ERP for Y.M.F International (Thai) Co., Ltd</li>
                                                <li>Tester at IRPC Oil On Net (IRON) for IRPC Public Company Limited client site</li>
                                            </ul>
                                        </div><!--Agape-->

                                    </div>
                                </div><!--Experience-->

                                <div class="row mt-5 pb-5">
                                    <div class="col-md-12">
                                        <h6 class="text-uppercase">
                                            SKILLS
                                        </h6>
                                        <hr/>
                                        <div class="small">
                                            <b>Python (FastAPI), PHP (Framework: Laravel, CodeIgniter), SOAP API, REST API, RESTful, Vuejs, Vuex, REACT(basic), Next js, CSS, 
                                            Bootstrap, Angular, HTML, JavaScript, jQuery, NodeJS(basic), Swift(basic)
                                            </b>
                                        </div>
                                        <div class="small"><b>Server:</b> Linux, Apache, Docker </div>
                                        <div class="small"><b>Database:</b> MySQL, SQLite, PostgreSQL </div>
                                        <div class="small"><b>Web Service:</b> Amazon Web Service (AWS) </div>
                                        <div class="small"><b>Other:</b> Git, npm, Composer, SEO Friendly, Drupal, 
                                            Wordpress, Prestashop, Shopify, Google Shopping, Jira, Basecamp, Netbean, Xcode, VS Code</div>
                                    </div>
                                </div><!--Skill-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </main>
</body>
</html>
