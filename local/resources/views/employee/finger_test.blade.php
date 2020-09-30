@extends('employe_master')

@section('content')

<link rel="stylesheet" href="{{asset('js/typing_test/circletimer.css')}}">
<link rel="stylesheet" href="{{asset('js/typing_test/highlight.default.min.css')}}">
     <script src="{{asset('js/typing_test/circletimer.min.js')}}"></script>
      <script src="{{asset('js/typing_test/highlight.min.js')}}"></script>
 <div class="row cm-row tp10m">
            <div class="col-md-8">
              <div class="common_bg all15p">
                <h3 class="individual_title">Fast Finger Test: 
                <span>
                   <div class="switch">
                              <input type="radio" class="switch-input" name="view" value="english" id="english" checked>
                              <label for="english" class="switch-label switch-label-off">English</label>
                              <input type="radio" class="switch-input" name="view" value="nepali" id="nepali">
                              <label for="nepali" class="switch-label switch-label-on" id="NEP" >नेपाली</label>
                              <span class="switch-selection"></span>
                          </div>
                </span>
                </h3>
                <div class="row">
                  <div class="col-md-4">
                    <div id="timer_rohit">
                              <label>
                                <span class="individual_title">Time Left : </span>
                                <span class="light_green"><span id="time-elapsed" class="typing_timer">60</span>&nbsp&nbsp sec.</span>
                              </label>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="example">
                            <div id="example-timer" style="color: red;">
                              
                            </div>
                        </div>  
                    </div>
                  </div>
                                 <div class="form-group">

                                    <div class="panel panel-success">
                        
                                        <div class="panel-heading typing_head">
                                           <center><span style="color:#003300 ; font-size:22px ; font-family:Monospace">Test how fast are your fingers ??</span></center>
                                        </div>
                        
                                        <div class="panel-body">
                                            <div id="display_space"style="border:1px solid white;height:160px;overflow:hidden">
                                                <p id ="display" style="padding:10px ; text-align:center ; font-size:28px ; line-height:170%; font-family:Times New Roman"></p>
                                            </div>
                                        </div>
                        
                                        <div class="panel-footer">
                                            <div class="form-group typing_form">
                                                <textarea class="form-control" placeholder="press any key to begin" rows="1" wrap="off" id="typing_space" style="font-size:25px ; padding10px; text-align:center;"></textarea>
                                            </div>
                                        </div>
                        
                                    </div>
                    
              </div>
            </div>

            
            </div>
            <div class="col-md-4">
              <div class="ind_dash_head">
                Finger Test Detail (English)
              </div>
              <div class="all10p">
                 <div class="progress-group">
                                    <span class="progress-text">Your Rank/Total Test Takers</span>
                                    <span class="progress-number"><b>{{$datas['eng_rank']}}</b>/{{$datas['total_eng_test']}}</span>
                
                                    <div class="progress sm">
                                      <div class="progress-bar progress-bar-aqua" style="width: {{$datas['eng_rank_percent']}}%"></div>
                                    </div>
                                  </div>
                                  <!-- /.progress-group -->
                                  <div class="progress-group">
                                    <span class="progress-text">Your Attempt/Highest Scorer's Attempt</span>
                                    <span class="progress-number"><b>{{$datas['eng_attempt']}}</b>/{{$datas['eng_topper_attempt']}}</span>
                
                                    <div class="progress sm">
                                      <div class="progress-bar progress-bar-red" style="width: {{$datas['eng_attempt_percent']}}%"></div>
                                    </div>
                                  </div>
                                  <!-- /.progress-group -->
                                  <div class="progress-group">
                                    <span class="progress-text">Your Score/Highest Score</span>
                                    <span class="progress-number"><b>{{$datas['eng_score']}}</b>/{{$datas['eng_top_score']}}</span>
                
                                    <div class="progress sm">
                                      <div class="progress-bar progress-bar-green" style="width: {{$datas['eng_score_percent']}}%"></div>
                                    </div>
                                  </div>

                        <div class="ind_subhead">
                          Finger Test Detail (Nepali)
                        </div>
                                  <div class="progress-group">
                                    <span class="progress-text">Your Rank/Total Test Takers</span>
                                    <span class="progress-number"><b>{{$datas['nep_rank']}}</b>/{{$datas['total_np_test']}}</span>
                                    <div class="progress sm">
                                      <div class="progress-bar progress-bar-aqua" style="width: {{$datas['nep_rank_percent']}}%">
                                      </div>
                                    </div>
                                  </div>
                                  <!-- /.progress-group -->
                                  <div class="progress-group">
                                    <span class="progress-text">Your Attempt/Highest Scorer's Attempt</span>
                                    <span class="progress-number"><b>{{$datas['nep_attempt']}}</b>/{{$datas['nep_topper_attempt']}}</span>
                                    <div class="progress sm">
                                      <div class="progress-bar progress-bar-red" style="width: {{$datas['nep_attempt_percent']}}%">
                                      </div>
                                    </div>
                                  </div>
                                  <!-- /.progress-group -->
                                  <div class="progress-group">
                                    <span class="progress-text">Your Score/Highest Score</span>
                                    <span class="progress-number"><b>{{$datas['nep_score']}}</b>/{{$datas['nep_top_score']}}</span>
                
                                    <div class="progress sm">
                                      <div class="progress-bar progress-bar-green" style="width: {{$datas['nep_score_percent']}}%"></div>
                                    </div>
                                  </div>
                                  
                                  @if(isset($datas['current_score']))
                                  <div class="testreport_list">
                                  <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                      <b>Correct</b> <a class="pull-right">{{$datas['current_score']['correct']}}</a>
                                    </li>
                                    <li class="list-group-item">
                                      <b>Incorrect</b> <a class="pull-right">{{$datas['current_score']['incorrect']}}</a>
                                    </li>
                                    <li class="list-group-item">
                                      <b>Keystroks</b> <a class="pull-right">{{$datas['current_score']['keystrokes']}}</a>
                                    </li>
                                     <li class="list-group-item">
                                      <b>Accuracy</b> <a class="pull-right">{{$datas['current_score']['accuracy']}}</a>
                                    </li>
                                     <li class="list-group-item">
                                      <b>Words per minute</b> <a class="pull-right">{{$datas['current_score']['wpm']}}</a>
                                    </li>
                                  </ul>
                                  </div>
                                @endif
                
                            
                        </div>
                                
                                
                                
                    </div>
          </div>
  
  <script type="text/javascript">
  
    $(document).ready(function(){
        initialize();
    });

