@extends('employe_master')

@section('content')

  <!-- left pannel of accordian menu and service package ended here -->

    <h3 class="form_heading">{{$datas['name']}} References</h3>
    <div class="common_bg">
      <form class="form-horizontal" role="form" id="testform" method="POST" action="{{ url('/employee/reference/update') }}">
        <input type="hidden" name="id" value="{{$datas['employee']->id}}">
        <div class="form-group dash_forms hidden-xs">
          <div class="table-responsive-lg">
            {!! csrf_field() !!}
            <table class="table table-bordered table-hover table_form">
              <thead>
                <th>Name</th>
                <th>Designation</th>
                <th>Address</th>
                <th>Office Phone</th>
                <th>Mobile</th>
                <th>E-mail</th>
                <th>Company</th>
                <th>Status</th>
                <th>Action</th>
              </thead>
              <tbody id="reference">
                <?php $reference_row = 0; ?>
                  @if(count($datas['reference']) > 0)
                    @foreach($datas['reference'] as $reference)
                    <?php $status = \App\ReferenceComment::checkComment($reference->id); ?>
                      <tr id="row-{{$reference_row}}">
                        <td>{{$reference->name}}</td>
                        <td>{{$reference->designation}}</td>
                        <td>{{$reference->address}}</td>
                        <td>{{$reference->office_phone}}</td>
                        <td>{{$reference->mobile}}</td>
                        <td>{{$reference->email}}</td>
                        <td>{{$reference->company}}</td>
                        <td>{{$status}}</td>
                        <td>
                          @if($status == '')
                          <button type="button" onclick="removeReference({{$reference->id}}, {{$reference_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
                          @endif
                        </td>
                      </tr>
                    <?php $reference_row++; ?>
                    @endforeach
                  @endif
                @if(is_array(old('reference')) > 0)
                @if(count(old('reference')) > 0)
                @foreach(old('reference') as $key => $old)
                <tr id="row-{{$reference_row}}">
                    <td class="{{ $errors->has('reference.'.$key.'.name') ? ' has-error' : '' }}">
                      <input type="text" name="reference[{{$reference_row}}][name]" value="{{$old['name']}}" class="form-control">
                      @if ($errors->has('reference.'.$key.'.name'))
                        <span class="help-block">
                          <strong>{{ $errors->first('reference.'.$key.'.name') }}</strong>
                        </span>
                      @endif
                    </td>
                    <td class="{{ $errors->has('reference.'.$key.'.designation') ? ' has-error' : '' }}">
                      <input type="text" name="reference[{{$reference_row}}][designation]" value="{{$old['designation']}}" class="form-control">
                      @if ($errors->has('reference.'.$key.'.designation'))
                        <span class="help-block">
                          <strong>{{ $errors->first('reference.'.$key.'.designation') }}</strong>
                        </span>
                      @endif
                    </td>
                    <td class="{{ $errors->has('reference.'.$key.'.address') ? ' has-error' : '' }}">
                      <input type="text" name="reference[{{$reference_row}}][address]" value="{{$old['address']}}" class="form-control">
                      @if ($errors->has('reference.'.$key.'.address'))
                        <span class="help-block">
                          <strong>{{ $errors->first('reference.'.$key.'.address') }}</strong>
                        </span>
                      @endif
                    </td>
                    <td><input type="text" name="reference[{{$reference_row}}][office_phone]" value="{{$old['office_phone']}}" class="form-control"></td>
                    <td class="{{ $errors->has('reference.'.$key.'.mobile') ? ' has-error' : '' }}">
                      <input type="text" name="reference[{{$reference_row}}][mobile]" value="{{$old['mobile']}}" class="form-control">
                      @if ($errors->has('reference.'.$key.'.mobile'))
                        <span class="help-block">
                          <strong>{{ $errors->first('reference.'.$key.'.mobile') }}</strong>
                        </span>
                      @endif
                    </td>
                    <td><input type="email" name="reference[{{$reference_row}}][ref_email]" value="{{$old['ref_email']}}" class="form-control"></td>
                    <td class="{{ $errors->has('reference.'.$key.'.company') ? ' has-error' : '' }}">
                      <input type="text" name="reference[{{$reference_row}}][company]" value="{{$old['company']}}" class="form-control">
                      @if ($errors->has('reference.'.$key.'.company'))
                        <span class="help-block">
                          <strong>{{ $errors->first('reference.'.$key.'.company') }}</strong>
                        </span>
                      @endif
                    </td>
                    <td></td>
                    <td>
                      <button type="button" onclick="$('#row-{{$reference_row}}').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
                    </td>
                  </tr>
                  <?php $reference_row++; ?>
                @endforeach
                @endif
                @endif
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="9"><button type="button" onclick="addReference();" data-toggle="tooltip" title="Add More reference" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More reference</button></td>
                </tr>
              </tfoot>
            </table>
            
          </div>
          
            <div class="form-group">
              
                <button type="submit" class="btn sendbtn bluebg">
                  Save <i class="fa fa-paper-plane"></i>
                </button>
             
            </div>
         
        </div>
