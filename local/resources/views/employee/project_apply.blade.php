@extends('employe_master')
@section('content')
  <h3 class="form_heading">You are Applying for {{$data->title}}</h3>
  <div class="form_tabbar">
    @if(count($errors))
    <div class="row">
      <div class="col-xs-12">
        <div class="alert alert-danger">
          @foreach($errors->all() as $error)
          {{ '* : '.$error }}</br>
          @endforeach
        </div>
      </div>
    </div>
    @endif
    <div class="dash_forms">
      <div class="row">
        <div class="col-md-2 border-right">
          <p class="num-title black text-center">Bids</p>
          <p class="num-bids blue bold large-text text-center">{{count($data->Apply)}}</p>
        </div>
        <div class="col-md-2 border-right">
          <p class="num-title blck text-center">Avg Bid</p>
          <p class="num-bids blue bold large-text text-center">NPR. {{\App\ProjectApply::getAverage($data->id)}}</p>
        </div>
        <div class="col-md-4 border-right">
          <p class="num-title blck text-center">Budget</p>
          <p class="num-bids blue bold large-text text-center">NPR. {{$data->min_budget.' - '.$data->max_budget}}</p>
        </div>
        <div class="col-md-4">
          <p class="num-title text-center">{{$diff != '' ? $diff : ''}}</p>
          <p class="num-bids greenclr bold large-text text-center">{{$diff != '' ? 'OPEN' : 'CLOSED'}}</p>
        </div>
      </div>
    </div>
  </div>
  @php($percent = \App\library\Settings::getSettings()->project_commission)
  @php($amount = (($data->min_budget * $percent) / 100) + $data->min_budget)
  @php($fee = ($data->min_budget * $percent) / 100)
  <div class="form_tabbar">
    <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="{{url('/employee/project/saveapply')}}">
      <input type="hidden" name="project_id" value="{{$data->id}}">
      <input type="hidden" name="title" value="{{$data->title}}">
      <input type="hidden" id="percentage" value="{{$percent}}">
      <input type="hidden" name="amount" id="amount" value="{{$amount}}">
      <input type="hidden" id="min_budget" name="min_budget" value="{{$data->min_budget}}">
      <input type="hidden" name="milestone_amount" id="milestone_amount" value="">
      {!! csrf_field() !!}
     
      <div class="form-group row all10p">
        <div class="col-md-10 {{ $errors->has('bid_amount') ? ' has-error' : '' }}">
          <label class="required">Bid</label>
          <div id="bidbox" class="form-row">
          <label class="col-md-6">
            Paid To You:
          </label>
          <div id="bbox" class="col-md-6">
            <div  class="input-group {{ $errors->has('bid_amount') ? ' has-error' : '' }}">
              <input name="bid_amount" id="bid_amount" class="form-control" placeholder="1000" value="{{$data->min_budget}}" type="text">
              <span class="input-group-btn">
                <div class="bg-grey border-grey p7">NPR.</div>
              </span>
            </div>
            @if ($errors->has('bid_amount'))
            <span class="help-block">
              <strong>{{ $errors->first('bid_amount') }}</strong>
            </span>
            @endif
          </div>
          </div>
          <div class="form-row margin-top-10">
          <div class="col-md-6">
            Rolling Project Fee:
          </div>
          <div class="col-md-6">
           <span id="project_fee" class="bold black large-text">NPR. {{$fee}}</span>
          </div>
          </div>
           <div class="form-row margin-top-10">
          <div class="col-md-6">
            Your Bid:
          </div>
          <div class="col-md-6">
           <span id="your_bid" class="bold black large-text">NPR. {{$amount}}</span>
          </div>
          </div>
        </div>
        <div id="duration_box" class="col-md-2 {{ $errors->has('duration') ? ' has-error' : '' }}">
          <label class="required">Duration (In Days)</label>
          <input name="duration" id="duration" class="form-control" placeholder="10" value="{{old('duration')}}" type="text">
           @if ($errors->has('duration'))
            <span class="help-block">
              <strong>{{ $errors->first('duration') }}</strong>
            </span>
            @endif
        </div>
        
      </div>
      
<h3 class="form_heading">Proposal</h3>

      <div class="form-group form-row">
      <div id="prop_id" class="col-md-10 {{ $errors->has('description') ? ' has-error' : '' }}">
          <label class="required">Your proposal is your chance to make a good first impression with the employer! Make it count!</label>
          <textarea class="form-control" name="description" id="description" placeholder="What makes you the best candidate for this project?" rows="5"></textarea>
          <span id="count_character" class="right italic">0</span> 
           @if ($errors->has('description'))
            <span class="help-block">
              <strong>{{ $errors->first('description') }}</strong>
            </span>
            @endif
        </div>
      </div>
      <h3 class="form_heading">Proposed Milestones</h3>

      <div class="form-group form-row">
      <div class="col-md-10 {{ $errors->has('bid_amount') ? ' has-error' : '' }}">
          <label class="required">Define the tasks that you will complete for this employer's project.</label>
          <div id="milestones">
          <div id="milestone_0" class="form-row margin-top-10">
            <div class="col-md-6"><input type="text" name="milestone[0][title]" class="form-control" placeholder="Project Milestone"></div>
            <div class="col-md-6">
              <div class="input-group">
              <input name="milestone[0][price]" class="form-control price_amount" id="price_0" placeholder="500" value="" type="text">
              
            </div>
            </div>
          </div>
        </div>
        <div class="form-row margin-top-10"><label class="col-md-6 blue bold large-text text-right">Total:</label><strong class="blue bold large-text col-md-6 right" id="tot_amt">0</strong>
           @if ($errors->has('milestone_amount'))
            <span class="help-block">
              <strong>{{ $errors->first('milestone_amount') }}</strong>
            </span>
            @endif
        </div>
          <div class="form-row margin-top-10"><button type="button" class="btn lightgreen_gradient lft5m" onclick="addMilestone()">Add Milestone</button></div>
          
        </div>
      </div>
      
      
      
      <div class="form-group row">
        <div class="col-md-9 col-sm-9 col-xs-7 col-md-offset-4">
          <button type="button" id="submit_button" class="btn sendbtn bluebg lft10m">
          <i class="fa fa-fw fa-save"></i>Save
          </button>
        </div>
      </div>
    </div>
    
  </form>
