@extends('admin_master')
@section('heading')
Edit Booth/Stall
<small>Detail of Booth/Stall</small>
@stop
@section('breadcrubm')
<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
@stop
@section('content')
<style type="text/css">
#publish-by{
display: none;
}
</style>
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Booth/Stall Information</div>
                    <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="mainevent">
                                        <form class="dash_forms" role="form" enctype="multipart/form-data" id="testform" method="POST" action="{{route('enroll.updateBootAttr', $ticket_type->id )}}">
                                                @csrf
                                                <div class="form-group row ">
                                                    <div class="col-md-6">
                                                        <label class="required">Booth/Stall Name</label>
                                                        <input type="hidden" name="idBooth" value="{{ $ticket_type->booth->id }}">
                                                        <input type="text" class="form-control" id="booth_name" name="booth_name" value="{{ $ticket_type->booth->booth_name }}">
                                                    </div>
                                                </div>
                                                <div class="form-group row ">
                                                    <div class="col-md-6">
                                                        <div class="table-responsive-lg">
                                                        <table class="table table_form table-hover" id="subcategory">
                                                            <thead>
                                                            <tr>
                                                                <th class="required">Ticket Type</th>
                                                                <th class="required">Price</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="booth_ticket">
                                                                <tr id="booth_ticket_0">
                                                                <td><input type="text" name="ticket" class="form-control" placeholder="Ticket Type" value="{{ $ticket_type->ticket_name }}" required></td>
                                                                <td><input type="number" name="price" class="form-control" placeholder="Price" value="{{ $ticket_type->price }}" required></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <button type="submit" class="btn sendbtn bluebg">Submit <i class="fab fa-telegram"></i></button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
