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
          <a class="btn bluecomnbtn">TOP PROJECTS</a>
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
  <div class="container">
    <div class="white_div">
      <div class="tp20p">
        <div class="row">
          <div class="col-md-12">
            @foreach($datas['top_content'] as $tcontent)
            <?php echo $tcontent['module']; ?>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif
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
  <div class="container rn_container">
    <div class="white_div neg_margin">
      
        <div class="row">
          @if (count($datas['left_content']) > 0)
          <aside class="col-md-3">

            @foreach($datas['left_content'] as $lcontent)
            <?php echo $lcontent['module']; ?>
            @endforeach
          </aside>
          @endif
          <div class="{{$class}}">
            
            <!-- table view of project list started here -->
            <div class="tb20p">
              <h2 class="title_two btm7m">{{$datas['project']->title}}</h2>
              <div class="title_three">Description</div>
              <div class="blueborder tp5m"></div>
              <div class="paragraph">
              <p><?php echo $datas['project']->description;?></p>
            </div>
            <div class="title_three">Employer Detail</div>
            <div class="row tb20p">
              <div class="col-md-4">
               <div class="rating" style="display:block">
                    <div class="star-ratings-sprite left" style="margin: 0px;">
                      <span style="width:{{$datas['percentage']}}%" class="star-ratings-sprite-rating"></span></div>
                    <div class="rating-detail rating_div">
                      <div class="removelist btm7m">
                        <div class="remove-btn pull-right">
                          <i class="fas fa-minus-circle right"></i>
                        </div>
                      </div>
                     <div class="row all10p">
                      <div class="col-md-6">
                        <div class="rating-list">
                        <div class="r-title left">
                          <strong>Average Rating</strong>
                        </div>
                        <div class="rpercent right">
                          <strong>{{$datas['percentage']}}%</strong>
                        </div>
                      </div>
                      @foreach($datas['question_group'] as $group)
                      <div class="rating-list">
                        <div class="r-title left">
                          {{$group['title']}}
                        </div>
                        <div class="rpercent right">
                          {{$group['percent']}}%
                        </div>
                      </div>
                      @endforeach
                    </div>
                    <div class="col-md-6">
                      <div class="rating-list">
                        <div class="r-title left">
                          <strong>Total Projects</strong>
                        </div>
                        <div class="rpercent right">
                          <strong>{{$datas['total_projects']}}</strong>
                        </div>
                      </div>
                       <div class="rating-list">
                        <div class="r-title left">
                          Open Projects
                        </div>
                        <div class="rpercent right">
                          {{$datas['open_projects']}}
                        </div>
                      </div>
                      <div class="rating-list">
                        <div class="r-title left">
                          Closed Projects
                        </div>
                        <div class="rpercent right">
                          {{$datas['closed_projects']}}
                        </div>
                      </div>
                    </div>
                    </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="title_three">Skills</div>
              <div class="tb20p">
                 @php($skills = explode(',', $datas["project"]->skills))
                  <span class="blueclr"><i class="fa fa-tags"></i></span>
                  @foreach($skills as $skill)
                      <span><a href="{{url('/projects/tags/'.$skill)}}" class="skill_list">{{$skill}}</a></span>
                      @endforeach
              </div>
              <div class="title_three btm15m">Project Category : <a href="{{$datas['project_url']}}" class="blueclr italic">{{$datas['project_category']}}</a></div>
              <div class="btm15m">
                @if(isset(Auth::guard('employee')->user()->firstname))
                <a href="{{url('/employee/projectapply/'.$datas["project"]->seo_url)}}" class="btn lightgreen_gradient" style="min-width:200px;">Bid Now</a>
                @else
                <a class="btn lightgreen_gradient" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo">Get Login to Bid Project</a>
                @endif
             
            </div>
            @if(count($datas['bids']) > 0)
           <!--  Bidder list started here -->
              <div class="list_hd btm7m hidden-xs">
                <div class="row">
                  <div class="col-lg-5 col-md-6">
                   Current Bidders
                  </div>
                  <div class="col-lg-5 col-md-4">
                    Description
                  </div>
                  <div class="col-lg-2 col-md-2">
                    <span> Price(NRs.) </span>
                  </div>
                </div>
              </div>
              @foreach($datas['bids'] as $bid)
              <div class="list_block btm7m">
                  <div class="row">
                     <div class="col-lg-5 col-md-6">
                        <div class="row">
                          <div class="col-lg-5 col-md-5">
                            <div class="bidder_image">
                              <img src="{{asset(\App\Employees::getPhoto($bid->employees_id))}}">
                            </div>
                          </div>
                          <div class="col-lg-7 col-md-7">
                            <a href="{{url('/projects/bidder_detail/'.$bid->employees_id)}}" class="blueclr bold">{{\App\Employees::getName($bid->employees_id)}}</a>
                            <!-- <p class="blueclr">{{\App\EmployeeAddress::getPermanenet($bid->employees_id)}}</p> -->
                            <p>{{\App\ProjectApply::completionPercent($bid->employees_id)}}% Completion Rate</p>
                            <p><div class="star-ratings-sprite left" style="margin: 0px;"><span style="width:{{\App\EmployeeRating::getRating($bid->employees_id)}}%" class="star-ratings-sprite-rating"></span></div></p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-5 col-md-4">
                        <p>{{\App\Library\Settings::getLimitedWords($bid->description,0,25)}}</p>
                      </div>
                      <div class="col-lg-2 col-md-2">
                        NRs. {{$bid->amount}}
                      </div>
                  
                </div>
              </div>
              @endforeach
              @endif
            </div>

              <!-- Pagination started here -->
            <div class="row">
             
              <div class="col-md-12">
                <div class="float-right">
                <nav aria-label="Page navigation example">
                  <?php echo $datas['bids']->render();?>
                </nav>
              </div>
              </div>
            </div>
        <!-- pagination ended here -->
        <script type="text/javascript">

           $(".rating").click(function(){


          $(".rating-detail").fadeToggle();
      }); 
        </script>
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
  <div class="container rn_container">
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