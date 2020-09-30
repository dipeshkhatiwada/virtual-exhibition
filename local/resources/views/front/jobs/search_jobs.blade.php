@extends('front.job-master')
@section('header')
<section class="rj_banner">
    <div class="container rn_container">
        @include('front/common/job_header')
        <div class="row">
            <div class="col-md-5">
                <h1 class="h1 tp30p"><span class="greenclr">We offer</span> <span class="redclr">1000+</span> job vacancies <br>Register right now !</h1>
                <p>Start building your career with us</p>
                <!-- <a href="#" class="btn aboutbtn">About Us</a> -->
            </div>
            <div class="col-md-7">
                <div class="tp30p">
                    <form class="search_form btm30p">
                        <div class="row cm10-row">
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="keyword" placeholder="key words">
                            </div>
                            <div class="col-md-3">
                                <select id="location" class="form-control">
                                    <option value="">Choose Job location</option>
                                    @foreach($datas['search_locations'] as $search_location)
                                    <option value="{{$search_location->id}}">{{$search_location->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select id="category" class="form-control">
                                    <option value="">Choose Category</option>
                                    @foreach($datas['search_categories'] as $search_category)
                                    <option value="{{$search_category->id}}">{{$search_category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" id="search-button" class="btn searchicon right"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                    <ul id="tabsJustified" class="nav nav-tabs bannertab">
                        <li class="nav-item"><a href="" data-target="#function" data-toggle="tab" class="nav-link small active">Jobs by Industry</a></li>
                        <li class="nav-item"><a href="" data-target="#job_category" data-toggle="tab" class="nav-link small">Jobs by Category</a></li>
                        <li class="nav-item"><a href="" data-target="#city" data-toggle="tab" class="nav-link small">Jobs by City</a></li>
                    </ul>
                    <div id="tabsJustifiedContent" class="tab-content bannertab-content">
                        <div id="function" class="tab-pane fade active show">
                            <ul class="row">
                                @foreach($datas['functions'] as $function)
                                <li class="col-md-4 text-ellipsis"><a href="{{$function['href']}}" title="{{$function['name']}} ({{$function['total']}})">{{$function['name']}} <span>({{$function['total']}})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div id="job_category" class="tab-pane fade">
                            <ul class="row">
                                @foreach($datas['categories'] as $category)
                                <li class="col-md-4 text-ellipsis"><a href="{{$category['href']}}" title="{{$category['name']}} ({{$category['total']}})">{{$category['name']}} <span>({{$category['total']}})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div id="city" class="tab-pane fade">
                            <ul class="row">
                                @foreach($datas['locations'] as $location)
                                <li class="col-md-4 text-ellipsis"><a href="{{$location['href']}}" title="{{$location['name']}} ({{$location['total']}})">{{$location['name']}} <span>({{$location['total']}})</span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- header part with navigation ended here -->
@stop
@section('banner')
<!-- banner section with search form ended here -->
@stop
@section('content')
@if(count($datas['top_content']) > 0)
<section id="top_content" class="jobs tb35p">
    <div class="container rn_container">
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
$class = 'col-md-7';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-md-8 col-lg-9 col-12';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-md-10';
} else{
$class = 'col-md-12';
} ?>
<section id="job" class="jobs tb35p">
    <div class="container rn_container">
        <div class="row">
            @if (count($datas['left_content']) > 0)
            <aside class="col-md-4 col-lg-3 col-12">
                @foreach($datas['left_content'] as $lcontent)
                <?php echo $lcontent['module']; ?>
                @endforeach
            </aside>
            @endif
            <div class="{{$class}}">

                @if(count($datas['jobs']) > 0)
                
                <div class="row cm10-row">
                   @foreach($datas['jobs'] as $job)
                    <?php if(count($job['jobs']) > 2) {
                    $class = 'has-multiple';
                    } else {
                    $class = '';
                    } ?>
                    <div class="col-md-4 col-12 col-lg-3 job-types">
                      <div class="comn_block {{$class}}">
                        <div class="next">
                          <div class="row cm-row">
                            <div class="col-md-3 col-lg-3 col-3">
                              <div class="complogo">
                                @if($job['logo'] != '')
                                <a href="{{$job['url']}}"><img src="{{asset($job['logo'])}}"></a>
                                @else
                                <div class="noimage_sqr backgroundcolor-{{$job['fletter']}}">{{$job['fn']}}</div>
                                @endif
                              </div>
                            </div>
                            <div class="col-md-9 col-lg-9 col-9 job-list text-ellipsis">
                              <div class="lft10p">
                              <a class="company_name" title="{{$job['employer_name']}}" href="{{$job['url']}}" target="_blank">{{$job['employer_name']}}</a>
                              <ul class="joblist">

                                @foreach($job['jobs'] as $ejob)
                                <li class="text-ellipsis"><a title="{{$ejob->title}}" href="{{url('/jobs/'.$job['seo_url'].'/'.$ejob->seo_url)}}">{{$ejob->title}}</a></li>
                                @endforeach
                              </ul>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach 
                  </div>
               
                @endif

                @foreach($datas['main_modules'] as $main_module)
                <?php echo $main_module['module']; ?>
                @endforeach
            </div>
            @if (count($datas['right_content']) > 0)
            <aside class="col-md-2">
                @foreach($datas['right_content'] as $rcontent)
                <?php echo $rcontent['module']; ?>
                @endforeach
            </aside>
            @endif
        </div>
    </div>
</section>
@if(count($datas['bottom_content']) > 0)
<section id="bottom_content" class="jobs tb35p">
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

<script type="text/javascript">
$('#search-button').on('click', function() {

var keyword = $('#keyword').val();
var location = $('#location').val();
var category = $('#category').val();
if (keyword == '' && location == '' && category == '') {
$('#keyword').focus();

} else{

var searchurl = '{{url("/jobs/search/")}}';

if (keyword != '') {
    searchurl += '?keyword='+keyword;
}
if (category != '') {
    searchurl += '?category='+category;
}
if (location != '') {
    searchurl += '?location='+location;
}


window.location = searchurl;
}

})
</script>
@stop