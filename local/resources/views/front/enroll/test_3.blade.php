
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Company Detail</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">

    <link href="{{asset('css/style_mdb.css')}}" rel="stylesheet">

    <!-- Template styles -->
    <style rel="stylesheet">
        /* TEMPLATE STYLES */

        main {
            padding-top: 3rem;
            padding-bottom: 2rem;
        }

        .widget-wrapper {
            padding-bottom: 2rem;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 2rem;
        }

        .extra-margins {
            margin-top: 1rem;
            margin-bottom: 2.5rem;
        }

        .divider-new {
            margin-top: 0;
        }

        .navbar {
            background-color: #414a5c;
        }

        footer.page-footer {
            background-color: #414a5c;
            margin-top: 2rem;
        }

        .list-group-item.active {
            background-color: #2bbbad;
            border-color: #2bbbad
        }

        .list-group-item:not(.active) {
            color: #222;
        }

        .list-group-item:not(.active):hover {
            color: #666;
        }
        .card {
            font-weight: 300;
        }
        .navbar .btn-group .dropdown-menu a:hover {
            color: #000 !important;
        }
        .navbar .btn-group .dropdown-menu a:active {
            color: #fff !important;
        }
        #masthead {
     min-height:250px;
    }
    #scrollvideo{
                height: 365px;
                width: 183px;
                background: #F5F5F5;
                overflow-y: scroll;
            }

    </style>
</head>

<body>
      <div id="masthead">
          <div class="container">
              <div class="row">
                  <div class="col-md-12">

                  </div>
                 <div class="col-md-5">
                      <div class="well well-lg">
                          <div class="row">
                              <div class="col-sm-6">
                              </div>
                              <div class="col-sm-6">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

    <main>

        <!--Main layout-->
        <div class="container">
            <div class="row">

                <!--Sidebar-->
                <div class="col-3">
                        <ul class="navbar-nav mr-auto smooth-scroll">
                            <li class="nav-item">
                                <a class="nav-link" href="#introduction">Introduction
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{$company_detail->company_website}}" target="_blank" data-offset="90">Company Website</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#profile" data-offset="90">Company Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('enroll.audience', $company_detail->seo_url) }}" data-offset="90">Watch LiveStream</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/enroll/group-video/joinchannel/'.$company_detail->seo_url) }}" data-offset="30">Vide Call</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#gallery" data-offset="90">Gallery</a>
                            </li>
                        </ul>

                </div>
                <!--/.Sidebar-->

                <!--Main column-->
                <div class="col-lg-8">

                    <!--First row-->
                    <div class="row wow fadeIn" data-wow-delay="0.4s" id="introduction">
                        <div class="col-lg-12">
                            <div class="divider-new">
                                <h2 class="h2-responsive">Welcome to {{$company_detail->company_name}}</h2>
                            </div>

                            <!--Carousel Wrapper-->
                            <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
                                <!--Indicators-->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-1z" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-1z" data-slide-to="2"></li>
                                </ol>
                                <!--/.Indicators-->
                                <!--Slides-->
                                <div class="carousel-inner" role="listbox">
                                    <!--First slide-->
                                    <div class="carousel-item active">
                                        <img src="{{ asset( 'image/'.$company_detail->banner_file) }}" alt="First slide" class="img-fluid">
                                        <div class="carousel-caption">
                                            <br>
                                        </div>
                                    </div>
                                    <!--/First slide-->
                                    <!--Second slide-->
                                    <div class="carousel-item">
                                        <img src="https://mdbootstrap.com/img/Photos/Slides/img%20(109).jpg" alt="Second slide" class="img-fluid">
                                        <div class="carousel-caption">

                                            <br>
                                        </div>
                                    </div>
                                    <!--/Second slide-->
                                    <!--Third slide-->
                                    <div class="carousel-item">
                                        <img src="https://mdbootstrap.com/img/Photos/Slides/img%20(36).jpg" alt="Third slide" class="img-fluid">
                                        <div class="carousel-caption">
                                            <br>
                                        </div>
                                    </div>
                                    <!--/Third slide-->
                                </div>
                                <!--/.Slides-->                                <!--Controls-->
                                <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                                <!--/.Controls-->
                            </div>
                            <!--/.Carousel Wrapper-->
                        </div>
                    </div>
                    <!--/.First row-->
                    <br>
                    <hr class="extra-margins">

                    <div class="row">
                        <div class="col-md-9">
                            <iframe id="vid_frame" src="http://www.youtube.com/embed/{{ $company_detail->intro_video }}/?modestbranding=1&;showinfo=0&;autohide=1&;rel=0;" frameborder="0" width="560" height="365" allowfullscreen ></iframe>
                        </div>
                        <div class="col-md-2">
                            <div class="card" id="scrollvideo">
                                @foreach ($company_detail->videos as $video)

                                <div class="vid-item" onClick="document.getElementById('vid_frame').src='http://youtube.com/embed/{{ $video->link }}/?modestbranding=1&;showinfo=0&;autohide=1&;rel=0;'">
                                    <div class="thumb"><img src="http://img.youtube.com/vi/{{ $video->link }}/0.jpg" width="150" height="150"></div>
                                        <div class="desc">
                                        {{ $video->title }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr class="extra-margins">


                    <!-- Section: Gallery -->
                  <section class="section wow fadeIn" data-wow-delay="0.3s" >
                    <!-- Section heading -->
                    <h1  id="profile" class="font-weight-bold text-center h1 my-5">Profile</h1>
                    <!-- Section description -->
                    <p> {!! $company_detail->description !!}</p>

                  </section>
                  <br>
                  <hr class="extra-margins">

                <!-- /Section: Gallery -->

                    <!--Second row-->
                    <div class="row">
                        <!--First columnn-->
                        @foreach ($photos as $photo)
                        <div class="col-lg-6">
                            <!--Card-->
                            <div class="card wow fadeIn" data-wow-delay="0.2s" id="gallery">

                                <!--Card image-->
                                <img class="img-fluid" src="{{ asset( 'image/'.$photo->image ) }}" alt="Card image cap">

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Title-->
                                    <h4 class="card-title">{{ $photo->title }}</h4>
                                    <!--Text-->
                                    <p class="card-text">{{ $photo->description }}
                                    </p>
                                </div>

                            </div>
                            <!--/.Card-->
                        </div>
                        @endforeach

                    </div>
                    <!--/.Second row-->

                </div>
                <!--/.Main column-->

            </div>
        </div>
        <!--/.Main layout-->

    </main>


    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>

    <!-- Bootstrap dropdown -->
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>

    <script>
        new WOW().init();
    </script>
    <script src="{{asset('js/agora-audience-client.js')}}" type="text/javascript"></script>

</body>

</html>
