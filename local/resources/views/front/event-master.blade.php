<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <title>{{ config('app.meta_title') }}</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="{{ \App\library\Settings::getSettings()->name }}">
        <meta name="copyright" content="&amp;copy; 2000-<?php echo date('Y').' '.\App\library\Settings::getSettings()->name;?>">
        <meta name="keywords" content="{{ config('app.meta_keyword') }}">
        <meta name="description" content="{{ config('app.meta_description') }}">
        <meta property="og:url"  content="{{ config('app.meta_url') }}" />
        <meta property="og:type"  content="{{ config('app.meta_type') }}" />
        <meta property="og:title"  content="{{ config('app.meta_title') }}" />
        <meta property="og:description" content="{{ config('app.meta_description') }}" />
        <meta property="og:image" content="{{ config('app.meta_image') }}" />
        <meta name='robots' content='index,follow' />
        <meta name="theme-color" content="#002A5B">
        <?php
        $icon = \App\library\Settings::getIcon();
        if(!empty($icon)) { ?>
        <link href="{{ asset($icon) }}" rel="icon">
        <link rel="shortcut icon" type="image/png" href="{{ asset($icon) }}"/>
        <?php }?>
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
        <link rel="stylesheet" href="{{asset('css/slick-theme.css')}}">
        <link rel="stylesheet" href="{{asset('css/slick.css')}}">
        <link rel="stylesheet" href="{{asset('css/styles.css')}}">
        <link rel="stylesheet" href="{{asset('css/purna.css')}}">
        <link rel="stylesheet" href="{{asset('css/event-comment.css')}}">
        <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.4.1/css/all.css" crossorigin="anonymous">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900' rel='stylesheet'>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <script src='{{asset("js/jquery-3.1.1.min.js")}}'></script>
    </head>
    <body data-spy="scroll" data-target=".navbar" data-offset="100">
        <div class="topbar">
            @yield('header')
        </div>

        @yield('content')
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">

                    </div>
                </div>
            </div>
        </div>
        @include('front/common/footer')
        <!-- footer section ended here -->
        <section class="btmfooter">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-3">
                        <div class="social_link">
                            <span><a href="#" class="blueclr"><i class="fab fa-facebook-square"></i></a>
                            <a href="#" class="blueclr"><i class="fab fa-twitter-square"></i></a></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-9">
                       <p>{{date('Y')}} All Rights with <a href="#" class="blueclr">{{\App\library\Settings::getSettings()->name}}</a></p>
                    </div>
                </div>
            </div>
        </section>
        <!-- footer navigation ended here -->
        <div class="modal fade" id="individualModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog individual_form" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Login with your registered Email & Password.</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="employee-login-form" action="{{url('/employee/login')}}">
                            {!! csrf_field() !!}
                            <div class="form-group row cm-row">
                                <span class="col-md-1 form_icon bluebg">
                                    <i class="fa fa-user-circle"></i>
                                </span>
                                <input type="email" name="email" class="form-control col-md-11" id="individual_user" placeholder="Individual Username">
                            </div>
                            <div class="form-group row cm-row">
                                <span class="col-md-1 form_icon bluebg">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="password" name="password" class="form-control col-md-11" id="individual_password" placeholder="Individual Password">
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" name="remember" type="checkbox" id="gridCheck1">
                                    <label class="form-check-label ind_check_label" for="gridCheck1">
                                        Remember me
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" id="individual-button" class="btn ind_bluebtn">Login</button>
                                <span class="float-right ind_forget"><a href="{{ url('employee/password') }}">Forget your Password ?</a></span>
                            </div>
                        </form>
                    </div>
                    <div class="modal_footer">
                        <p>If you don’t have an account, please creat an account.</p>
                        <div class="tb10m">
                            <a href="{{url('/employee/register')}}" class="btn ind_signupbtn">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Individual button popup ended here -->
        @include('front/common/popuplogin')
        <!-- Scripts -->
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <script src="{{asset('js/slick.min.js')}}"></script>
        <script src="{{asset('js/custom.js')}}"></script>
        <script type="text/javascript">
        $('#individual-button').on('click', function()
        {
        $('#employee-login-form').submit();
        });
        $('#business-button').on('click', function()
        {
        $('#employer-login-form').submit();
        });
        </script>

        @php($setting= \App\library\Settings::getSettings())
<script type="text/javascript">
    (function () {
        var options = {
            facebook: "rollingplans", // Facebook page ID
            email: "{{ $setting->email }}", // Email
            call: "{{$setting->telephone}}", // Call phone number
            company_logo_url: "{{\App\library\Settings::getLogo()}}", // URL of company logo (png, jpg, gif)
            greeting_message: "Hello, how may we help you? Just send us a message now to get assistance.", // Text of greeting message
            call_to_action: "Meet us", // Call to action
            button_color: "#541547", // Color of button
            position: "right", // Position may be 'right' or 'left'
            order: "facebook,call,email" // Order of buttons
        };
        var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>

<script type="text/javascript">
    /***************** show and hide header ******************/
    $(window).scroll(function() {
    if ($(".inner_header").offset().top > 100) {

        $(".inner_header").addClass("show_innerheader");
    } else {
        $(".inner_header").removeClass("show_innerheader");
    }

	});
</script>
<script src="https://unpkg.com/khalti-checkout-web@latest/dist/khalti-checkout.iffe.js"></script>
<script src="{{asset('js/event-comments.js')}}"></script>
<?php echo \App\library\Settings::getSettings()->google_analytics;?>
    </body>
</html>
