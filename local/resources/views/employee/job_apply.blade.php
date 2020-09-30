@extends('employe_master')
@section('content')
      <h3 class="form_heading">You are Applying for {{$datas['job']->title}}</h3>
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
          <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="{{url('/employee/job/saveapply')}}">
             <input type="hidden" name="job_id" value="{{$datas['job']->id}}">
             <input type="hidden" name="title" value="{{$datas['job']->title}}">
              {!! csrf_field() !!}                 
                @foreach($datas['jobs_form'] as $value)
                                  @if($value['type'] != 'file')
                                    <div class="form-group">
                                    <?php if($value['rq'] == 1){
                                          $rq= 'required' ;
                                        } else {
                                          $rq='';
                                        }
                                        ?>
                                      <input type="hidden" name="my_datas[{{$value['id']}}][optitle]"  value="<?php echo $value['level'];?>" />
                                      @if($datas['job']->id == 26)
                                      <label class="col-md-3 control-label {{$rq}}"><?php echo ucfirst($value['level']);?></label>
                                      <div class="col-md-9 extra_form"><?php echo $value['form'];?>
                                      </div>
                                      @else
                                      <label class="col-md-12 control-label {{$rq}}" style="text-align: left;"><?php echo ucfirst($value['level']);?></label>
                                      <div class="col-md-12 extra_form"><?php echo $value['form'];?>  
                                      </div>
                                      @endif
                                      <div style="clear: both;"></div>
                                    </div>
                                    @elseif($value['type'] == 'file')
                                    <div class="form-group">
                                    <?php if($value['rq'] == 1){
                                          $rq= 'required' ;
                                        } else {
                                          $rq='';
                                        }
                                         ?>   
                                             
                                              <input type="hidden" name="extrafile[{{$value['id']}}][optitle]"  value="<?php echo $value['level'];?>" />
                                              @if($datas['job']->id == 26)
                                             
                                              <label class="col-md-3 control-label {{$rq}}"><?php echo ucfirst($value['level']);?></label>
                                              <div class="col-md-9 extra_form"><?php echo $value['form'];?>
                                                 
                                                                                                         
                                                  
                                              </div>
                                              @else
                                              <label class="col-md-12 control-label {{$rq}}" style="text-align: left;"><?php echo ucfirst($value['level']);?></label>
                                              <div class="col-md-12 extra_form"><?php echo $value['form'];?>
                                                 
                                                                                                       
                                                  
                                              </div>
                                              @endif
                                              <div style="clear: both;"></div>
                                    </div>
                                   @endif
                                    @endforeach
              
       
              <div class="form-group row">
                  <div class="col-md-9 col-sm-9 col-xs-7 col-md-offset-4">
                      <button type="submit" class="btn btn-primary">
                          <i class="fa fa-fw fa-save"></i> Submit
                      </button>
                  </div>
              </div>
          </div>
          
          </form>
      </div>
    <script type="text/javascript">
         $(document).on('change', '.select',function(){
            var a = $(this).attr('opvl');
            var b = $(this).children(':selected').attr('id');
            $('#hidden_'+a).val(b);
            $('#hidden_'+a).trigger('change');
            var extra = $('#extra_'+a).val();
            var token = $('input[name=\'_token\']').val();
            var ex = extra.split(',');
            var current_value = $(this).val();

            if(extra.includes(current_value)){
                 $.ajax({
                     type: 'POST',
                url: '{{url("/employee/jobs/getExtraForm")}}',
                data: 'id='+a+'&_token='+token,
                cache: false,
                success: function(html){
                   
                 
                   
                      $('#aextra_'+a).html(html); 
                  }
                   
                });

            }else{
                 $('#aextra_'+a).html('');
            }
            
           
           
        });
    </script>

   

@endsection