</div>
</div>

<script type="text/javascript">
  $('#bid_amount').on('keyup', function(){
    var bamt = $('#bid_amount').val();
    var bpercent = $('#percentage').val();
    var min_budget = $('#min_budget').val();
   
    if (bamt != '') {
      var pamt = (bpercent / 100) * bamt;
      var aft_amt = Number(pamt) + Number(bamt);
      $('#project_fee').html('NPR. '+pamt);
      $('#your_bid').html('NPR. '+aft_amt);
      $('#amount').val(aft_amt);
      if (min_budget > aft_amt) {
        $('#bidbox').addClass('has-error');
        $('#bhelp').remove();
        $('#bbox').append('<span id="bhelp" class="help-block"><strong>You can not bid less than minimum budget.</strong></span>');
      } else{
        $('#bhelp').remove();
        $('#bidbox').removeClass('has-error');
      }
    }
  })
</script>

<script type="text/javascript">
 
  
  var mrow = 1;
  
   
  function addMilestone() {
    

  
    html = '<div id="milestone_'+mrow+'" class="form-row margin-top-10"><div class="col-md-6"><input type="text" name="milestone['+mrow+'][title]" class="form-control" placeholder="Project Milestone"></div>';
    html += '<div class="col-md-6"><div class="input-group"><input name="milestone['+mrow+'][price]" class="form-control price_amount" id="price_'+mrow+'" placeholder="500" value="" type="text"><span class="input-group-btn"><div class="btn bg-grey border-grey p7" onclick="$(\'#milestone_'+mrow+'\').remove();" data-toggle="tooltip" title="remove" type="button"><i class="fa fa-times"></i></div></span></div></div></div>';
    $('#milestones').append(html);
    mrow++;
   
   

  }
</script>

<script type="text/javascript">
  
  $(document).on('keyup', '.price_amount', function(argument) {
      var bid_amt = $('#amount').val();
    var totalamt = 0;
    $('.price_amount').each(function(){
      totalamt = Number(totalamt) + Number($(this).val());
    })
    $('#tot_amt').html('NPR '+totalamt);
    $('#milestone_amount').val(totalamt);
    bid_amt = Number(bid_amt);
    if (totalamt > bid_amt) {
      alert('Your Milestone amount is grater than Bid Amount');
      var str = $(this).val();
      var newtot = Number(totalamt) - Number(str);
      str = str.slice(0, -1);
      $(this).val(str);
      var otot = Number(newtot) + Number(str);
       $('#tot_amt').html('NPR '+otot);
       $('#milestone_amount').val(otot);
    }
  })
</script>

<script type="text/javascript">
  $('#submit_button').click(function(e){
    var bamt = Number($('#amount').val());
    var min_budget = Number($('#min_budget').val());
    var milestone_amount = Number($('#milestone_amount').val());
    var description = $('#description').val();
    var duration = Number($('#duration').val());
    if (min_budget > bamt) {
      $('#bhelp').remove();
      $('#bbox').append('<span id="bhelp" class="help-block"><strong>You can not bid less than minimum budget.</strong></span>');
      $('#bid_amount').focus();
      e.preventDefault();
      return false;
    }

    if (milestone_amount > bamt) {
      alert('You can add milestone  amount more than Bid Amount');
      $('.price_amount').focus();
      e.preventDefault();
      return false;
    }
    if (bamt > milestone_amount) {
      alert('You can add milestone  amount less than Bid Amount');
      $('.price_amount').focus();
      e.preventDefault();
      return false;
    }
    if (1 > duration) {
      $('#duration_box').addClass('has-error');
       $('#duration').focus();
       $('#dhelp').remove();
       $('#duration_box').append('<span id="dhelp" class="help-block"><strong>Duration is required.</strong></span>')
       e.preventDefault();
      return false;
    }
    if (description == '') {
      $('#prop_id').addClass('has-error');
       $('#description').focus();
       $('#phelp').remove();
       $('#prop_id').append('<span id="phelp" class="help-block"><strong>Proposal Field is Required</strong></span>')
       e.preventDefault();
      return false;
    }
    if (description.length < 25) {
       $('#prop_id').addClass('has-error');
       $('#description').focus();
       $('#phelp').remove();
       $('#prop_id').append('<span id="phelp" class="help-block"><strong>Proposal Required Greater Than 25 Charater.</strong></span>')
       e.preventDefault();
      return false;

    }

    $('#testform').submit();
  })
</script>

<script type="text/javascript">
  $('#description').keypress(function(){
    $('#prop_id').removeClass('has-error');
  })

  $('#description').keyup(function(){
    var des = $(this).val();
    $('#count_character').html(des.length);
  })
</script>

@endsection