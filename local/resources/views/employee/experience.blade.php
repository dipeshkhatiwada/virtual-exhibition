@extends('employe_master')

@section('content')
  <!-- left pannel of accordian menu and service package ended here -->
  <h3 class="form_heading">{{$datas['name']}} Experience</h3>
    <div class="common_bg">
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/experience/update') }}">
        <input type="hidden" name="id" value="{{$datas['employee']->id}}">
        <div class="form-group hidden-xs">
          <div class="table-responsive-lg">
            {!! csrf_field() !!}
            <table class="table table-bordered table-hover table_form">
              <thead>
                <th>Organization</th>
                <th>Type of Employment</th>
                <th>Organization Type</th>
                <th>Designation</th>
                <th>Job Level</th>
                <th>From</th>
                <th>To</th>
                <th>Working Status</th>
                <th>Country</th>
                <th>Action</th>
              </thead>
              <tbody id="experience">
                <?php $experience_row = 0; ?>
                @if(count($datas['experience']) > 0)
                  @foreach($datas['experience'] as $experience)
                  <tr id="row-{{$experience_row}}">
                    <td>{{$experience->organization}}</td>
                    <td>{{$experience->typeofemployment}}</td>
                    <td>{{\App\OrganizationType::getOrgTypeTitle($experience->org_type_id)}}</td>
                    <td>{{$experience->designation}}</td>
                    <td>{{$experience->level}}</td>
                    <td>{{$experience->from}}</td>
                    <td>{{$experience->to}}</td>
                    <td>{{$experience->currently_working == 1 ? 'Currently Working' : 'Not Working'}}</td>
                    <td>{{$experience->country}}</td>
                    <td rowspan="2">
                      <button type="button" onclick="removeexperience({{$experience->id}}, {{$experience_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
                       <button type="button" onclick="editExperience({{$experience->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button>
                    </td>
                  </tr>
                  <tr id="second_row_{{$experience_row}}">
                    <td colspan="9"><?php echo $experience->experience; ?></td>
                  </tr>
                  <?php $experience_row++; ?>
                  @endforeach
                  @endif
                  @if(is_array(old('experience')) > 0)
                  @if(count(old('experience')) > 0)
                  @foreach(old('experience') as $key => $old)
                  <tr id="row-{{$experience_row}}">
                    <td class="{{ $errors->has('experience.'.$key.'.organization') ? ' has-error' : '' }}">
                      <input type="text" name="experience[{{$experience_row}}][organization]" value="{{$old['organization']}}" class="form-control">
                      @if ($errors->has('experience.'.$key.'.organization'))
                        <span class="help-block">
                          <strong>{{ $errors->first('experience.'.$key.'.organization') }}</strong>
                        </span>
                      @endif
                    </td>
                    <td class="{{ $errors->has('experience.'.$key.'.typeofemployment') ? ' has-error' : '' }}">
                      <select class="form-control" name="experience[{{$experience_row}}][typeofemployment]">
                        @foreach($datas['employment_type'] as $em_type)
                          @if($old['typeofemployment'] == $em_type['value'])
                          <option selected="selected" value="{{$em_type['value']}}">{{$em_type['value']}}</option>
                          @else
                          <option value="{{$em_type['value']}}">{{$em_type['value']}}</option>
                          @endif
                        @endforeach
                      </select>
                      @if ($errors->has('experience.'.$key.'.typeofemployment'))
                        <span class="help-block">
                          <strong>{{ $errors->first('experience.'.$key.'.typeofemployment') }}</strong>
                        </span>
                      @endif
                    </td>
                    <td class="{{ $errors->has('experience.'.$key.'.org_type_id') ? ' has-error' : '' }}">
                      <select class="form-control" name="experience[{{$experience_row}}][org_type_id]">
                        @foreach($datas['organization_type'] as $org_type)
                          @if($old['org_type_id'] == $org_type->id)
                          <option selected="selected" value="{{$org_type->id}}">{{$org_type->name}}</option>
                          @else
                          <option value="{{$org_type->id}}">{{$org_type->name}}</option>
                          @endif
                        @endforeach
                      </select>
                      @if ($errors->has('experience.'.$key.'.org_type_id'))
                        <span class="help-block">
                          <strong>{{ $errors->first('experience.'.$key.'.org_type_id') }}</strong>
                        </span>
                      @endif
                    </td>
                    <td class="{{ $errors->has('experience.'.$key.'.designation') ? ' has-error' : '' }}">
                      <input type="text" name="experience[{{$experience_row}}][designation]" value="{{$old['designation']}}" class="form-control">
                      @if ($errors->has('experience.'.$key.'.designation'))
                        <span class="help-block">
                          <strong>{{ $errors->first('experience.'.$key.'.designation') }}</strong>
                        </span>
                      @endif
                    </td>
                    <td class="{{ $errors->has('experience.'.$key.'.level') ? ' has-error' : '' }}">
                      <select class="form-control" name="experience[{{$experience_row}}][level]">
                        @foreach($datas['job_level'] as $job_level)
                          @if($old['level'] == $job_level['value'])
                          <option selected="selected" value="{{$job_level['value']}}">{{$job_level['value']}}</option>
                          @else
                          <option value="{{$job_level['value']}}">{{$job_level['value']}}</option>
                          @endif
                        @endforeach
                      </select>
                      @if ($errors->has('experience.'.$key.'.level'))
                        <span class="help-block">
                          <strong>{{ $errors->first('experience.'.$key.'.level') }}</strong>
                        </span>
                      @endif
                    </td>
                    <td class="{{ $errors->has('experience.'.$key.'.from') ? ' has-error' : '' }}">
                      <input type="text" id="form_{{$experience_row}}" name="experience[{{$experience_row}}][from]" class="form-control date" value="{{$old['from']}}" placeholder="2010-01-02">
                      @if ($errors->has('experience.'.$key.'.from'))
                        <span class="help-block">
                          <strong>{{ $errors->first('experience.'.$key.'.from') }}</strong>
                        </span>
                      @endif
                    </td>
                    <td class="{{ $errors->has('experience.'.$key.'.to') ? ' has-error' : '' }}">
                      <input type="text" id="to_{{$experience_row}}" id="to_{{$experience_row}}" name="experience[{{$experience_row}}][to]" class="form-control date" value="{{$old['to']}}" placeholder="2010-01-02">
                      @if ($errors->has('experience.'.$key.'.to'))
                        <span class="help-block">
                          <strong>{{ $errors->first('experience.'.$key.'.to') }}</strong>
                        </span>
                      @endif
                    </td>
                    <td class="{{ $errors->has('experience.'.$key.'.currently_working') ? ' has-error' : '' }}">
                      <select id="{{$experience_row}}" class="form-control currently" name="experience[{{$experience_row}}][currently_working]">
                        @foreach($datas['working_status'] as $working_status)
                          @if($old['currently_working'] == $working_status['value'])
                          <option selected="selected" value="{{$working_status['value']}}">{{$working_status['title']}}</option>
                          @else
                          <option value="{{$working_status['value']}}">{{$working_status['title']}}</option>
                          @endif
                        @endforeach
                      </select>
                      @if ($errors->has('experience.'.$key.'.currently_working'))
                        <span class="help-block">
                          <strong>{{ $errors->first('experience.'.$key.'.currently_working') }}</strong>
                        </span>
                      @endif
                    </td>
                    <td class="{{ $errors->has('experience.'.$key.'.country') ? ' has-error' : '' }}">
                      <input type="text" name="experience[{{$experience_row}}][country]" value="{{$old['country']}}" class="form-control">
                        @if ($errors->has('experience.'.$key.'.country'))
                          <span class="help-block">
                            <strong>{{ $errors->first('experience.'.$key.'.country') }}</strong>
                          </span>
                        @endif
                    </td>
                    <td rowspan="2"><button type="button" onclick="$('#row-{{$experience_row}}').remove();$('#second_row_{{$experience_row}}').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td>
                  </tr>
                  <tr id="second_row_{{$experience_row}}">

                    <td colspan="9"><textarea class="form-control" name="experience[{{$experience_row}}][detail]">{{$old['detail']}}</textarea></td>
                  </tr>
                  <?php $experience_row++; ?>
                  @endforeach
                @endif
                @endif
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="10"><button type="button" onclick="addExperience();" data-toggle="tooltip" title="Add More experience" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More Experience</button></td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="form-group row">
            <div class="col-lg-12 col-md-12 col-12 col-md-offset-4">
              <button type="submit" class="btn bluebg sendbtn">
                Save <i class="fa fa-fw fa-paper-plane"></i>
              </button>
            </div>
          </div>
        </div>

