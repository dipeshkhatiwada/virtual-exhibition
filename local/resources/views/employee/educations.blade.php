@extends('employe_master')
@section('content')

<!-- left pannel of accordian menu and service package ended here -->
<h3 class="form_heading">{{$datas['name']}} Educations</h3>
    <div class="">
      @if(count($errors))
        <div class="row">
          <div class="col-md-12">
            <div class="alert alert-danger">
              @foreach($errors->all() as $error)
                {{ '* : '.$error }}</br>
              @endforeach
            </div>
          </div>
        </div>

      @endif
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/updateeducation') }}">
        <input type="hidden" name="id" value="{{$datas['employee']->id}}">
       <div class="form-group hidden-xs">
      {!! csrf_field() !!}
      <div class="table-responsive-lg">
        <table class="table table-bordered table-hover table_form">
            <thead>
              <th>Country</th>
              <th>Education Level</th>
              <th>Faculty</th>
              <th>Specialization</th>
              <th>Institution</th>
              <th>Board</th>
              <th>Mark System</th>
              <th>Percent/CGPA</th>
              <th>Year</th>
              <th>Action</th>
            </thead>
            <tbody id="education">
              <?php $education_row = 0; ?>
              @foreach($datas['education'] as $education)
              @if($education->marksystem == 3)
              @php($marksystem = 'CGPA out of 10')
              @elseif($education->marksystem == 2)
              @php($marksystem = 'CGPA out of 4')
              @else
              @php($marksystem = 'Percentage')
              @endif
              <tr id="row-{{$education_row}}">
                  <td>{{$education->country}}</td>
                  <td>{{\App\faculty::getLevelTitle($education->level_id)}}</td>
                  <td>{{\App\Faculty::getTitle($education->faculty_id)}}</td>
                  <td>{{$education->specialization}}</td>
                  <td>{{$education->institution}}</td>
                  <td>{{$education->board}}</td>
                  <td>{{$marksystem}}</td>
                  <td>{{$education->percentage}}</td>
                  <td>{{$education->year}}</td>
                  <td><button type="button" onclick="removeEducation({{$education->id}}, {{$education_row}});" data-toggle="tooltip" title="Remove" class="btn whitegradient redclr"><i class="fa fa-fw fa-remove"></i> Delete</button><button type="button" onclick="editEducation({{$education->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button></td>
              </tr>
              <?php $education_row++; ?>
              @endforeach
              @if(is_array(old('educations')) > 0)
              @if(count(old('educations')) > 0)
          
              @foreach(old('educations') as $key => $old)
                <tr id="row-{{$education_row}}">
                  <td class="{{ $errors->has('educations.'.$key.'.country') ? ' has-error' : '' }}"><input type="text" name="educations[{{$education_row}}][country]" class="form-control" value="{{$old['country']}}">
                    @if ($errors->has('educations.'.$key.'.country'))
                        <span class="help-block">
                            <strong>{{ $errors->first('educations.'.$key.'.country') }}</strong>
                        </span>
                    @endif
                  </td>
                  <td class="{{ $errors->has('educations.'.$key.'.level_id') ? ' has-error' : '' }}">
                    <select class="form-control level_id" id="{{$education_row}}" name="educations[{{$education_row}}][level_id]">
                      <option value="0">Select Level</option>
                      @foreach($datas['educationlevel'] as $levels)
                        @if($old['level_id'] == $levels->id)
                        <option selected="" value="{{$levels->id}}">{{$levels->name}}</option>
                        @else
                        <option value="{{$levels->id}}">{{$levels->name}}</option>
                        @endif
                      @endforeach
                    </select></td>
                  <td>
                      <select class="form-control" id="faculty_{{$education_row}}" name="educations[{{$education_row}}][faculty]">
                        <?php echo \App\Faculty::getFaculties($old['level_id'],$old['faculty']); ?>
                      </select>
                  </td>
                  <td class="{{ $errors->has('educations.'.$key.'.specialization') ? ' has-error' : '' }}"><input type="text" name="educations[{{$education_row}}][specialization]" value="{{$old['specialization']}}" class="form-control">@if ($errors->has('educations.'.$key.'.specialization'))
                      <span class="help-block">
                          <strong>{{ $errors->first('educations.'.$key.'.specialization') }}</strong>
                      </span>
                  @endif</td>
                  <td class="institutiontd {{ $errors->has('educations.'.$key.'.institution') ? ' has-error' : '' }}"><input type="text" name="educations[{{$education_row}}][institution]" id="ins_{{$education_row}}" autocomplete="off" value="{{$old['institution']}}" class="form-control institution">
                    <input type="hidden" name="educations[{{$education_row}}][institution_id]" id="employer_id{{$education_row}}" value="{{$old['institution_id']}}">
                    <div id="orglist{{$education_row}}" class="col-md-12 orglist">    </div>
                    @if ($errors->has('educations.'.$key.'.institution'))
                        <span class="help-block">
                            <strong>{{ $errors->first('educations.'.$key.'.institution') }}</strong>
                        </span>
                    @endif</td>
                  <td class="{{ $errors->has('educations.'.$key.'.board') ? ' has-error' : '' }}"><input type="text" name="educations[{{$education_row}}][board]" value="{{$old['board']}}" class="form-control">@if ($errors->has('educations.'.$key.'.board'))
                      <span class="help-block">
                          <strong>{{ $errors->first('educations.'.$key.'.board') }}</strong>
                      </span>
                  @endif</td>
                  <td class="{{ $errors->has('educations.'.$key.'.marksystem') ? ' has-error' : '' }}">
                    <select class="form-control" name="educations[{{$education_row}}][marksystem]">
                       @foreach($datas['marksystem'] as $msys)
                        @if($old['marksystem'] == $msys['value'])
                        <option selected="selected" value="{{$msys['value']}}">{{$msys['title']}}</option>
                        @else
                        <option value="{{$msys['value']}}">{{$msys['title']}}</option>
                        @endif
                        @endforeach
                    </select>
                   
                    @if ($errors->has('educations.'.$key.'.marksystem'))
                      <span class="help-block">
                          <strong>{{ $errors->first('educations.'.$key.'.marksystem') }}</strong>
                      </span>
                  @endif</td>
                  <td class="{{ $errors->has('educations.'.$key.'.percent') ? ' has-error' : '' }}"><input type="text" name="educations[{{$education_row}}][percent]" value="{{$old['percent']}}" class="form-control">@if ($errors->has('educations.'.$key.'.percent'))
                      <span class="help-block">
                          <strong>{{ $errors->first('educations.'.$key.'.percent') }}</strong>
                      </span>
                  @endif</td>
                  <td class="{{ $errors->has('educations.'.$key.'.year') ? ' has-error' : '' }}"><input type="text" name="educations[{{$education_row}}][year]" value="{{$old['year']}}" maxlength="4" class="form-control">@if ($errors->has('educations.'.$key.'.year'))
                      <span class="help-block">
                          <strong>{{ $errors->first('educations.'.$key.'.year') }}</strong>
                      </span>
                  @endif</td>
                  <td><button type="button" onclick="$('#row-{{$education_row}}').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td>
                </tr>
              <?php $education_row++; ?>
              @endforeach
              @endif
              @endif
            </tbody>
            <tfoot>
              <tr>
                <td colspan="10"><button type="button" onclick="addEducation();" data-toggle="tooltip" title="Add More Education" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More Education</button></td>
              </tr>
            </tfoot>
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
        <tbody id="education">
          <?php $education_row = 0; ?>
          @foreach($datas['education'] as $education)
          <tr id="row-{{$education_row}}">
            <th>Country</th>
            <th>{{$education->country}}</th>
          </tr>
          <tr>
            <td>Education Level</td>
            <td>{{\App\faculty::getLevelTitle($education->level_id)}}</td>
          </tr>
          <tr>
            <td>Faculty</td>
            <td>{{\App\Faculty::getTitle($education->faculty_id)}}</td>
          </tr>
          <tr>
            <td>Specialization</td>
            <td>{{$education->specialization}}</td>
          </tr>
          <tr>
            <td>Institution</td>
            <td>{{$education->institution}}</td>
          </tr>
          <tr>
            <td>Board</td>
            <td>{{$education->board}}</td>
          </tr>
          <tr>
            <td>Percent/CGPA</td>
            <td>{{$education->percentage}}</td>
          </tr>
          <tr>
            <td>Year</td>
            <td>{{$education->year}}</td>
          </tr>
          <tr>
            <td>Action</td>
            <td> 
              <button type="button" onclick="removeEducation({{$education->id}}, {{$education_row}});" data-toggle="tooltip" title="Remove" class="btn whitegradient redclr"><i class="fa fa-fw fa-remove"></i> Delete</button>
              <button type="button" onclick="editEducation({{$education->id}});" data-toggle="tooltip" title="Edit" class="btn whitegradient greenclr"><i class="fa fa-edit"></i> Edit</button>
            </td>
          </tr>
          <?php $education_row++; ?>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="10"><button type="button" onclick="addmobEducation();" data-toggle="tooltip" title="Add More Education" class="btn lightgreen_gradient right"><i class="fa fa-plus-circle"></i> Add More Education</button></td>
          </tr>
        </tfoot>
      </table>
    </div>
   



      </form>
    </div>


    <div class="modal fade servicemodal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title left" >Edit Education</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/educations/update') }}">
        <input type="hidden" name="education_id"id="education_id" value="">
        {!! csrf_field() !!}
      <div class="modal-body" id="education_detail">
                
        
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


