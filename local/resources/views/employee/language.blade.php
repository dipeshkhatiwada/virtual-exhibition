@extends('employe_master')
@section('content')

  <!-- left pannel of accordian menu and service package ended here -->
    <h3 class="form_heading">{{$datas['name']}} Language</h3>
    <div class="common_bg">
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
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/language/update') }}">
        <input type="hidden" name="id" value="{{$datas['employee']->id}}">
        <div class="form-group hidden-xs">
          <div class="table-responsive-lg">
            {!! csrf_field() !!}
            <table class="table table-bordered table-hover table_form">
              <thead>
                <th>Languages</th>
                <th>Understand</th>
                <th>Speak</th>
                <th>Read</th>
                <th>Write</th>
                <th>Mother Tongue</th>
                <th>Action</th>
              </thead>
              <tbody id="language">
                <?php $language_row = 0; ?>
                @if(count($datas['language']) > 0)
                @foreach($datas['language'] as $language)
                <tr id="row-{{$language_row}}">
                  <td>{{$language->language}}</td>
                  <td>{{$language->understand}}</td>
                  <td>{{$language->speak}}</td>
                  <td>{{$language->reading}}</td>
                  <td>{{$language->writing}}</td>
                  <td>{{$language->mother_t == 1 ? 'Yes' : 'No'}}</td>
                  <td><button type="button" onclick="removeLanguage({{$language->id}}, {{$language_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
                    <button type="button" onclick="editLanguage({{$language->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button></td>
                </tr>
                  <?php $language_row++; ?>
                  @endforeach
                  @endif
                  @if(is_array(old('language')) > 0)
                  @if(count(old('language')) > 0)
                  @foreach(old('language') as $key => $old)
                <tr id="row-{{$language_row}}">
                  <td class="{{ $errors->has('language.'.$key.'.language') ? ' has-error' : '' }}">
                    <input type="text" name="language[{{$language_row}}][language]" value="{{$old['language']}}" class="form-control">
                    @if ($errors->has('language.'.$key.'.language'))
                    <span class="help-block">
                      <strong>{{ $errors->first('language.'.$key.'.language') }}</strong>
                    </span>
                    @endif
                  </td>
                  <td>
                    <select class="form-control" name="language[{{$language_row}}][understand]">
                    @foreach($datas['easy'] as $easy)
                    @if($old['understand'] == $easy['value'])
                    <option selected="selected" value="{{$easy['value']}}">{{$easy['value']}}</option>
                    @else
                    <option value="{{$easy['value']}}">{{$easy['value']}}</option>
                    @endif
                    @endforeach
                    </select>
                  </td>
                  <td><select class="form-control" name="language[{{$language_row}}][speak]">
                  @foreach($datas['fluent'] as $fluent)
                  @if($old['speak'] == $fluent['value'])
                  <option selected="selected" value="{{$fluent['value']}}">{{$fluent['value']}}</option>
                  @else
                  <option value="{{$fluent['value']}}">{{$fluent['value']}}</option>
                  @endif
                  @endforeach
                  </select></td>
                  <td><select class="form-control" name="language[{{$language_row}}][read]">
                  @foreach($datas['easy'] as $easy)
                  @if($old['read'] == $easy['value'])
                  <option selected="selected" value="{{$easy['value']}}">{{$easy['value']}}</option>
                  @else
                  <option value="{{$easy['value']}}">{{$easy['value']}}</option>
                  @endif
                  @endforeach
                  </select></td>
                  <td><select class="form-control" name="language[{{$language_row}}][write]">
                  @foreach($datas['easy'] as $easy)
                  @if($old['write'] == $easy['value'])
                  <option selected="selected" value="{{$easy['value']}}">{{$easy['value']}}</option>
                  @else
                  <option value="{{$easy['value']}}">{{$easy['value']}}</option>
                  @endif
                  @endforeach
                  </select></td>
                  <td><select class="form-control" name="language[{{$language_row}}][mother_t]">
                  @foreach($datas['yes_no'] as $uyn)
                  @if($old['mother_t'] == $uyn['value'])
                  <option selected="selected" value="{{$uyn['value']}}">{{$uyn['title']}}</option>
                  @else
                  <option value="{{$uyn['value']}}">{{$uyn['title']}}</option>
                  @endif
                  @endforeach
                  </select>
                  </td>
                  <td><button type="button" onclick="$('#row-{{$language_row}}').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td>
                </tr>
                <?php $language_row++; ?>
                @endforeach
                @endif
                @endif
              </tbody>
              <tfoot><tr><td colspan="7"><button type="button" onclick="addLanguage();" data-toggle="tooltip" title="Add More language" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More language</button></td></tr></tfoot>
            </table>
          </div>
           <div class="form-group">
          <button type="submit" class="btn bluebg sendbtn">
            Save <i class="fa fa-paper-plane"></i>
          </button>
        </div>
        </div>
       
        <div class="form-group hidden-lg hidden-md">
        {!! csrf_field() !!}
        <table class="table mob_table table-bordered ">
          <tbody id="language">
                <?php $language_row = 0; ?>
                @if(count($datas['language']) > 0)
                @foreach($datas['language'] as $language)
            <tr id="row-{{$language_row}}">
              <th>Language</th>
              <th>{{$language->language}}</th>
            </tr>
          
            <tr>
              <td>Understand</td>
              <td>{{$language->understand}}</td>
            </tr>
           <tr>
             <td>Speak</td>
             <td>{{$language->speak}}</td>
           </tr>
           <tr>
             <td>Read</td>
             <td>{{$language->reading}}</td>
           </tr>
           <tr>
             <td>Write</td>
             <td>{{$language->writing}}</td>
           </tr>
           <tr>
             <td>Mother Tongue</td>
             <td>{{$language->mother_t == 1 ? 'Yes' : 'No'}}</td>
           </tr>
           <tr>
             <td>Action</td>
             <td><button type="button" onclick="removeLanguage({{$language->id}}, {{$language_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
                <button type="button" onclick="editLanguage({{$language->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button>
              </td>
           </tr>
           <?php $language_row++; ?>
            @endforeach
            @endif
                  
          <tfoot><tr><td><button type="button" onclick="addmobLanguage();" data-toggle="tooltip" title="Add More language" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More language</button></td></tr></tfoot>
        </table>
        </div>
      </form>
    </div><!-- /.box-body -->
  </div>

  <div class="modal fade servicemodal" id="modal-addlanguage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title left">Add Language</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/language/save') }}">
       
        {!! csrf_field() !!}
        <div class="modal-body">
        <div class="form-group row ">
          <label class="col-md-4 required">language</label>
          <div class="col-md-8">
            <input type="text" required="required" class="form-control" id="institution" name="language" value="">
          </div>
        </div>
        <div class="form-group row ">
          <label class="col-md-4 required">Understand</label>
          <div class="col-md-8">
            <select class="form-control" name="understand">
              <option selected="selected" value="Easily">Easily</option>
              <option value="Not Easily">Not Easily</option>
            </select>
          </div>
        </div>
        <div class="form-group row ">
          <label class="col-md-4 required">Speak</label>
          <div class="col-md-8">
            <select class="form-control" name="speak">
              <option selected="selected" value="Fluently">Fluently</option>
              <option value="Not Fluently">Not Fluently</option>
            </select>
          </div>
        </div>
        <div class="form-group row ">
            <label class="col-md-4 required">Read</label>
            <div class="col-md-8">
              <select class="form-control" name="read">
                <option selected="selected" value="Easily">Easily</option>
                <option value="Not Easily">Not Easily</option>
              </select>
            </div>
        </div>
        <div class="form-group row ">
          <label class="col-md-4 required">Write</label>
          <div class="col-md-8">
            <select class="form-control" name="write">
              <option selected="selected" value="Easily">Easily</option>
              <option value="Not Easily">Not Easily</option>
            </select>
          </div>
        </div>
        <div class="form-group row ">
          <label class="col-md-4 required">Mother Tongue</label>
          <div class="col-md-8">
            <select class="form-control" name="mother_t">
            <option selected="selected" value="0">No</option>
            <option value="1">Yes</option>
            </select>
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
<!-- /.modal-dialog -->
</div>
  <script type="text/javascript">
  function removeLanguage(id,row)
  {
  if(confirm('Are you sure, Do You Want To Delete This language?')){
  var token = $('input[name=\'_token\']').val();
  $.ajax({
  type: 'POST',
  url: '{{url("/employee/language/delete")}}',
  data: 'id='+id+'&_token='+token,
  cache: false,
  success: function(Success){
  $('#row-'+row).remove();
  
  }
  });
  }
  }
  
  var language_row = '{{$language_row + 1}}';
  function addLanguage()
  {
  html = '<tr id="row-'+language_row+'">';
    html += '<td><input type="text" name="language['+language_row+'][language]" class="form-control"></td>';
    html += '<td><select class="form-control" name="language['+language_row+'][understand]"><option value="Easily">Easily</option><option value="Not Easily">Not Easily</option></select></td>';
    html += '<td><select class="form-control" name="language['+language_row+'][speak]"><option value="Fluently">Fluently</option><option value="Not Fluently">Not Fluently</option></select></td>';
    html += '<td><select class="form-control" name="language['+language_row+'][read]"><option value="Easily">Easily</option><option value="Not Easily">Not Easily</option></select></td>';
    html += '<td><select class="form-control" name="language['+language_row+'][write]"><option value="Easily">Easily</option><option value="Not Easily">Not Easily</option></select></td>';
    html += '<td><select class="form-control" name="language['+language_row+'][mother_t]"><option value="1">Yes</option><option value="0">No</option></select></td>';
    html += '<td><button type="button" onclick="$(\'#row-'+language_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';
    $('#language').append(html);
    
    language_row++;
    };
    
    </script>
    
    <div class="modal fade servicemodal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title left" >Edit Language</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/languages/update') }}">
        <input type="hidden" name="language_id"id="language_id" value="">
        {!! csrf_field() !!}
      <div class="modal-body" id="language_detail">
                
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn bluebg sendbtn"> Save <i class="fa fa-paper-plane"></i></button>
        
      </div>
    </form>
    
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<script type="text/javascript">
   function editLanguage(language_id) {
       var token = $('input[name=\'_token\']').val();
       $.ajax({
      type: 'POST',
        url: '{{url("/employee/languages/getedit")}}',
        data: '_token='+token+'&language_id='+language_id,
        cache: false,
        success: function(html){
          $('#language_detail').html(html);
          $('#modal-edit').modal('show');
          $('#language_id').val(language_id);
          }
  });
    }

    function addmobLanguage(){
      $('#modal-addlanguage').modal('show');
    }
</script>


    @stop()