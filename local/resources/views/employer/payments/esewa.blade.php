@if($data['payment_mode'] == 1)

<div class="warning">Warning: The payment gateway is in Sandbox Mode. Your account will not be charged.</div>

@endif

<form action="{{ $data['action'] }}" method="POST">

  <input value="{{ $data['total_amount'] }}" name="tAmt" type="hidden">

 <input value="{{ $data['total_amount'] }}" name="amt" type="hidden">

 <input value="0" name="txAmt" type="hidden">

 <input value="0" name="psc" type="hidden">

 <input value="0" name="pdc" type="hidden">

 <input value="{{$data['scd']}}" name="scd" type="hidden">

 <input value="{{$data['id']}}" name="pid" type="hidden">

  

  <input type="hidden" name="su" value="{{ $data['su'] }}" />

 

  <input type="hidden" name="fu" value="{{ $data['fe'] }}" />

 

  <div class="buttons">
    <div class="center">
      <input type="submit" value="Confirm" class="btn lightgreen_gradient" />
    </div>
  </div>

</form>