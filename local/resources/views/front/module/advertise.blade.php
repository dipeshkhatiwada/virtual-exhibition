<section>                     
    <div class="advertisement row cm-row btm7m">
    @foreach($data['advertise'] as $advertise)
    <div class="text-center {{$data['class']}} mb-1">
        <a href="{{$advertise['url_link']}}" title="{{$advertise['title']}}" target="_blank">
            <img src="{{asset($advertise['image'])}}" class="lazy img-fluid" alt="{{$advertise['title']}}" style="width: 100% !important;">
        </a>
        </div>
       
    @endforeach 
    </div>
</section>