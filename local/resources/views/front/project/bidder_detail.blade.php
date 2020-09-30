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

<section>
  <div class="container rn_container">
    <div class="white_div neg_margin">
      <div class="row">
       <div class="col-md-9">
            <!-- table view of project list started here -->
            <div class="tb20p">
              <div class="row">
                
                <div class="col-md-3">
                  <div class="profile_image">
                    <img src="{{asset(\App\Employees::getPhoto($datas['bidder']->id))}}">
                  </div>
                </div>
               
               
                <div class="col-md-9">
                  <h1 class="title_one btm7m">{{$datas['bidder']->firstname}}</h1>
                  <h2 class="title_two btm7m">{{$datas['bidder']->professional_heading}}</h2>
                  <div class="title_three">My profile</div>
                  <div class="blueborder tp5m"></div>
                  <div class="paragraph">
                    <p><?php echo $datas['bidder']->description;?></p>
                  </div>
                  <a href="#" class="btn lightgreen_gradient btm7m">Hire me</a> 
                  <div class="reviews btm15m">
                    <p><div class="star-ratings-sprite left" style="margin: 0px;"><span style="width:{{\App\EmployeeRating::getRating($datas['bidder']->id)}}%" class="star-ratings-sprite-rating"></span></div></p>
                  </div>
                </div>
              </div>
            </div>


              @if(isset(Auth::guard('employer')->user()->id) || isset(Auth::guard('employee')->user()->firstname))
              <div class="list_block btm7m">
                 <form id="ratingsForm" method="post" action="{{url('/projects/bidder_detail/comment')}}" class="dash_forms" enctype="multipart/form-data">
                  {!! csrf_field() !!}
                  <input type="hidden" name="bidder_id" value="{{$datas['bidder']->id}}">
                    <div class="form-group row {{ $errors->has('comment') ? ' has-error' : '' }}">
                         <label for="employer" class="col-md-1 rating-label required">Comment</label>
                            <div class="col-md-11">
                                  <textarea class="form-control" name="comment">{{old('comment')}}</textarea>
                                  @if ($errors->has('comment'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('comment') }}</strong>
                                  </span>
                                  @endif
                            </div>
                    </div>
                   <div class="form-group row {{ $errors->has('rating') ? ' has-error' : '' }}">
                            <label for="employer" class="col-md-1 rating-label required">Rating</label>

                            <div class="col-md-11">
                              <div class="stars" style="margin-left: 5px; float: left;">
                                <input type="radio" name="rating" class="star-1" id="star-1" value="1" />
                                <label class="star-1" for="star-1">1</label>
                                <input type="radio" name="rating" class="star-2" id="star-2" value="2" />
                                <label class="star-2" for="star-2">2</label>
                                <input type="radio" name="rating" class="star-3" id="star-3" value="3" />
                                <label class="star-3" for="star-3">3</label>
                                <input type="radio" name="rating" class="star-4" id="star-4" value="4" />
                                <label class="star-4" for="star-4">4</label>
                                <input type="radio" name="rating" class="star-5" id="star-5" value="5" />
                                <label class="star-5" for="star-5">5</label>
                                <span></span>
                            </div>
                            @if ($errors->has('rating'))
                            <span class="help-block">
                                <strong>{{ $errors->first('rating') }}</strong>
                            </span>
                            @endif
                            </div>
                        </div>
                  <div class="form-group row">
                        

                            <div class="col-md-10">
                                  <button type="submit" class="btn bluebg sendbtn">Submit</button>
                            </div>
                    </div>
              </div>
              @endif
              <!-- review section started here -->
              @if(count($datas['bidder_comment']) > 0)
              <h2 class="title_three blueclr italic btm15m">Recent Reviews</h2>
               @foreach($datas['bidder_comment'] as $rating)
              <div class="list_block btm7m">
               
                @if($rating->types == 1)
                @php($image = \App\Employers::getPhoto($rating->comment_by))
                @php($comment_by = \App\Employers::getName($rating->comment_by))
                @else
                @php($image = \App\Employees::getPhoto($rating->comment_by))
                @php($comment_by = \App\Employees::getName($rating->comment_by))
                @endif
                <div class="row">
                 <div class="col-md-2">
                    <div class="bidder_image">
                      <img src="{{asset($image)}}">
                    </div>
                  </div>
                  <div class="col-md-10">
                    <h2 class="title_two btm7m">{{$comment_by}}</h2>
                    <p><?php echo $rating->description;?></p>

                    
                    <p class="bold tp10p"><div class="star-ratings-sprite left" style="margin: 0px;"><span style="width:{{$rating->rating * 20}}%" class="star-ratings-sprite-rating"></span></div></p>
                  </div>
                </div>
               
              </div>

               @endforeach
                <div class="row">
                <div class="col-xs-12">
                  <div class="dataTables_paginate paging_simple_numbers right">
                      <?php echo $datas['bidder_comment']->render();?>
                  </div>
                </div>
              </div>
              @endif
            @foreach($datas['main_modules'] as $main_module)
            <?php echo $main_module['module']; ?>
            @endforeach
          </div>
         

         <aside class="col-md-3">
            <div class="tb20p">
              <a href="#" class="btn lightgreen_gradient lr15p"><span class="bigfont">{{\App\ProjectApply::completionPercent($datas['bidder']->id)}}%</span> Job Completion</a>
            </div>
            <div class="topskills">
              <h3 class="title_three btm15m">My Top Skills</h3>
              <ul>
                @foreach($datas['bidder']->Skills as $skill) 
                <li>{{$skill->title}} 
                  @if($datas['endorse'])
                  @if(\App\UserCircle::checkEndorse($skill->id) == 0)
                 
                  @else
                  <button class="btn lightgreen_gradient right" type="button" id="skill-{{$skill->id}}" onclick="EndorseSkill({{$skill->id}})">Endorse</button>
                  @endif
                  @endif
                </li>
                @endforeach
              </ul>
            </div>
          @if (count($datas['right_content']) > 0)
          
            @foreach($datas['right_content'] as $rcontent)
            <?php echo $rcontent['module']; ?>
            @endforeach
          
          @endif


        </aside>
      
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
function EndorseSkill(skill_id) {
  var url = '{{url("/employee/endorse_skill")}}';
  var token = $('input[name=\'_token\']').val();
  $.ajax({
                type: 'POST',
                url: url,
                data: 'skill_id='+skill_id+'&_token='+token,
                cache: false,
                success: function(datas){
                 if(datas == 'Success'){
                  alert('Thank you');
                   $('#skill-'+skill_id).remove();
                 } else{
                  alert(datas);
                   

                }
                 }
            });
}
</script>
@stop