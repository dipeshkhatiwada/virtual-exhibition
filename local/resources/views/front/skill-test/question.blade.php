

<div class="test_question greybg tp20m">
  <strong>{{$datas['question_status']}}</strong>
</div>
<input type="hidden" id="time-second" value="1">
<div id="progressBar">
        <div class="bar"></div>
      </div>
<div class="test_question bluebg">
@php($question_id = $datas['question']->id)

  Q. {{$datas['question']->question}}
  @if(isset($datas['question_image']))
  <img src="{{$datas['question_image']}}" style="width: 100%;">
  @endif
</div>
<div class="test_answer">
  <div class="mask"><div class="loading">Loading...   Please Wait  </br> <i class="fa fa-spinner fa-spin"></i></div></div>
  <ul>
    @php($i = 1)
    @foreach($datas['answer'] as $key => $answer)
    @if($answer->correct == 1)
    @php($answer_id = 'answer_'.$i)
    @else
    @php($answer_id = 'answer_15')
    @endif

    <li id="{{$answer_id}}" onclick="answerClick('{{$i}}','{{$answer->correct}}','{{$question_id}}','{{addslashes(htmlspecialchars($answer->title))}}',$(this))">{{$answer->title}}</li>
    @php($i++)
    @endforeach
   
  </ul>
</div>
<div id="buttons" class="tb20p">
  <a href="javascript:void(0)" class="btn bluebtn" onclick="addComment()">Comment</a>
  @if($datas['number_of_question'] == $datas['question_count'])
  <a href="javascript:void(0)" class="btn lightgreen_gradient right" onclick="finishTest()">Next</a>
  @else
  <a href="javascript:void(0)" class="btn lightgreen_gradient right" onclick="getQuestion()">Next Question</a>
  @endif
</div>
@if(count($datas['comments']) > 0)
<div id="comments">
<!-- Comment Section -->
<h2 class="title_three blueclr italic btm15m">Comments</h2>
@foreach($datas['comments'] as $comment)
<div class="list_block btm7m">
  <div class="row">
    <div class="col-md-1 col-sm-1 col-3">
      <div class="comment_image">
        <img src="{{$comment['image']}}">
      </div>
    </div>
    <div class="col-md-11 col-sm-11 col-9">
      <h2 class="title_two btm7m">{{$comment['name']}}</h2>
      @if($comment['right_wrong'] == 2)
      <span><strong>Right or Wrong:</strong></span> Wrong <span><strong>Right Answer:</strong></span> {{$comment['right_answer']}}
      @endif
      <p>{{$comment['comment']}}</p>
      
     
    </div>
  </div>
</div>
@endforeach
</div>
@endif
@php($answer_url = url('/skill-test/submit-answer'))
@php($finish_url = url('/skill-test/finish-test'))
@php($comment_url = url('/skill-test/post-comment'))
<script type="text/javascript">
 
    
   var duration = '';
   var prun = 1;

   

var totaltime = '{{$datas["question"]->time_second}}';


    function progress(timeleft, timetotal, $element) {
        var progressBarWidth = timeleft * $element.width() / timetotal;
        $element.find('div').animate({ width: progressBarWidth }, 500).html(Math.floor(timeleft/60) + ":"+ timeleft%60);
        if(timeleft > 0) {
            setTimeout(function() {
              duration = timeleft - 1;
                if(prun == 1){
                progress(timeleft - 1, timetotal, $element);
                $('#time-second').val(timeleft - 1);
                    }

            }, 1000);
        } else{
         
             $('.loading').html('<i class="fa fa-clock"></i> Time Up </br> Please Wait for next question.  </br> <i class="fa fa-spinner fa-spin"></i>')
            answerClick('','','{{$question_id}}','');
                    
          }
    };

    progress(totaltime, totaltime, $('#progressBar'));
    
    function answerClick(answer,right,question_id,title,eee = ''){
        $('.mask').fadeIn();
         var token = $('input[name=\'_token\']').val();
         if(eee != ''){
         if(right == 2){
          eee.addClass('bggreen');
         } else{
          eee.addClass('bgred');
          $('#answer_15').addClass('bggreen');
          
         }
       }
          
          var duration = $('#time-second').val();
         prun = 11;
      $.ajax({
            type: "POST",
            url: "{{$answer_url}}",
            data: '_token='+token+'&question_id='+question_id+'&answer='+answer+'&wright='+right+'&title='+title+'&duration='+duration,
            success: function(data){
              if(data == 'Success'){
                $('#comments').fadeIn();
                $('.loading').fadeOut();
                $('#buttons').fadeIn();
              } else{

              }
            }
        });
    }
    
    function finishTest()
    {
        var url = "{{$finish_url}}";
        location = url;
    }
    
    function addComment()
    {
        var question_id = '{{$question_id}}';
        
                  $('#post_question_id').val(question_id);
                  $('#correct_answer').val('');
                  
                  $('right_wrong').val(1).select();
                  $('#right_answer').fadeOut();
                  $('#correct_answers').fadeOut();
        $('#modal-coment').modal('show');
         $('.coment-message').fadeOut();
    }
    
    function postComment()
    {
        var question_id = '{{$question_id}}';
        
  var right_answer = $('#right_answers').val();
  var right_wrong = $('#right_wrong').val();
  var coment = $('#comment').val();
  var token = $('input[name=\'_token\']').val();
  var correct_answer = $('#correct_answer').val();
  
        
        if(question_id != '' && coment != '')
        {
            $(this).html('Loading...');
             $.ajax({
            type: "POST",
            url: "<?php echo $comment_url;?>",
            data: '_token='+token+'&question_id='+question_id+'&coment='+coment+'&right_wrong='+right_wrong+'&right_answer='+right_answer+'&correct_answer='+correct_answer,
            success: function(data){
              var datas = data.split('||');
              if (datas[0] == 'Success') {
                 $(this).html('Submit');
                  $('#comment-message').html(datas[1]);
                  $('#correct_answer').val('');
                  $('#right_answers').html('');
                  $('right_wrong').val(1).select();
                  $('.coment-message').fadeIn();
                  setTimeout(function(){
                        $('#modal-coment').modal('hide');
                    }, 50000);
                  
              } else{
                $('#comment-message').html(datas[1]);
                  $('.coment-message').fadeIn();
              }
           
            }
        });
        } else{
          alert('Comment is required');
        }
    }
  </script>