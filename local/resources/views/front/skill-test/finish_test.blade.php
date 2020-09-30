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
          background: #23a2fa;
          color: #ffffff;
        }
        .bgred{
          background: #fa2323;
          color: #ffffff;
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
            <h2 class="title_two blueclr">Total Marks: {{$datas['question_answer']->marks}}</h2>
            <div class="row cm10-row tp30p">
             
            <div class="col-md-12">
              <div id="test-box">
                @php($questions = json_decode($datas['question_answer']->questions))
              @foreach($questions as $question)
              <div class="row">
                <div class="col-md-12">
                  <div class="test_question bluebg">
                 

                    Q. {{$question->title}}
                    @if($question->image != '')
                    <img src="{{asset('/image/'.$question->image)}}" style="width: 100%;">
                    @endif
                  </div>


                  <div class="test_answer">
                    
                    <ul>
                      @foreach($question->answers as $key => $answer)
                      @if($answer->correct == 1)
                      @php($class = 'bgblue')
                      @endif
                      @if($answer->title == $question->answer_title)
                      @php($class = 'bggreen')
                      @endif

                      <li class="{{$class}}">{{$answer->title}}</li>
                      @endforeach
                      <li class="bggreen">{{$question->answer_title}}</li>
                    </ul>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            </div>
            
            @foreach($datas['main_modules'] as $main_module)
            <?php echo $main_module['module']; ?>
            @endforeach
          </div>
          
         
          
        </div>
         <aside class="col-md-3">
              
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
