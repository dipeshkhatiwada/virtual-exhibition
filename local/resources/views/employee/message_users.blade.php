@if(count($data['contacts']) > 0)
    @foreach($data['contacts'] as $contact)
    <div class="contact_user" id="contact_user_{{$contact['id']}}">
      <span class="user_image"><img src="{{asset($contact['image'])}}"></span>
      <span class="user_name">{{$contact['name']}}@if($contact['number_of'])<span id="count_msg{{$contact['id']}}">{{$contact['number_of']}}</span>@endif</span>
      @if($contact['status'])
      <span class="online_status"></span>
      @endif
    </div>
@endforeach
@endif