<div class="form-group hidden-lg hidden-md">
      
      <table class="table mob_table table-bordered ">
        <tbody id="reference">
          <?php $reference_row = 0; ?>
            @if(count($datas['reference']) > 0)
            @foreach($datas['reference'] as $reference)
            <?php $status = \App\ReferenceComment::checkComment($reference->id); ?>
            <tr id="row-{{$reference_row}}">
              <th>Name</th>
              <th>{{$reference->name}}</th>
            </tr>
            <tr>
            <td>Designation</td>
            <td>{{$reference->designation}}</td>
            </tr>
            <tr>
            <td>Address</td>
            <td>{{$reference->address}}</td>
            </tr>
            <tr>
            <td>Office Phone</td>
            <td>{{$reference->office_phone}}</td>
            </tr>
            <tr>
            <td>Mobile</td>
            <td>{{$reference->mobile}}</td>
            </tr>
            <tr>
              <td>E-mail</td>
              <td>{{$reference->email}}</td>
            </tr>
            <tr>
            <td>Company</td>
            <td>{{$reference->company}}</td>
            </tr>
            <tr>
              <td>Status</td>
              <td>{{$status}}</td>
            </tr>
            <tr>
            <td>Action</td>
            <td> 
              @if($status == '')
                <button type="button" onclick="removeReference({{$reference->id}}, {{$reference_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
              @endif
            </td>
            </tr>
            <?php $reference_row++; ?>
            @endforeach
            @endif
        </tbody>
        <tfoot>
          <tr>
            <td><button type="button" onclick="addmobReference();" data-toggle="tooltip" title="Add More reference" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More reference</button></td>
          </tr>
        </tfoot>
      </table>
    </div>


      </form>
    </div><!-- /.box-body -->
<div class="modal fade servicemodal" id="modal-addmobReference" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title left">Add Reference</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/reference/save') }}">
        {!! csrf_field() !!}
        <div class="modal-body" >
          <div class="form-group row ">
            <label class="col-md-4 required">Name</label>
            <div class="col-md-8">
            <input type="text" name="name" class="form-control" placeholder="Reference Name">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Designation</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="designation" placeholder="Designation">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Address</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="address" placeholder="Address">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Office Phone</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="office_phone" placeholder="Office Phone">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Mobile</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="mobile" placeholder="Mobile">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">E-mail</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="email" placeholder="Email">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Company</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="company" placeholder="Company">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
</div>
  <script type="text/javascript">
    function removeReference(id,row)
    {
      if(confirm('Are you sure, Do You Want To Delete This reference?')){
      var token = $('input[name=\'_token\']').val();
          $.ajax({
            type: 'POST',
            url: '{{url("/employee/reference/delete")}}',
            data: 'id='+id+'&_token='+token,
            cache: false,
            success: function(Success){
                $('#row-'+row).remove();
               
            }
        });
        }
    }
   
     var reference_row = '{{$reference_row + 1}}';
    function addReference()
    {
        html = '<tr id="row-'+reference_row+'">';
        html += '<td><input type="text" name="reference['+reference_row+'][name]" class="form-control"></td>';
        html += '<td><input type="text" name="reference['+reference_row+'][designation]" class="form-control"></td>';
        html += '<td><input type="text" name="reference['+reference_row+'][address]" class="form-control"></td>';
        html += '<td><input type="text" name="reference['+reference_row+'][office_phone]" class="form-control"></td>';
        html += '<td><input type="text" name="reference['+reference_row+'][mobile]"  class="form-control"></td>';
        html += '<td><input type="email" name="reference['+reference_row+'][ref_email]"  class="form-control"></td>';
        html += '<td><input type="text" name="reference['+reference_row+'][company]" class="form-control"></td>';
        html += '<td></td>';
        html += '<td><button type="button" onclick="$(\'#row-'+reference_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';
        $('#reference').append(html);
        

  reference_row++;
    };

    
</script>
  
  <script type="text/javascript">
  function addmobReference(){
    $('#modal-addmobReference').modal('show');
  }
</script>
@stop()