<div class="form-group hidden-lg">
          <table class="table mob_table table-bordered ">
            {!! csrf_field() !!}
            <tbody id="experience">
            <?php $experience_row = 0; ?>
              @if(count($datas['experience']) > 0)
              @foreach($datas['experience'] as $experience)
              <tr id="row-{{$experience_row}}">
                <th>Organization</th>
                <th>{{$experience->organization}}</th>
              </tr>
              <tr>
              <td>Type of Employment</td>
              <td>{{$experience->typeofemployment}}</td>
              </tr>
              <tr>
              <td>Organization Type</td>
              <td>{{\App\OrganizationType::getOrgTypeTitle($experience->org_type_id)}}</td>
              </tr>
              <tr>
              <td>Designation</td>
              <td>{{$experience->designation}}</td>
              </tr>
              <tr>
              <td>Job Level</td>
              <td>{{$experience->level}}</td>
              </tr>
              <tr>
              <td>From</td>
              <td>{{$experience->from}}</td>
              </tr>
              <tr>
              <td>To</td>
              <td>{{$experience->to}}</td>
              </tr>
              <tr>
              <td>Working Status</td>
              <td>{{$experience->currently_working == 1 ? 'Currently Working' : 'Not Working'}}</td>
              </tr>
              <tr>
              <td>Country</td>
              <td>{{$experience->country}}</td>
              </tr>
              <tr>
              <tr>
             
              <td colspan="2"><strong>Description:</strong> {!! $experience->experience !!}</td>
              </tr>
              <tr>
              <td>Action</td>
              <td> 
              <button type="button" onclick="removeexperience({{$experience->id}}, {{$experience_row}});" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button>
              <button type="button" onclick="editExperience({{$experience->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button>
              </td>
              </tr>
            <?php $experience_row++; ?>
            @endforeach
            @endif
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2"><button type="button" onclick="addmobExperience();" data-toggle="tooltip" title="Add More experience" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More Experience</button></td>
              </tr>
            </tfoot>
          </table>
        </div>


      </form>
    </div><!-- /.box-body -->
  <script type="text/javascript">
    function removeexperience(id,row)
    {
    if(confirm('Are you sure, Do You Want To Delete This experience?')){
    var token = $('input[name=\'_token\']').val();
        $.ajax({
          type: 'POST',
          url: '{{url("/employee/experience/delete")}}',
          data: 'id='+id+'&_token='+token,
          cache: false,
          success: function(Success){
            $('#row-'+row).remove();
            $('#second_row_'+row).remove();
          }
      });
      }
    }
    var experience_row = '{{$experience_row + 1}}';
    function addExperience()
    {
        html = '<tr id="row-'+experience_row+'">';
        html += '<td class="institutiontd"><input type="text" name="experience['+experience_row+'][organization]" class="form-control institution" id="ins_'+experience_row+'" autocomplete="off" placeholder="Name of Organization"><input type="hidden" name="experience['+experience_row+'][institution_id]" id="employer_id'+experience_row+'"> <div id="orglist'+experience_row+'" class="col-md-12 orglist"></div></td>';
       
        html += '<td><select  class="form-control" name="experience['+experience_row+'][typeofemployment]">@foreach($datas["employment_type"] as $em_type)<option value="{{$em_type["value"]}}">{{$em_type["value"]}}</option>@endforeach</select></td>';
        html += '<td><select id="orgtype_'+experience_row+'" class="form-control" name="experience['+experience_row+'][org_type_id]">@foreach($datas["organization_type"] as $org_type)<option value="{{$org_type->id}}">{{$org_type->name}}</option>@endforeach</select></td>';
        html += '<td><input type="text" name="experience['+experience_row+'][designation]" class="form-control" placeholder="Designation"></td>';
        html += '<td><select class="form-control" name="experience['+experience_row+'][level]">@foreach($datas["job_level"] as $job_level)<option value="{{$job_level["value"]}}">{{$job_level["value"]}}</option>@endforeach</select></td>';
        html += '<td><input type="text" id="form_'+experience_row+'" name="experience['+experience_row+'][from]" class="form-control date" placeholder="2010-01-02"></td>';
        html += '<td><input type="text" id="to_'+experience_row+'" name="experience['+experience_row+'][to]" class="form-control date" placeholder="2010-01-02"></td>';
        html += '<td><select id="'+experience_row+'" class="form-control currently" name="experience['+experience_row+'][currently_working]">@foreach($datas["working_status"] as $working_status)<option value="{{$working_status["value"]}}">{{$working_status["title"]}}</option>@endforeach</select></td>';
        html += '<td><input type="text" name="experience['+experience_row+'][country]" class="form-control" placeholder="Country Name"></td>';
        html += '<td rowspan="2"><button type="button" onclick="$(\'#row-'+experience_row+'\').remove();$(\'#second_row_'+experience_row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';
        html += '<tr id="second_row_'+experience_row+'"><td colspan="9"><textarea class="form-control" placeholder="Experience Detail" name="experience['+experience_row+'][detail]"></textarea></td></tr>';
        $('#experience').append(html);
  experience_row++;
    };