// FOR TIMER 
        var time_left = 60;
        var arr;      // to hold the string
        var arr_pointer = 0;
        var correct = 0;
        var incorrect = 0;
        var n = 0;
        var keystrokes = 0;
        var accuracy = 0;
        var stop;

        function timer()
        {
             var element = document.getElementById("time-elapsed"); 
             element.innerHTML = time_left;

             time_left--;

             if(time_left==-1)
             {
              accuracy = Math.floor(correct/(correct+incorrect) * 100);
              clearTimeout(stop);
                document.getElementById('typing_space').value = "time's up...";
                //"Correct = " + correct + " Incorrect = " + incorrect + "Keystrokes =" + keystrokes + "Accuracy : " + accuracy + "%";
                var wpm = correct - (incorrect/2);
                if(wpm<0)
                  wpm=0;

               

              $('input[type="text"], textarea').attr('readonly','readonly');
                store_performance(wpm, correct, incorrect, keystrokes, accuracy);

                /*$('#wpm').html(wpm);
                $('#correct').html(correct);
                $('#incorrect').html(incorrect);
                $('#keystrokes').html(keystrokes);
                $('#accuracy').html(accuracy);
                $('#current_row').fadeIn(); */
               
                //document.getElementById('display').innerHTML = "Correct = " + correct + " Incorrect = " + incorrect + "Keystrokes =" + keystrokes + "Accuracy : " + accuracy + "%";
             }
             else
             {
                 stop = setTimeout('timer()' , 1000);
             }

             if(time_left<=15)
             {
              element.style.color='red';
             }
        } 

        function initialize()
        {
            // displaing the string
            //var text = get_string();
            //var text = "Fashion mostly refers to the style of clothing worn at a particular time clothing at its most basic is to keep us warm but it serves many other functions. It needs to fit the customs and norms of society. Clothing needs to be accepted as more or less 'normal'. It needs, for instance, to preserve decency.";
        //var l = text.length;

        var array = new Array();
        array[0] = "page was first attracted to computers when he was six years old as he was able to play with the stuff lying around first generation personal computers that had been left by his parents he became the kid in his elementary school to turn in an assignment from a word processor his older brother also taught him to take things apart and before long he was taking everything in his house apart to see how it worked he said that from a very early age i also realized i wanted to invent things so i became really interested in technology and business";
        array[1] = "fashion mostly refers to the style of clothing worn at a particular time clothing at its most basic is to keep us warm but it serves many other functions it needs to fit the customs and norms of society clothing needs to be accepted as more or less normal it needs for instance to preserve decency";
        array[2] = "the bermuda triangle also known as the devils triangle is a loosely defined region in the western part of the north atlantic ocean where a number of aircraft and ships are said to have disappeared and the name is not recognized by the US Board on geographic names  he would review period newspapers of the dates of reported incidents and find reports on possibly relevant events like unusual weather that were never mentioned in the disappearance stories";
        array[3] = "social media has come a long way in Nepal and its penetration is growing rapidly  while there were 86 million social network users in Nepal in 2013 this number is expected to touch 197 million active shop at many Nepaln stores at one place and we aim to house designer brands from Nepal in the forthcoming months the products that will be available at Ownow are relatively exclusive and plenty of each is imported for the entire country";
        array[4] = "in this section you describe where you grew up what impact your family and community had on you your first and best friends your education and early work experiences this is not a resume type of listing  but focuses on the aha moments of insights ouch pain points to solve and inspirational messages from mentors and influencers many of these have a conscious or sub conscious impact on your attitudes values and behaviours and this section of the canvas helps you understand how you became who you are today";
        array[5] = "this is also about Nepalese business and thinking processes he adds pointing to the frameworks and case studies of jugaad and frugal innovation business writers in Nepal will have the world reading them he believes that the only way to solve this is by helping women get online and sell home cooked food to consumers according to vinodh most of the women are unable to go out for employment because of various reasons this makes them financially dependent on their parents children and husband";
        array[6] = "the venture plans to take off with its consumer marketplace in phases with the app to be launched this october the company is also planning to go global with its partnerships and has commenced work with but there has been a major shift in their consumption patterns as well as attitudes the silver surfers dont see the need to hoard savings anymore as the next generation does not want or need to depend on their wealth this leaves them free to spend all that money on their own comforts";
        array[7] = "it was after completing a two year stint at sapient that the desire to start a start up grew even stronger even while at sapient she made sure that she had a know how of different things so she got down gone are the days when three generations of a family lived under the same roof with the elderly passing on the reins of the household as well as their special needs to their children with migration nuclear families are becoming the norm and the elderly are mostly left to fend for themselves";
        
        var flag=0;

        while(flag!=1)
        {
          var x = Math.floor((Math.random() * 10) + 1);
          if(x>=0 && x<=7)
          {
            flag=1;
          }
        }

        var text = array[x];

        var to_display = "";

        arr = text.split(" ");
        var l = arr.length;
        var count = 0;

        while(l > 0)
        {
          l=l-6;
            for(var i=0 ; i<6;i++)
               {
                   to_display +=  "<span id='"+count+"' class='untyped'; border-radius:10%'>" + arr[count++] + "</span> ";
               }
               to_display+="</br>";
        }      
      var element = document.getElementById("display");
      element.innerHTML = to_display;

      var element = document.getElementById("time-elapsed"); 
            element.innerHTML = 60;

            $('input[type="text"], textarea').attr('readonly',false);
            document.getElementById('typing_space').value = "";

            check = 0;
            time_left = 60;
            arr_pointer = 0;
            correct = 0;
            incorrect = 0;
            n = 0;
            keystrokes = 0;
 
            var element = document.getElementById("time-elapsed");           
            element.style.color='green';

            clearTimeout(stop);

     }

    // FOR CLEARING THE TEXT-AREA
 
    window.addEventListener("keydown", dealWithKeyboard, false);

    function dealWithKeyboard(e)
    {
      if(e.keyCode == 32)
      {
          if(time_left>0){
              var element = document.getElementById("typing_space");
              var word = element.value;
              keystrokes += word.length;
              keystrokes++;

              //  form the boundry for the current element
              var save1 = n+1;
              $('#'+save1).addClass('focus');
              $('#'+n).removeClass('focus');
              
              if(word.trim().localeCompare(arr[arr_pointer])==0)
              {
                correct++;
                $('#'+n).removeClass('untyped').addClass('correct');
                n++;
              }
              else
              {
                incorrect++;
                $('#'+n).removeClass('untyped').addClass('incorrect');
                n++;
              }
              element.value = "";

              if((arr_pointer+1)>6 && (arr_pointer+1)%6==0)
              {
                scroll();
              }
              arr_pointer++;
          }
      }
    }


    // function to scroll the display_space
    function scroll()
    {
      var current_pos = $("#display_space").scrollTop();
        $("#display_space").scrollTop(current_pos + 49);  
    }
    

    // start the timer as soon as the user presses a charecter key
    var check = 0;
    $('#typing_space').keypress(function (event){
      if(event.keyCode!=32 && check!=1){
        check = 1;
        $('#0').addClass('focus');
      
        timer();
        $("#example-timer").circletimer("start");
    }
    });


    $(document).on("ready", function() {
        $("#example-timer").circletimer({
         // onComplete: function() {
           // alert("Time is up!");
          //},
          //onUpdate: function(elapsed) {
            //$("#time-elapsed").html(Math.round(elapsed));
          //},
          timeout: 60000    // 1 min timer
        });
    });

    $('#restart').click(function(){
          $("#example-timer").circletimer({
              // onUpdate: function(elapsed) {
            //$("#time-elapsed").html(Math.round(elapsed));
          //},
          timeout: 60000    // 1 min timer
    }); 
    });

    document.getElementById("example-timer").style.color = "red";

    function store_performance(wpm, correct, incorrect, keystrokes, accuracy)
    {
      var token = $('input[name=\'_token\']').val();

      $.ajax({
            type: "POST",
            url: "{{ url('employee/finger_test') }} ",
            data: 'wpm='+wpm+'&_token='+token+'&correct='+correct+'&incorrect='+incorrect+'&keystrokes='+keystrokes+'&accuracy='+accuracy,
            success: function(data){
        
              location = '{{url("employee/finger_test")}}';
        
            }
        });
    }
    
    $('#NEP').on('click', function(){
      var token = $('input[name=\'_token\']').val();

      $.ajax({
            type: "POST",
            url: "{{ url('employee/finger_test/change_language') }} ",
            data: 'language=Nepali&_token='+token,
            success: function(data){
        
              location = '{{url("employee/finger_test")}}';
        
            }
        });
    });
    

</script>
  
  
@stop()