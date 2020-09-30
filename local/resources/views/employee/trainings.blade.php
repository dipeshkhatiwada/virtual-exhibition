@extends('employe_master')
@section('content')
  <!-- left pannel of accordian menu and service package ended here -->
    <h3 class="form_heading">{{$datas['name']}} Trainings</h3>
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
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/training/update') }}">
        <input type="hidden" name="id" value="{{$datas['employee']->id}}">
        <div class="form-group hidden-xs">
          <div class="table-responsive-lg">
          {!! csrf_field() !!}
          <table class="table table-bordered table-hover table_form">
            <thead>
              <th>Title</th>
              <th>Details</th>
              <th>Institution</th>
              <th>Duration</th>
              <th>Year</th>
              <th>Action</th>
            </thead>
            <tbody id="training">
              <?php $training_row = 0; ?>
              @if(count($datas['training']) > 0)
              @foreach($datas['training'] as $training)
              <tr id="row-{{$training_row}}">
                <td>{{$training->title}}</td>
                <td>{{$training->details}}</td>
                <td>{{$training->institution}}</td>
                <td>{{$training->duration}}</td>
                <td>{{$training->year}}</td>
                <td>
                  <button type="button" onclick="removeTraining({{$training->id}}, {{$training_row}});" data-toggle="tooltip" title="Remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Delete</button>
                  <button type="button" onclick="editTraining({{$training->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button>
                </td>
              </tr>
              <?php $training_row++; ?>
              @endforeach
              @endif
              @if(is_array(old('training')) > 0)

              @if(count(old('training')) > 0)
              
              @foreach(old('training') as $key => $old)
              <tr id="row-{{$training_row}}">
                <td class="{{ $errors->has('training.'.$key.'.title') ? ' has-error' : '' }}"><input type="text" name="training[{{$training_row}}][title]" class="form-control" value="{{$old['title']}}">
                @if ($errors->has('training.'.$key.'.title'))
                <span class="help-block">
                  <strong>{{ $errors->first('training.'.$key.'.title') }}</strong>
                </span>
                @endif
              </td>
              
              <td class="{{ $errors->has('training.'.$key.'.details') ? ' has-error' : '' }}"><input type="text" name="training[{{$training_row}}][details]" value="{{$old['details']}}" class="form-control">@if ($errors->has('training.'.$key.'.details'))
              <span class="help-block">
                <strong>{{ $errors->first('training.'.$key.'.details') }}</strong>
              </span>
            @endif</td>
            <td class="institutiontd {{ $errors->has('training.'.$key.'.institution') ? ' has-error' : '' }}"><input type="text" name="training[{{$training_row}}][institution]" value="{{$old['institution']}}" class="form-control institution" id="ins_{{$training_row}}" autocomplete="off">
               <input type="hidden" name="training[{{$training_row}}][institution_id]" id="employer_id{{$training_row}}" value="{{$old['institution_id']}}">
                                      <div id="orglist{{$training_row}}" class="col-md-12 orglist">    </div>
              @if ($errors->has('training.'.$key.'.institution'))
            <span class="help-block">
              <strong>{{ $errors->first('training.'.$key.'.institution') }}</strong>
            </span>
          @endif</td>
          <td class="{{ $errors->has('training.'.$key.'.duration') ? ' has-error' : '' }}"><input type="text" name="training[{{$training_row}}][duration]" value="{{$old['duration']}}" class="form-control">@if ($errors->has('training.'.$key.'.duration'))
          <span class="help-block">
            <strong>{{ $errors->first('training.'.$key.'.duration') }}</strong>
          </span>
        @endif</td>
        
        <td class="{{ $errors->has('training.'.$key.'.year') ? ' has-error' : '' }}"><input type="text" name="training[{{$training_row}}][year]" value="{{$old['year']}}" class="form-control">@if ($errors->has('training.'.$key.'.year'))
        <span class="help-block">
          <strong>{{ $errors->first('training.'.$key.'.year') }}</strong>
        </span>
      @endif</td>
      <td><button type="button" onclick="$('#row-{{$training_row}}').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i></button></td>
    </tr>
    <?php $training_row++; ?>
    @endforeach
    @endif
    @endif
  </tbody>
  <tfoot><tr><td colspan="6"><button type="button" onclick="addTraining();" data-toggle="tooltip" title="Add More Training" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More Training</button></td></tr></tfoot>
</table>
</div>

  <div class="form-group">
      <button type="submit" class="btn bluebg sendbtn btm10m">
      Save <i class="fa fa-paper-plane"></i>
      </button>
  </div>

</div>
<div class="form-group hidden-lg hidden-md">
          {!! csrf_field() !!}
          <table class="table mob_table table-bordered">
            <tbody id="training">
              <?php $training_row = 0; ?>
                @if(count($datas['training']) > 0)
                @foreach($datas['training'] as $training)
                <tr id="row-{{$training_row}}">
                  <td>Title</td>
                  <td>{{$training->title}}</td>
                </tr>
                <tr>
                <td>Details</td>
                <td>{{$training->details}}</td>
                </tr>
                <tr>
                <td>Institution</td>
                <td>{{$training->institution}}</td>
                </tr>
                <tr>
                <td>Duration</td>
                <td>{{$training->duration}}</td>
                </tr>
                <tr>
                <td>Year</td>
                <td>{{$training->year}}</td>
                </tr>

                <tr>
                <td>Action</td>
                <td> 
                <button type="button" onclick="removeTraining({{$training->id}}, {{$training_row}});" data-toggle="tooltip" title="Remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Delete</button>
                <button type="button" onclick="editTraining({{$training->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button>
                </td>
                </tr>
                <?php $training_row++; ?>
                @endforeach
                @endif
            </tbody>
            <tfoot>
              <tr>
                <td colspan="10"><button type="button" onclick="addmobTraining();" data-toggle="tooltip" title="Add More Training" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add Training</button></td>
              </tr>
            </tfoot>
          </table>
        </div>



