@extends('admin_master')
@section('heading')
Layout
            <small>List of Layout</small>
@stop
@section('breadcrubm')
 <li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            
            <li class="active">Layout</li>
@stop
@section('content')
 <div class="row">
    <div class="col-xs-12">
      <div class="row">
        <a href="{{ url('/admin/layout/addnew') }}" class="btn btn-primary right"><i class="fa fa-fw fa-plus"></i>Add New Layout</a>
      </div>
     
      <div class="box">
            <div class="box-body">
                  <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>S.N.</th>
                        <th> Layout Title</th>
                        <th>Layout Route</th>
                        
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                       
                      <?php $i=1; 
                        foreach ($data as $row) { ?>
                          <tr>
                        <td><?php echo $i++ ;?></td>
                        <td><?php echo $row->layout_title;?></td>
                        <td><?php echo $row->layout_route;?></td>
                      
                        <td><a href="{{ url('/admin/layout/delete/'.$row->layout_id) }}" class="btn btn-danger left"><i class="fa fa-fw fa-remove"></i></a></td>
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
          <?php echo $data->render();?>
      </div>
    </div>
  </div>
  
@stop()