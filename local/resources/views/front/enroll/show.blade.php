@extends('front.event-master')
@section('header')
<section class="enroll_content">
  <div class="inner_overlay"></div>
  <div class="container rn_container z-index2">
    @include('front/common/enroll_header')

  </div>
</section>
<!-- header part with navigation ended here -->
@stop
@section('banner')
<!-- banner section with search form ended here -->
@stop
@section('content')

<section>
        <div class="container">
            <div class="row">
                 <!-- Modal Header -->
                @foreach ($companies as $company)
                    @if($company->publish_status == 1)
                        <div class="col-md-5" id="video_content">
                            <div class="modal-header">
                                <h4 class="modal-title center"><strong>{{ $company->company_name}}</strong></h4>
                            </div>

                            <!-- Modal body -->
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$company->intro_video}}?&theme=dark&autohide=2&modestbranding=1&amp;rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                {{-- {!! Embed::make($company->intro_video_link)->parseUrl()->getIframe() !!} --}}

                            </div>
                            <div class="modal-footer">
                                {{-- {{route('enroll_companyDetail.homepage', $company->id) }} --}}
                                @if(auth()->guard('employee')->user())
                                    <a href="{{route('enroll_companyDetail.homepage', $company->seo_url) }}" class="btn btn-info center" data-dismiss="modal">Enter</a>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
</section>
@stop
<style>
    #video_content{
        background: whitesmoke;
        margin-top: 120px;
        margin-left: 50px;
        margin-bottom: 30px;
    }
    /* .modal-body{
        background: wheat;
        display: flex;
    } */


</style>
