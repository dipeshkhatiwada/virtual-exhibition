<section id="project" class="tb60p">
  <div class="container rn_container">
    <div class="center">
      <p class="titlelogo"><img src="{{asset($datas['logo'])}}"></p>
      <p>{{$datas['description']}}</p>
      <div class="title_bg"></div>
    </div>
    <div class="row cm10-row tb35p">
      <div class="col-md-4 col-lg-3">
        <div class="white_block tp20m">
          <h3 class="h3 btm15m">Categories</h3>
        <div class="lft_block">
          <ul>
            @foreach($datas['category'] as $category)
            <li><a href="{{$category['url']}}" >{{$category['title']}} <span>({{$category['total']}})</span></a></li>
            @endforeach
          </ul>
          <div class="tp10p">
            <a href="{{url('/projects/category')}}" class="morejob" >All Categories <i class="fa fa-arrow-alt-circle-right"></i></a>
          </div>
        </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-9">
        <div class="tb20p">
          <div class="list_hd btm7m hidden-xs">
            <div class="row cm10-row">
              <div class="col-md-3">
                Projects
              </div>
              <div class="col-md-7">
                Description
              </div>
              <div class="col-md-2">
                <span> Price(NRs.) </span>
              </div>
            </div>
          </div>
          @foreach($datas['projects'] as $project)
          <div class="list_block btm7m">
            <div class="list_body btm7m">
              <div class="row cm10-row">
                <div class="col-md-3">
                  <a class="title_three" href="{{$project['href']}}" title="{{$project['title']}}" >{{$project['title_dis']}}</a>
                  <div class="tb5p">
                    <p><i class="fa fa-hourglass"></i> <span class="blueclr">Open</span> {{$project['publish_date']}} - {{$project['total']}} bids</p>
                  </div>
                </div>
                <div class="col-md-7">
                  <p>{{$project['description']}}</p>
                </div>
                <div class="col-md-2">
                  NRs. {{$project['avg']}}
                </div>
              </div>
            </div>
            <p>
              <span class="blueclr"><i class="fa fa-tags"></i></span>
              @foreach($project['skills'] as $skill)
                  <span><a href="{{url('/projects/tags/'.$skill)}}" class="skill_list" >{{$skill}}</a></span>
                  @endforeach
            </p>
          </div>
          @endforeach
          
        </div>
        
      </div>
    </div>
    <div class="center">
      <a href="{{url('/projects')}}" class="btn browsebtn" >Browse all Projects</a>
    </div>
  </div>
</section>