</script>
  <script type="text/javascript">


$(document).on('focus',".date", function(){ //bind to all instances of class "date". 
   $(this).datepicker();
});
</script>
  <script type="text/javascript">
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
                   $('#orgtype_'+rowid).val(org_type);
                  $('#orgtype_'+rowid).trigger('change');
                  $('#orglist'+rowid).html('').fadeOut();
                })
              } else{
              $('#orglist'+rowid).html('').fadeOut();
            }
          }
      });
      })
     $(document).on('change',".currently", function()
     {
      var tod = '{{date("Y-m-d")}}';
      var row = $(this).attr('id');
      var id= $(this).val();
      if (id == 1) {
        $('#to_'+row).val(tod);
      }
     })
  </script>

  <div class="modal fade servicemodal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title left" >Edit Experience</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/experiences/update') }}">
        <input type="hidden" name="experience_id"id="experience_id" value="">
        {!! csrf_field() !!}
      <div class="modal-body" id="experience_detail">
                
        
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

<div class="modal fade servicemodal" id="modal-addexperience" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title left">Add Experience</h4>
          <button type="button" class="close right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/experiences/save') }}">
          {!! csrf_field() !!}
          <div class="modal-body">
            <div class="form-group row ">
              <label class="col-md-4 required">Organization</label>
              <div class="col-md-8">
                <input type="text" required="required" class="form-control" id="institution" name="organization" value="">
                <input type="hidden" name="employers_id" id="employer_id" value="">
                <div id="institution_list" class="col-md-12 orglist">    </div>
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">Type Of Employment</label>
              <div class="col-md-8">
                <select class="form-control" name="typeofemployment">
                  @foreach($datas["employment_type"] as $em_type)<option value="{{$em_type["value"]}}">{{$em_type["value"]}}</option>@endforeach
                </select>
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">Organization Type</label>
              <div class="col-md-8">
                <select class="form-control" name="org_type_id">
                  @foreach($datas["organization_type"] as $org_type)<option value="{{$org_type->id}}">{{$org_type->name}}</option>@endforeach
                </select>
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">Designation</label>
              <div class="col-md-8">
                <input type="text" required="required" class="form-control" name="designation" placeholder="Wordpress Developer">
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">Level</label>
              <div class="col-md-8">
                <select class="form-control" name="level">
                @foreach($datas["job_level"] as $job_level)<option value="{{$job_level["value"]}}">{{$job_level["value"]}}</option>@endforeach
                </select>
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">from</label>
              <div class="col-md-8">
                <input type="text" required="required" class="form-control date" name="from" placeholder="2019-12-16">
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">To</label>
              <div class="col-md-8">
                <input type="text" required="required" class="form-control date" name="to" id="to" placeholder="2019-12-18">
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">Currently Working</label>
              <div class="col-md-8">
                <select class="form-control" id="currently" name="currently_working">
                  @foreach($datas["working_status"] as $working_status)<option value="{{$working_status["value"]}}">{{$working_status["title"]}}</option>@endforeach
                </select>
              </div>
            </div> 
            <div class="form-group row ">
              <label class="col-md-4 required">Country</label>
              <div class="col-md-8">
                <input type="text" required="required" class="form-control" name="country" placeholder ="Nepal">
              </div>
            </div>
            <div class="form-group row ">
              <label class="col-md-4 required">Experience Detail</label>
              <div class="col-md-8">
                <textarea class="form-control" name="detail" required="required"></textarea>
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
   function editExperience(experience_id) {
       var token = $('input[name=\'_token\']').val();
       $.ajax({
      type: 'POST',
        url: '{{url("/employee/experiences/getedit")}}',
        data: '_token='+token+'&experience_id='+experience_id,
        cache: false,
        success: function(html){
          $('#experience_detail').html(html);
          $('#modal-edit').modal('show');
          $('#experience_id').val(experience_id);
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

   $(document).on('change',"#currently", function()
     {
      var tod = '{{date("Y-m-d")}}';
      
      var id= $(this).val();
      if (id == 1) {
        $('#to').val(tod);
      }
     })
</script>

<script type="text/javascript">
    function addmobExperience(){
      $('#modal-addexperience').modal('show');
    }
  </script>
@stop()