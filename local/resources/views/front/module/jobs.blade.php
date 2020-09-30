<!-- job blocks section started here -->
<section id="job" class="jobs tb60p">
  <div class="container rn_container">
    <div class="center btm30p">
      <p class="titlelogo"><img src="{{asset('images/job.png')}}"></p>
      <p>Find the right job</p>
      <!-- <h2 class="h2 tp20m">Rolling Jobs</h2> -->
      <div class="title_bg"></div>
    </div>

    <form class="search_form col-md-12 col-lg-8" method="POST" action="{{url('/search')}}">
      <div class="row cm10-row">
        <div class="col-md-5">
            <input type="text" class="form-control" placeholder="key words">
        </div>
        <div class="col-md-3">
          <select id="inputState" name="location" class="form-control">
            @foreach($datas['locations'] as $location)
            <option value="{{$location->id}}">{{$location->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3">
          <select id="inputState" name="category" class="form-control">
            @foreach($datas['categories'] as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-1">
          <button type="submit" class="btn searchicon right"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
      </div>
    </form>
    <!-- nexus page search form section ended here -->
    
    <div class="row tb35p">
      <div class="col-md-4 col-lg-3">
        <div class="white_block">
          <h3 class="h3 btm15m">Categories</h3>
          <div class="lft_block">
            <ul>
              @foreach($datas['category'] as $cat)
              <li class="category text-ellipsis"><a href="{{$cat['url']}}" >{{$cat['title']}} </a></li>
              @endforeach
            </ul>
            <div class="tp10p">
              <a href="{{url('/jobs/categories')}}" class="morejob" >All Categories <i class="fa fa-arrow-alt-circle-right"></i></a>
            </div>
          </div>
      </div>
    </div>
     <!--  left block section ended here -->

      <div class="col-md-8 col-lg-9">
        <div class="row cm10-row">
          @foreach($datas['job_type'] as $jobtype)
          <div class="col-lg-4 col-md-6">
            <h3 class="h3 btm15m">{{$jobtype['title']}} 
              @if($jobtype['image'] != '')
              <img style="max-height: 20px;" src="{{$jobtype['image']}}">
              @endif
            </h3>
            @foreach($jobtype['employer'] as $employer)
              <?php if(count($employer['jobs']) > 2) {
                $class = 'has-multiple';
                } else {
                $class = '';
                } ?>

            <div class="comn_block {{$class}}">
              <div class="next">
              <div class="row cm10-row">
                <div class="col-md-3 col-lg-3 col-3">
                  <div class="complogo">
                      @if($employer['logo'] != '')
                                <a href="{{$employer['url']}}"><img src="{{asset($employer['logo'])}}"></a>
                                @else
                                <div class="noimage_sqr backgroundcolor-{{$employer['fletter']}}">{{$employer['fn']}}</div>
                                @endif
                  </div>
                </div>
                <div class="col-md-9 col-lg-9 col-9 text-ellipsis">
                  <a class="company_name" title="{{$employer['employer_name']}}" href="{{$employer['url']}}" >{{$employer['employer_name']}}</a>
                  <ul class="joblist">
                    @foreach($employer['jobs'] as $job)
                    <li class="text-ellipsis"><a href="{{url('/jobs/'.$employer['seo_url'].'/'.$job['seo_url'])}}" >{{$job['title']}}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            </div>
            @endforeach
            <a href="{{$jobtype['url']}}" class="morejob" >{{$jobtype['title']}} <i class="fa fa-arrow-alt-circle-right"></i></a>
          </div>
          <!-- job type block ended here -->
          @endforeach
          
        
        </div>
      </div>
      <!-- right block section ended here -->
    </div>

    <div class="center">
      <a href="{{url('/jobs')}}" class="btn browsebtn" >Browse all jobs</a>
    </div>
  </div>
</section>
<!-- job block section ended here -->
