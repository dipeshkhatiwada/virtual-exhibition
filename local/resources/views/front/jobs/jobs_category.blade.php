@extends('front.job-master')
@section('header')
<section class="innerpage_banner">
  <div class="container">
    @include('front/common/job_header')
    <div class="">
      <h3 class="tp30p center"><span class="whiteclr">Search Events</span> <span class="greencolor"> With Category </span> </h3>
      <div class="search_background">
        <form class="search_form">
          <div class="row cm10-row">
            <div class="col-md-10 col-9">
              <input type="text" id="search" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Seminar & Meeting">
            </div>
            <div class="col-md-2 col-3">
              <button type="button" id="search_button" class="btn searchbtn">Search</button>
            </div>
          </div>
        </form>
      </div>
      
      <div class="tb20p center">
        <a class="btn bluecomnbtn">SEARCH JOBS</a>
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
        @foreach($datas['categories'] as $category)
        <a class="col-md-4 text-ellipsis" href="{{$category['href']}}" title="{{$category['name']}} ({{$category['total']}})" style="background-color:#f1f1f1;margin-bottom: 1px;padding: 10px;">{{$category['name']}} <span>({{$category['total']}})</span></a>
        @endforeach
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">
$('#search_button').on('click', function() {
var data = $('#search').val();
if (data != '') {
var url = '{{url("/jobs/search/")}}';
url += '?keyword='+data;
location = url;
} else{
$('#search').focus();
}

})
</script>
@stop