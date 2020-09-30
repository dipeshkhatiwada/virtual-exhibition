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
                              <label for="english" id="ENG" class="switch-label switch-label-off">English</label>
                              <input type="radio" class="switch-input" name="view" value="nepali" id="nepali" checked="checked">
                              <label for="nepali" class="switch-label switch-label-on" id="NEP" >नेपाली</label>
                              <span class="switch-selection"></span>
                          </div>
                          
                          <div class="download">
                <a href="{{asset('image/preeti.zip')}}" download="download" class="btn whitegradient redclr right">Download Preeti Font <i class="fa fa-cloud-download-alt"></i></a>
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
                                           <center><span style="color:#003300 ; font-size:22px ; font-family:Monospace">तपाइँको औंलाहरू कति छिटो छन् परीक्षण गर्नुहोस् ??</span></center>
                                        </div>
                        
                                        <div class="panel-body">
                                            <div id="display_space"style="border:3px solid white;height:150px;overflow:hidden">
                                                <p id ="display" style="padding:10px ; text-align:center ; font-size:28px ; line-height:170%; font-family:Preeti;"></p>
                                            </div>
                                        </div>
                        
                                        <div class="panel-footer">
                                            <div class="form-group typing_form">
                                                <textarea class="form-control" placeholder="सुरू गर्न कुनै कुञ्जी थिच्नुहोस्" rows="1" wrap="off" id="typing_space" style="font-size:25px ; padding10px; text-align:center; font-family:Preeti;"></textarea>
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
              <div class="common_bg all10p">
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
                                      <div class="progress-bar progress-bar-aqua" style="width: {{$datas['nep_rank_percent']}}%"></div>
                                    </div>
                                  </div>
                                  <!-- /.progress-group -->
                                  <div class="progress-group">
                                    <span class="progress-text">Your Attempt/Highest Scorer's Attempt</span>
                                    <span class="progress-number"><b>{{$datas['nep_attempt']}}</b>/{{$datas['nep_topper_attempt']}}</span>
                
                                    <div class="progress sm">
                                      <div class="progress-bar progress-bar-red" style="width: {{$datas['nep_attempt_percent']}}%"></div>
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
         array[0] = "ljZj dfgj–;d'bfosf] ljsf; dfgj–dl:tisdf km'g]{ ljrf/s} pkh xf] . ;[li6sfnb]lv g} dfgj–ljrf/n] dxTjk\"0f{ :yfg kfPsf] 5 . ha s'g} ;fgf] jf 7\"nf] ;d:of cfpF5, ljrf/sf dfWodaf6 ;dfwfg vf]lhG5 / ;dfwfg x'G5 . o;/L g} ljZj dfgj–ljsf;sf qmddf k|To]s If]qdf cfPsf / cfOkg]{ ;d:ofx¿ To;} If]qdf ;dfwfg x'Fb} uPsf sf/0fn] klg ljZj dfgj–ljsf;n] of] ljsl;t ¿k kfPsf] xf] . ";
        array[1] = "ljrf/ jf bz{g ;dosf] dfucg';f/ pTkGg x'G5g\\ . To:tf ljrf/x¿n] ;don] NofPsf] ;d:ofsf] ;dfwfg klg ub}{ uPsf x'G5g\\ . ljrf/ ljifodf ¿kfGtl/t ePkl5 ljifon] 1fgsf dfWodåf/f JofVof vf]Hb} :yflkt x'g vf]H5 . 1fgsf dfWodåf/f ljrf/ k|lti7flkt x'g ;S5 . 1fgsf] lg/Gt/ cWoogåf/f ljrf/ ljZn]lift / k|dfl0ft x'Fb} lj1fgsf] ¿k wf/0f u5{ . ";
        array[2] = "e|i6frf/sf] pTklQsf] s]Gb|ljGb' g} dfgj dl:t:s ePsf] x'Fbf dfgj ;dfhdf e|i6frf/ x'G5 / 5 . e|i6frf/ lgolGqt x'G5 / x'g;S5 . To;sf] nflu s8f sfg'gsf] cfjZostf k5{ . oL tLg sf/0fdf g} ljZjsf e|i6lj/f]wL cleoGtfx? cndlnP/ a;] . t/, sfg'gn] dfq e|i6frf/ lgoGq0f x'g ;Sb}g eGg] xfdLn] a'em]kl5 of] ljifonfO{ lzIf0f ;+:yf jf ljZjljBfnox?df cWoog ;'? ug{ u/fpg e|i6lj/f]wL zf:qsf] cfjZos dx;\"; eof] .";
        array[3] = "o;} u/L e|i6frf/lj?4sf] lj1fgsf ¿kdf :yflkt of] e|i6lj/f]wL zf:q ef}lts / /;fogzf:qh:tf] s7f]/ lj1fg aGg g;s] klg of] cGo ;fdflhs lj1fgh:t} /fhgLltzf:q, cy{zf:q / ;dfhzf:qh:tf] g/d lj1fg xf] eGg ;lsG5 . k|of]u, k/LIf0f, ;fª\\lVosL / ul0ftLo pkfudx¿nfO{ o; e|i6lj/f]wL zf:qdf ljZn]if0f / JofVof ul/Psf] 5 . To;af6 klg of] zf:q lj1fgsf] sf]l6df pleg / lrlgg k'u]sf] 5 . ";
        array[4] = "dfgj–hLjgsf] ljsf;sf qmddf ;do / ;dfhn] cfjZos dx;'; u/]sf] ljifonfO{ ulx/f] cWoogsf dfWodåf/f pTkflbt dfu{lgb]{zg g} of] ljifosf nflu l;4fGt 7x/ ePsf] x'G5 . o;/L l;4fGt pTkfbg x'g To;sf] cfjZostfsf] af]w, ;dfhsf tt\ ;dosf lrGtgzLn JolStx¿n] To;sf] cfjZostf dx;'; u/]kl5 ;d:of ;dfwfgsf nflu ljifosf] lj:t[t cWoog ug]{ sfo{ x'G5 . To:tf] cfjZos ljifosf] 1fgsf dfWodåf/f qmda4 tyf lj:t[t cWoog u/]/ k|fdfl0fs ¿kdf ljifonfO{ :yflkt ug'{nfO{ g} ljifout lj1fgsf] :yfkgf ePsf] elgG5 . lj1fg elgPsf] ljifo 1fgsf] PsLs[t e08f/ xf], hf] ;\"Id ¿kn] cWoog, ljlwjt\\ k/LIf0f tyf lj:t[t JofVofåf/f lgdf{0f ePsf] x'G5 . of] e|i6lj/f]wL zf:q o;} df}lns l;4fGtsf cfwf/df v8f ePsf] 5 .";
        array[5] = "e|i6frf/ k\"0f{ ¿kn] ;fdflhs ;d:of xf] . ;dfhn] g} o:tf] ;d:ofsf] lhDdf lng'k5{ . lsgeg] ;dfh dfG5]x¿sf] ;Ë7g xf] . To;}n] dfG5]x¿nfO{ ;fdflhs k|f0fL elgPsf] xf] . ;dfhsf] pTyfg / ktg To; ;dfhdf a;f]af; ug]{ dfG5]sf] sfo{ / Jojxf/n] to u/]sf] x'G5 . ;dfhdf s'g} lsl;dsf] ljs[lt km}lnof] eg] To;sf] lhDdf klg ;dfhn] g} lng'k5{ . ;dfhsf] Ps cËdf e|i6frf/ ePdf ;dfhsf] csf]{ cËn] va/bf/L hgfpg'k5{ . of] k|s[ltsf] lgod xf] . e|i6frf/ ug]{ sfo{ dfgj–ljsf;sf] cj/f]ws xf] / ;dfh–ljsf;sf] klg afws xf] . o;sf] lg/fs/0f / ;dfwfgsf nflu gjLg ljrf/ tyf l;4fGtsf] cfjZostf lyof] . Tof] cfjZostfsf] k\"lt{ of] e|i6lj/f]wL zf:qn] ug]{ ePsf] 5 . ";
        array[6] = "ljZjsf] k|fl1s If]qdf gjLg ljrf/ tyf l;4fGtsf ¿kdf k|:t't of] e|i6lj/f]wL zf:q lgtfGt cWoogsf] ljifo 7x/ ePsf] 5 . o;sf] cWoogljgf ca dfgjlxt / dfgj–ljsf;sf nflu th'{df x'g] s'g} klg of]hgf jf sfo{of]hgf ;kmntfsf] ljGb'df k'Ug ;St}g eGg] klg :ki6 ePsf] 5 . ;fy}, /fHosf] Joj:yfkgnfO{ r'gf}tL lbg] cg]s lsl;dsf cg'lrt sfo{ / e|i6frf/hGo sfo{nfO{ /f]Sg klg of] gjLg ljrf/ tyf l;4fGtn] ce\"tk\"j{ ;kmn sfo{ ug{ ;S5 eGg]df ljZjf; ug{ ;lsG5 . ;fy}, /fhgLlts bnx¿sf 5f8f lqmofsnfksf] cGt klg of] e|i6lj/f]wL zf:qn] ug{ ;dy{ x'g]5 . ";
        array[7] = ";ª\If]kdf eGg'kbf{ of] e|i6lj/f]wL zf:qsf] sfd s;}n] s'g} cg'lrt tyf e|i6frf/hGo sfo{ u/]sf]df lj/f]wL kIfdf pleP/ lj/f]w ug'{ dfq xf]Og . o;sf] d\"n p2]Zo t ;dfhdf ;bfrf/o'St Jojxf/ sfod ug]{ jftfj/0f tof/ ug]{ sfo{df ;3fp k'¥ofpg' xf] . JolStsf] b}lgs hLjgdf b]lvg] c;dfg / cg'lrt sfo{, ;d'bfodf km}ng ;Sg] b'u'{0fo'St Jojxf/, Joj;foLx¿df n's]/ /xg] gfkmfvf]/L sfo{, /fHok|zf;gdf 6fFl;P/ a:g] e|i6frf/o'St sfo{ tyf /fhgLlts If]qdf x'g] cj;/jflbtf h:tf b'u{'0fx¿nfO{ s]nfP/ / ljZn]if0f u/]/ ;To / c;To 5'6\\ofpg ;Sg] Ifdtf e|i6lj/f]wL zf:qdf /x]sf] 5 . To;sf nflu o;sf] dd{, d\"No / cfjZostfnfO{ a'em]/ ;DalGwt cWoog s]Gb| tyf ljZjljBfnox¿n] cWoog–cWofkgsf nflu jftfj/0frflxF tof/ ug'{k5{ . of] gjLg ljrf/ tyf l;4fGt ;dosf] dfucg';f/ cWoog–cWofkgsf nflu tof/ ePsf] 5 . ";
        
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
    
    $('#ENG').on('click', function(){
      var token = $('input[name=\'_token\']').val();

      $.ajax({
            type: "POST",
            url: "{{ url('employee/finger_test/change_language') }} ",
            data: 'language=English&_token='+token,
            success: function(data){
        
              location = '{{url("employee/finger_test")}}';
        
            }
        });
    });
    

</script>
  
  
@stop()