</form>
</div><!-- /.box-body -->
</div>
</div>

<div class="modal fade servicemodal" id="modal-addmobTraining" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title left">Add Training</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/training/save') }}">
        {!! csrf_field() !!}
        <div class="modal-body" id="training_detail">
          <div class="form-group row ">
            <label class="col-md-4 required">Title</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="title" placeholder="title">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Details</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="details" placeholder="detail">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Institution</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" id="institution" name="institution" placeholder="intitution">
              <input type="hidden" name="employers_id" id="employer_id" placeholder="74">
              <div id="institution_list" class="col-md-12 orglist"></div>
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Duration</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="duration" placeholder="duration">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Year</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" maxlength="4" name="year" placeholder="year">
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
function removeTraining(id,row)
{
if(confirm('Are you sure, Do You Want To Delete This Training?')){
var token = $('input[name=\'_token\']').val();
$.ajax({
type: 'POST',
url: '{{url("/employee/training/delete")}}',
data: 'id='+id+'&_token='+token,
cache: false,
success: function(Success){
$('#row-'+row).remove();
}
});
}
}
var training_row = '{{$training_row + 1}}';
function addTraining()
{
html = '<tr id="row-'+training_row+'">';
html += '<td><input type="text" name="training['+training_row+'][title]" class="form-control"></td>';
html += '<td><input type="text" name="training['+training_row+'][details]" class="form-control"></td>';
html += '<td class="institutiontd"><input type="text" name="training['+training_row+'][institution]" class="form-control institution" id="ins_'+training_row+'" autocomplete="off"><input type="hidden" name="training['+training_row+'][institution_id]" id="employer_id'+training_row+'"> <div id="orglist'+training_row+'" class="col-md-12 orglist"></div></td>';
html += '<td><input type="text" name="training['+training_row+'][duration]" class="form-control"></td>';
html += '<td><input type="text" name="training['+training_row+'][year]" maxlength="4" class="form-control"></td>';
html += '<td><button type="button" onclick="$(\'#row-'+training_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';
$('#training').append(html);
training_row++;


};




$(document).on('keypress',".institution", function()
      {
        var rowid = $(this).attr('id').replace('ins_','');
        var token = $('input[name=\'_token\']').val();
        var name = $(this).val();
    $.ajax({
         type: 'POST',
            url: '{{url("/employer/register/getName")}}',
            data: '_token='+token+'&name='+name,
            cache: false,
            success: function(html){
              if (html != '') {
                $('#orglist'+rowid).html(html).fadeIn();
                $('.org-list').on('click', function(){
                  var id = $(this).attr('id');
                  var title = $('#title_'+id).html();
                  var org_type = $('#type_'+id).val();
                  $('#ins_'+rowid).val(title);
                  $('#employer_id'+rowid).val(id);
                  
                  $('#orglist'+rowid).html('').fadeOut();
                })
              } else{
                $('#orglist'+rowid).html('').fadeOut();
               
            }
              }
      });
      })
</script>
 <div class="modal fade servicemodal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title left" >Edit Training</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/trainings/update') }}">
        <input type="hidden" name="training_id"id="training_id" value="">
        {!! csrf_field() !!}
      <div class="modal-body" id="tttraining_detail">
                
        
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
   function editTraining(training_id) {
       var token = $('input[name=\'_token\']').val();
       $.ajax({
      type: 'POST',
        url: '{{url("/employee/trainings/getedit")}}',
        data: '_token='+token+'&training_id='+training_id,
        cache: false,
        success: function(html){
          
          $('#tttraining_detail').html(html);
          $('#modal-edit').modal('show');
          $('#training_id').val(training_id);
          }
  });
    }
</script>

<script type="text/javascript">
  $(document).on('keypress',"#institution", function()
  {
   
    var token = $('input[name=\'_token\']').val();
    var name = $(this).val();
    $.ajax({
      type: 'POST',
        url: '{{url("/employer/register/getName")}}',
        data: '_token='+token+'&name='+name,
        cache: false,
        success: function(html){
          if (html != '') {
            $('#institution_list').html(html).fadeIn();
            $('.org-list').on('click', function(){
              var id = $(this).attr('id');
              var title = $('#title_'+id).html();
              var org_type = $('#type_'+id).val();
              $('#institution').val(title);
              $('#employer_id').val(id);
              
              $('#institution_list').html('').fadeOut();
            })
          } else{
            $('#institution_list').html('').fadeOut();
           
        }
          }
  });
  })
</script>

<script type="text/javascript">
    function addmobTraining(){
      $('#modal-addmobTraining').modal('show');
    }
  </script>
@stop()