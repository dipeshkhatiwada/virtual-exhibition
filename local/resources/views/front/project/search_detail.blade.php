@extends('front.tender-master')
@section('header')
<section class="rt_banner">
  <div class="container rn_container">
    @include('front/common/project_header')
    <div class="">
        <h3 class="tp30p center"><span class="whiteclr">Search Projects</span> <span class="greencolor"> With Category </span> </h3>
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
          <a class="btn bluecomnbtn">{{$datas['search']}} PROJECTS</a>
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


<?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
$class = 'col-md-7';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-md-9';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-md-10';
} else{
$class = 'col-md-12';
} ?>
<section>
  <div class="container">
    <div class="white_div neg_margin">
      @if(count($datas['top_content']) > 0)

      <div class="tp20p">
        <div class="row">
          <div class="col-md-12">
            @foreach($datas['top_content'] as $tcontent)
            <?php echo $tcontent['module']; ?>
            @endforeach
          </div>
        </div>
      </div>
    
@endif
      
        <div class="row">
          @if (count($datas['left_content']) > 0)
          <aside class="col-md-3">

            @foreach($datas['left_content'] as $lcontent)
            <?php echo $lcontent['module']; ?>
            @endforeach
          </aside>
          @endif
          <div class="{{$class}}">
            <div class="tb20p">
              <div class="list_hd btm7m hidden-xs">
                <div class="row">
                  <div class="col-md-3">
                   Projects
                  </div>
                  <div class="col-md-7">
                    Description
                  </div>
                  <div class="col-md-2">
                    <span> Price(NRs.) </span>
                  </div>
                </div>
              </div>
              @if(count($datas['projects']) > 0)
               @foreach($datas['projects'] as $project)
              <div class="list_block btm7m">
                <div class="list_body btm7m">
                  <div class="row cm10-row">
                    <div class="col-md-3">
                      <a class="title_three" href="{{url('/projects/'.$project->seo_url)}}" title="{{$project->title}}">{{\App\Library\Settings::getLimitedWords($project->title,0,10)}}</a>
                      <div class="tb5p">
                        <p><i class="fa fa-hourglass"></i> <span class="blueclr">Open</span> {{$project->publish_date}} - {{\App\ProjectApply::totalBidder($project->id)}} bids</p>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <p>{{\App\Library\Settings::getLimitedWords($project->description,0,20)}}</p>
                    </div>
                    <div class="col-md-2">
                      NRs. {{\App\ProjectApply::getAverage($project->id)}}
                    </div>
                  </div>
                </div>
                <p>
                  @php($skills = explode(',', $project->skills))
                  <span class="blueclr"><i class="fa fa-tags"></i></span>
                  @foreach($skills as $skill)
                      <span><a href="{{url('/projects/tags/'.$skill)}}" class="skill_list">{{$skill}}</a></span>
                      @endforeach
                </p>
              </div>
              @endforeach
              @else
              <div class="list_block btm7m">
                <div class="list_body btm7m">
                  <div class="row cm10-row">
                    <div class="col-md-12">
                      <div class="alert alert-info"> Sorry, could not found any project yet. please visit next time</div>
                    </div>
                  </div>
                </div>
              </div>
              @endif


            </div>
            <div class="tb20p">
              <nav aria-label="Page navigation example">
                <?php echo $datas['projects']->render();?>
              </nav>
            </div>
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
  </div>
</section>
@if(count($datas['bottom_content']) > 0)
<section id="bottom_content" class="jobs tb35p">
  <div class="container">
    <div class="white_div">
      <div class="tp20p">
        <div class="row">
          <div class="col-md-12">
            @foreach($datas['bottom_content'] as $bcontent)
            <?php echo $bcontent['module']; ?>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

<script type="text/javascript">
$('#search_button').on('click', function() {
var data = $('#search').val();
if (data != '') {
var url = '{{url("/projects/search/")}}';
url += '/'+data;
location = url;
} else{
$('#search').focus();
}

})
</script>
@stop