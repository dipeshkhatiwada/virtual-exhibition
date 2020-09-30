@extends('employer_master')
@section('content')
  <h3 class="form_heading">Buy Resume Download Package</h3>
    <div class="form_tabbar">
     
     <form method="POST" action="{{ url('/employer/resumepackage/save') }}">
                        {!! csrf_field() !!}
                        

                     
                        <div class="form-group row">
                            <label for="package" class="col-md-2 col-form-label text-md-right">Select Package</label>
                            <div class="col-md-10">
                               <select class="form-control" name="package">
                                 @foreach($datas as $data)
                                 @php($label = '')
                                 @if($data->discount > 0)
                                 @php($after_discount = $data->price - ($data->price * ($data->discount / 100)))
                                 @php($label = ' Discount '.$data->discount.'% After discount: '.$after_discount)
                                 @endif
                                  @if(old('package') == $data->id)
                                  <option selected="selected" value="{{$data->id}}">{{$data->title. ' '.$data->resume_number. ' Resume, Valied until '.$data->duration.' Days '.$label}}</option>
                                  @else
                                  <option value="{{$data->id}}">{{$data->title. ' '.$data->resume_number. ' Resume, Valied until '.$data->duration.' Days, Price '.$data->price.$label}}</option>
                                  @endif
                                 @endforeach
                               </select>

                                @if ($errors->has('package'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('package') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn lightgreen_gradient tb10m">
                                   Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
            

        
</div>


@endsection