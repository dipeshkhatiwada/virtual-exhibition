@extends('front.tender-master')
@section('header')
<section class="innerpage_banner">
  <div class="container">
    @include('front/common/test_header')
    <div class="">
       <h3 class="tp30p center"><span class="whiteclr">Search Test</span> <span class="greencolor"> With Category </span> </h3>
      <div class="search_background">
        <form class="search_form">
          <div class="row cm10-row">
            <div class="col-md-10 col-9">
              <input type="text" id="search" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Road Construction">
            </div>
            <div class="col-md-2 col-3">
              <button type="button" id="search_button" class="btn searchbtn">Search</button>
            </div>
          </div>
        </form>
      </div>
      <p>Explore New Business Opportunities & Grow your Business </p>
      <div class="tb20p center">
        <a class="btn bluecomnbtn">ADVANCE SEARCH</a>
      </div>
    </div>
  </div>
</section>
@stop
@section('banner')
@stop
@section('content')
<section>
  <div class="container">
    <div class="white_div neg_margin">
      
      <div class="row cm10-row">
        <div class="col-md-12">
             
          
          <div class="alert alert-danger">Sorry We can not find the Test. Please Visit Next Time</div>
          
        </div>
      </div>
    </div>
    
  </div>
</section>
<script type="text/javascript">
$('#search_button').on('click', function() {
var data = $('#search').val();
if (data != '') {
var url = '{{url("/skill-test/search/")}}';
url += '/'+data;
location = url;
} else{
$('#search').focus();
}

})


</script>
@stop