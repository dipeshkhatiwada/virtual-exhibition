@extends('front.tender-master')
@section('header')
<section class="rt_banner">
  <div class="container rn_container">
    @include('front/common/common_header')
    <div class="">
        <h3 class="tp30p center"><span class="whiteclr">Reference</span> <span class="greencolor"> Comment </span> </h3>
        
          
       
    </div>
  </div>
</section>
<!-- header part with navigation ended here -->
@stop
@section('banner')
<!-- banner section with search form ended here -->
@stop
@section('content')
<section class="tb35p">
            <div class="container">

 
                      
                         <div class="careerfy-employer-box-section mt-3">
                        
                        
                         <div class="col-md-12 ">
                                 <div class="alert alert-danger"><center>{{$message}} !!</center></div>
                            </div>
                        </div>
                    </div>
               </section>


@stop

