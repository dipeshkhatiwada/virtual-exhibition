<div class="jobs_blade">
  <h3 class="h3 btm15m">{{$datas['title']}}
   
  </h3>
  <div class="row cm10-row">
    @foreach($datas['employers'] as $employer)
    <?php if(count($employer['jobs']) > 2) {
    $class = 'has-multiple';
    } else {
    $class = '';
    } ?>
    <div class="col-md-6 col-12 col-lg-4 job-types">
      <div class="comn_block {{$class}}">
        <div class="next">
          <div class="row cm-row">
            <div class="col-md-3 col-lg-3 col-3">
              <div class="complogo">
                   @if($employer['logo'] != '')
                    <a href="{{$employer['url']}}"><img src="{{asset($employer['logo'])}}"></a>
                    @else
                    <div class="noimage_sqr backgroundcolor-{{$employer['fletter']}}">{{$employer['fn']}}</div>
                    @endif
                
              </div>
            </div>
            <div class="col-md-9 col-lg-9 col-9 job-list text-ellipsis">
              <div class="lft10p">
              <a class="company_name" title="{{$employer['employer_name']}}" href="{{$employer['url']}}" >{{$employer['employer_name']}}</a>
              <ul class="joblist">
                @foreach($employer['jobs'] as $job)
                <li class="text-ellipsis"><a title="{{$job['title']}}" href="{{url('/jobs/'.$employer['seo_url'].'/'.$job['seo_url'])}}">{{$job['title']}}</a></li>
                @endforeach
              </ul>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach 
  </div>
  
</div>