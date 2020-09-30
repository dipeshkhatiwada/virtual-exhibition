@extends('front.job-master')
@section('header')
@include('front/common/blog_header')
<!-- header part with navigation ended here -->
@stop
@section('banner')
<section class="tp60p btm30p">
  
<div class="goo_wrapper">
    <div id="googlemaps">
      <div id="googlemap"></div>
       
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD72DVMbMzjPBwABjd1F2MV8s7VQplAQbs"></script>
    <script type="text/javascript"> 
      function init_map(){var myOptions = {zoom:16,
      center:new google.maps.LatLng(<?php echo $datas['datas']['latitude'].','.$datas['datas']['longitude'];?>),
      mapTypeId: google.maps.MapTypeId.MAP};
      map = new google.maps.Map(document.getElementById("googlemap"), myOptions);
      marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(<?php echo $datas['datas']['latitude'].','.$datas['datas']['longitude'];?>)});
      infowindow = new google.maps.InfoWindow({content:"<b><?php echo $datas['datas']['name'];?></b>" });
      google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});
      infowindow.open(map,marker);
      }
      google.maps.event.addDomListener(window, 'load', init_map);
    </script>  
     
  </div>
<div class="container neg80p">
  <div class="row">
  <div class="col-lg-4 col-md-4 col-12">
<h1 class="head-title">Contact Us</h1>
</div>
    <div class="col-lg-8 col-md-8 col-12">
    </div>
  </div>
  
</div>
</section>

@stop
@section('content')
@if(count($datas['top_content']) > 0)
<section id="top_content" class="section rollingable sports-main tp80p">
  <div class="container ">
    <div class="row">
      <div class="col-md-12">
        @foreach($datas['top_content'] as $tcontent)
        <?php echo $tcontent['module']; ?>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endif
<?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
$class = 'col-lg-6 col-md-6 col-12 center-panel';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-md-9 col-lg-9 col-12';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-lg-9 col-md-9 col-12';
} else{
$class = 'col-md-12';
} ?>
<section class="section rollingable sports-main tp80p">
  <div class="container">
    <div class="article_intro">
    <div class="row">
      @if (count($datas['left_content']) > 0)
        <aside class="col-lg-3 col-md-3 col-12">
            @foreach($datas['left_content'] as $lcontent)
            <?php echo $lcontent['module']; ?>
            @endforeach
        </aside>
      @endif
      <div class="{{$class}}"> 
            <div class="row btm10m"> 
              <div class="col-sm-8 module_cont pb20 animate" data-anim-type="fadeInUp" data-anim-delay="300"> 
                <div class="promo-block">
                  <div class="promo-text">
                    <strong>Contact Form</strong>
                  </div>
                  <div class="center-line"></div>
                </div>
                <div class="marg50"> 
                  @if (Session::has('alert-danger'))
                  <div class="alert alert-danger">{{ Session::get('alert-danger') }}</div>
                    @endif
                    @if (Session::has('alert-success'))
                  <div class="alert alert-success">{{ Session::get('alert-success') }}</div>
                    @endif
                  <div id="row"> 
                    <form id="contactForm" class="dash_forms tp15m" action="{{url('addContact')}}" method="post">
                      {!! csrf_field() !!} 
                      <div class="row row20"> 
                        <div class="col-lg-4 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                          <input type="text" class="form-control" name="name" id="name" required="required" value="{{ old('name') }}" placeholder="Full Name"/>
                            @if ($errors->has('name'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('name') }}</strong>
                              </span>
                            @endif
                        </div>
                        <div class="col-lg-4 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                          <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" required="required"  placeholder="Email *"/>
                          @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                          @endif
                        </div>
                        <div class="col-lg-4 form-group {{ $errors->has('subject') ? ' has-error' : '' }}">
                          <input type="text" class="form-control" name="subject" id="subject" required="required"  value="{{ old('subject') }}" placeholder="Subject"/>
                          @if ($errors->has('subject'))
                          <span class="help-block">
                              <strong>{{ $errors->first('subject') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                      <div class="row row20"> 
                        <div class="col-lg-12 form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                          <textarea name="message" cols="40" rows="10" class="form-control" id="message" required="required"  placeholder="Write Your Message Here...">{{ old('message') }}</textarea>
                          @if ($errors->has('message'))
                          <span class="help-block">
                              <strong>{{ $errors->first('message') }}</strong>
                          </span>
                          @endif 
                        </div>
                      </div>
                      <button type="submit" class="btn bluebg sendbtn btm10m">Send Message</button> 
                    </form> 
                  </div>
                </div>
              </div>
            
              <div class="col-sm-4 module_cont contact_info pb40 animate" data-anim-type="fadeInUp" data-anim-delay="300"> 
                <div class="promo-block">
                  <div class="promo-text btm15m">
                    <strong>
                    Contact Info
                    </strong>
                  </div>
                  <div class="center-line"></div>
                </div> 
                <p><span class="blueclr"><i class="fa fa-phone-volume"></i></span> <span>Phone:</span> <?php echo $datas['datas']['phone'];?></p>
                <p><span class="blueclr"><i class="fa fa-map-marker-alt"></i></span> <span>Address:</span> <?php echo $datas['datas']['address'];?></p>
                <p class="mb29"><span class="blueclr"><i class="fa fa-envelope"></i></span> <span>Email:</span> <a href="mailto:<?php echo $datas['datas']['email'];?>"><?php echo $datas['datas']['email'];?></a></p>
              </div>
            </div>                
         
        @foreach($datas['main_modules'] as $main_module)
        <?php echo $main_module['module']; ?>
        @endforeach
      </div>
      @if (count($datas['right_content']) > 0)
      <aside class="col-lg-3 col-md-3 col-12">
        @foreach($datas['right_content'] as $rcontent)
        <?php echo $rcontent['module']; ?>
        @endforeach
      </aside>
      @endif
      </div>
    </div>
    </div>
</div>
  </section>
  @if(count($datas['bottom_content']) > 0)
  <section id="bottom_content" class="tb10p">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          @foreach($datas['bottom_content'] as $bcontent)
          <?php echo $bcontent['module']; ?>
          @endforeach
        </div>
      </div>
    </div>
  </section>
  @endif
  @stop

   