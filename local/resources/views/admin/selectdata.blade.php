<option value="">Select Options</option>
@foreach($datas as $data)
<option value="{{$data['id']}}">{{$data['title']}}</option>
@endforeach