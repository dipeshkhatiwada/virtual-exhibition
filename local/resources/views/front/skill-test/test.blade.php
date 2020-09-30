@extends('front.tender-master')
@section('header')
<style type="text/css">
  .get-question{
    position: relative;
    display: inline-block;
    min-height: 300px;
    text-align: center;
    vertical-align: middle;
    width: 100%;
    background: #ececec;
  }
  .mt45{
    margin-top: 130px; 
  }
</style>
<style type="text/css">
  #progressBar {
          width: 100%;
          margin: 10px auto;
          height: 22px;
          background-color: #0A5F44;
        }

        #progressBar div {
          height: 100%;
          text-align: right;
          padding: 0 10px;
          line-height: 22px; /* same as #progressBar height if we want text middle aligned */
          width: 0;
          background-color: #CBEA00;
          box-sizing: border-box;
        }

        .mask{
            display:none;
          position: absolute;
          top: 0px;
          left: 0px;
          right: 0px;
          bottom: 0px;
          z-index: 9;
          background: rgba(0,0,0,0.2);
          
        }
        .loading{
            
          margin: 50px auto;
          width: 50%;
          font-size: 18px;
          background: blue;
          color: #FFF;
          padding: 10px;
          text-align: center;
          z-index:99;
        }
        .loading .fa-spinner{
          font-size: 45px;
        }

        .right{
          float: right !important;
        }
        .test_answer{
          position: relative;
          
        }
        .bgblue{
          background: #23a2fa !important;
          color: #ffffff !important;
        }
        .bgred{
          background: #fa2323 !important;
          color: #ffffff !important;
        }
        .coment-message{
            display:none;
        }
        #buttons, #comments{
          display: none;
        }
        .test_answer ul li{
          cursor: pointer;
        }
        .bggreen{
          background: Green !important;
          color: #ffffff !important;
        }
</style>
 {!! csrf_field() !!}
<section class="rt_banner">
  <div class="container rn_container">
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
<!-- header part with navigation ended here -->
@stop
@section('banner')
<!-- banner section with search form ended here -->
@stop
@section('content')


<?php if (count($datas['right_content']) > 0) {
$class = 'col-md-6';
} else{
$class = 'col-md-9';
} ?>
<div class="modal fade" id="modal-coment">
          <div class="modal-dialog">
            <div class="modal-content">
              
              <form id="job-form" class="dash_forms" enctype="multipart/form-data">
                
                {!! csrf_field() !!}
              <div class="modal-body">
                
                  
               <input type="hidden" name="question_id" id="post_question_id" value="">
               <div class="alert alert-success coment-message"><strong id="comment-message"></strong></div>
             <div class="form-group">
                  <label class="col-md-12">Mark Answer</label>     
                <div class="col-md-12">
                  <select class="form-control" id="right_wrong">
                    <option value="1">Correct</option>
                    <option value="2">Incorrect</option>
                  </select> 
                                     
                 </div>
                                        
              </div>
              <div class="form-group" id="right_answer" style="display: none;">
                <label class="col-md-12">Right Answer</label>  
                <div class="col-md-12">
                  <select class="form-control" id="right_answers"></select>                     
                 </div> 
              </div>
              <div class="form-group" id="correct_answers" style="display: none;">
                <label class="col-md-12">Input the correct answer</label>  
                <div class="col-md-12">
                  <input type="text" name="correct_answer" id="correct_answer" class="form-control" value="">                  
                 </div> 
              </div>
              <div class="form-group">
                  <label class="col-md-12">Comment</label>     
                <div class="col-md-12">
                  <textarea class="form-control" name="comment" id="comment" required="required" placeholder="Comments"></textarea>
                                          
                 </div>
                                        
              </div>
                
                              
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                 <button class="btn sendbtn bluebg" onclick="postComment()" type="button">Submit <i class="fa fa-paper-plane"></i></button>
                
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
<section>
  <div class="container">
    <div class="white_div neg_margin">
      
        @if(count($datas['top_content']) > 0)

        <div class="row">
          <div class="col-md-12">
            @foreach($datas['top_content'] as $tcontent)
            <?php echo $tcontent['module']; ?>
            @endforeach
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
            <h2 class="title_two blueclr">@if($datas['test_image'] != '')
              <img src="{{asset($datas['test_image'])}}" height="60px">
            @endif {{$datas['test_title']}}</h2>
            <div class="row cm10-row tp30p">
             
            <div class="col-md-12">
              <div id="test-box">
              <div class="get-question">
                @if(isset(Auth::guard('employee')->user()->firstname))
                <a class="btn lightgreen_gradient mt45" onclick="getQuestion()" data-whatever="@mdo">Start Test</a>
                @else
                 <button type="button" class="btn individualbtn bluebtn mt45" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo"><span class="hidden-xs">Login To Start Test</span></button>
                 @endif
              </div>
            </div>
            </div>
            
            @foreach($datas['main_modules'] as $main_module)
            <?php echo $main_module['module']; ?>
            @endforeach
          </div>
          
         
          
        </div>
         <aside class="col-md-3">
              <div class="white_block lft_block tp20m">
              <h3 class="title_three btm10m">Test Categories</h3>
              <ul>
                @foreach($datas['category'] as $category)
                <li><a href="{{$category['url']}}"> {{$category['title']}}</a></li>
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
@php($question_url = url('/skill-test/test/get-question'))
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

function getQuestion() {
      var token = $('input[name=\'_token\']').val();
      
     
      $.ajax({
            type: "POST",
            url: "{{url('/skill-test/test/get-question')}}",
            data: '_token='+token,
            success: function(data){
              var datas = data.split('|||||');
             $('#test-box').html(datas[0]);
             $('#right_answers').html(datas[1])
            }
        });
      }

$('#right_wrong').on('change', function()
{
  var id = $(this).val();
  if(id == 2){
    $('#right_answer').fadeIn();
  } else{
    $('#right_answer').fadeOut();
  }
})

$('#right_answers').on('change', function()
{
  var id = $(this).val();
  if(id == '1none'){
    $('#correct_answers').fadeIn();
  } else{
    $('#correct_answers').fadeOut();
  }
})

</script>


@stop