

<section id="project" class="projectbg tb60p">
  <div class="container">
    <div class="center">
      <p class="titlelogo"><img src="{{asset($datas['logo'])}}"></p>
      <p class="whiteclr">{{$datas['description']}}</p>
      <div class="title_bg"></div>
    </div>
    <div class="row cm10-row tb35p">
      <div class="col-md-3">
        <div class="lft_block white_block tp50m">
          <h3 class="h3 btm15m">Categories</h3>
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
      <div class="col-md-9">
        <div class="projectblock">
           @foreach(array_chunk($datas['projects'], 3) as $projects )
          <div class="row cm10-row">
            @foreach($projects as $project)
            <div class="col-md-4">
              <div class="projectlist">
                <a class="project_title btm10m"  href="{{$project['href']}}">{{$project['title']}}</a>
                <p>{{$project['description']}}</p>
                <p><i class="fa fa-hourglass"></i> <span class="blueclr">Open</span> {{$project['publish_date']}} - {{$project['total']}} bids</p>

                <div class="tp10p">
                  <span class="greencolor"><i class="fa fa-tags"></i></span>
                  @foreach($project['skills'] as $skill)
                  <span><a href="{{url('/projects/tags/'.$skill)}}" class="skill_list" >{{$skill}}</a></span>
                  @endforeach
                </div>
              </div>
            </div>
            @endforeach
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