@extends('admin_master')
@section('heading')
Training Category
            <small>List of Training Category</small>
@stop
@section('breadcrubm')
 <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            
            <li class="active">Training Category</li>
@stop
@section('content')
 <div class="row">
    <div class="col-xs-12">
      <div class="row">
        <a href="{{ url('/admin/training_category/addnew') }}" class="btn btn-primary right"><i class="fa fa-fw fa-plus"></i>Add New Training Category</a>
      </div>
     
      <div class="box">
            <div class="box-body">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>S.N.</th>
                        
                         <th>Title</th>
                        
                       
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      
                      <?php $i=1; 
                        foreach ($datas as $row) { ?>
                          <tr>
                        <td><?php echo $i++ ;?></td>
                        
                         <td><?php echo $row->title;?></td>
                          
                       
                        <td><a href="{{ url('/admin/training_category/edit/'.$row->id) }}" class="btn btn-primary left"><i class="fa fa-edit"></i></a>
                          <a href="javascript:void(0);" onClick="confirm_delete('/{{$row->id}}')" class="btn btn-danger left"><i class="fa fa-fw fa-remove"></i></a>
                        </td>
                      </tr>
                      <?php  }

                      ?>
                      

                    </table>

          </div><!-- /.box-body -->
      </div>
    </div>
  <div>

  <div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="dataTables_paginate paging_simple_numbers right">
          <?php echo $datas->render();?>
      </div>
    </div>
  </div>
  
  <script type="text/javascript">
 function confirm_delete(ids){
    if(confirm('Do You Want To Delete This training_category?')){
      var url= "{{ url('/admin/training_category/delete/') }}"+ids;
      location = url;
      
      }
    }
 </script>
@stop()