<div class="modal fade servicemodal" id="modal-addmobEducation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title left">Add Education</h4>
        <button type="button" class="close right" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
      </div>
      <form class="form-horizontal dash_forms" role="form" id="testform" method="POST" action="{{ url('/employee/educations/save') }}">
        {!! csrf_field() !!}
        <div class="modal-body" id="education_detail">
          <div class="form-group row ">
            <label class="col-md-4 required">Country</label>
            <div class="col-md-8">
            <input type="text" required="required" class="form-control" name="country" placeholder="Country">
            </div>
          </div>
          <div class="form-group row ">
            <label class="col-md-4 required">Education Level</label>
            <div class="col-md-8">
            <select class="form-control" id="level_id" name="level_id">
              <option value="0">Select Level</option>
              @foreach($datas['educationlevel'] as $levels)
                <option value="{{$levels->id}}">{{$levels->name}}</option>
              @endforeach
            </select>
            </div> 
          </div>
          <div class="form-group row">
            <label class="col-md-4 required">Faculty</label>
            <div class="col-md-8">
              <select class="form-control" id="faculty" name="faculty_id">
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 required">Specialization</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="specialization" placeholder="Specialization">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 required">Institution</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" id="institution" name="institution" placeholder="Institution">
              <input type="hidden" name="employers_id" id="employer_id" placeholder="Employer ID">
              <div id="institution_list" class="col-md-12 orglist">    </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 required">Board</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="board" placeholder="Board">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 required">Mark System</label>
            <div class="col-md-8">
              <select class="form-control" name="marksystem">@foreach($datas['marksystem'] as $msys)<option value="{{$msys['value']}}">{{$msys['title']}}</option>@endforeach  </select>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-md-4 required">Percent/CGPA</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" name="percent" placeholder="Percent">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-4 required">Year</label>
            <div class="col-md-8">
              <input type="text" required="required" class="form-control" maxlength="4" name="year" placeholder="Year">
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
    function removeEducation(id,row)
    {
      if(confirm('Are you sure, Do You Want To Delete This Education?')){
      var token = $('input[name=\'_token\']').val();
          $.ajax({
            type: 'POST',
            url: '{{url("/employee/deleteeducation")}}',
            data: 'id='+id+'&_token='+token,
            cache: false,
            success: function(Success){
                $('#row-'+row).remove();
               
            }
        });
        }
    }
    $(document).on('change', '.level_id', function(){

      var lid = ["6", "7"];

        var id = $(this).attr('id');
        var data = $(this).val();
        var token = $('input[name=\'_token\']').val();
        if (data != '0') {
          if (lid.includes(data)) {
            $('#faculty_'+id).removeAttr("required");
          } else{
            $('#faculty_'+id).attr("required", "required");
          }


            $.ajax({
        type: 'POST',
        url: '{{url("/employee/getfaculty")}}',
        data: 'id='+data+'&_token='+token,
        cache: false,
        success: function(html){
            $('#faculty_'+id).html(html);
           
        }
    });
        } else{
            html = '<option value="0">Select Faculty</option>';
            $('#faculty_'+id).html(html);
        }
    });
     var row = '{{$education_row + 1}}';
    function addEducation()
    {
       
        html = '<tr id="row-'+row+'"><td><input type="text" name="educations['+row+'][country]" class="form-control"></td><td><select class="form-control level_id" id="'+row+'" name="educations['+row+'][level_id]"><option value="0">Select Level</option>@foreach($datas["educationlevel"] as $levels)<option value="{{$levels->id}}">{{$levels->name}}</option>@endforeach</select></td><td><select class="form-control" id="faculty_'+row+'" name="educations['+row+'][faculty]"><option value="'+row+'">Select Faculty</option></select></td><td><input type="text" name="educations['+row+'][specialization]" class="form-control"></td><td class="institutiontd"><input type="text" name="educations['+row+'][institution]" class="form-control institution" id="ins_'+row+'" autocomplete="off"><input type="hidden" name="educations['+row+'][institution_id]" id="employer_id'+row+'"> <div id="orglist'+row+'" class="col-md-12 orglist"></div></td><td><input type="text" name="educations['+row+'][board]" class="form-control"></td>';
        html += '<td><select class="form-control" name="educations['+row+'][marksystem]">@foreach($datas['marksystem'] as $msys)<option value="{{$msys['value']}}">{{$msys['title']}}</option>@endforeach</select></td>';
        html += '<td><input type="text" name="educations['+row+'][percent]" class="form-control"></td><td><input type="text" name="educations['+row+'][year]" maxlength="4" class="form-control"></td><td><button type="button" onclick="$(\'#row-'+row+'\').remove();" data-toggle="tooltip" title="remove" class="btn whitegradient redclr"><i class="fa fa-minus-circle"></i> Remove</button></td></tr>';
        $('#education').append(html);
  row++;
    };
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
              
              $('#orglist'+rowid).html('').fadeOut();
            })
          } else{
            $('#orglist'+rowid).html('').fadeOut();
           
        }
          }
  });
  })
</script>
  <script type="text/javascript">
    function editEducation(education_id) {
       var token = $('input[name=\'_token\']').val();
       $.ajax({
      type: 'POST',
        url: '{{url("/employee/educations/getedit")}}',
        data: '_token='+token+'&education_id='+education_id,
        cache: false,
        success: function(html){
          $('#education_detail').html(html);
          $('#modal-edit').modal('show');
          $('#education_id').val(education_id);
          }
  });
    }



    $(document).on('change', '#level_id', function(){
       
        var data = $(this).val();
        var token = $('input[name=\'_token\']').val();
        if (data != '0') {
          var lid = ["6", "7"];
          if (lid.includes(data)) {
            $('#faculty').removeAttr("required");
          } else{
            $('#faculty').attr("required", "required");
          }

            $.ajax({
        type: 'POST',
        url: '{{url("/employee/getfaculty")}}',
        data: 'id='+data+'&_token='+token,
        cache: false,
        success: function(html){
            $('#faculty').html(html);
           
        }
    });
        } else{
            html = '<option value="0">Select Faculty</option>';
            $('#faculty').html(html);
        }
    });
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
  function addmobEducation(){
    $('#modal-addmobEducation').modal('show');
  }
</script>
@stop()