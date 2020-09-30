
<!-- job blocks section started here -->
<section id="job" class="jobs tb100p">
  <div class="container">
    <div class="center btm30p">
      <p class="titlelogo"><img src="{{asset('images/job.png')}}"></p>
      <p>Find the right job</p>
      <!-- <h2 class="h2 tp20m">Rolling Jobs</h2> -->
      <div class="title_bg"></div>
    </div>
    <form class="search_form col-md-8" method="POST" action="{{url('/search')}}">
      <div class="row cm10-row">
        <div class="col-md-5">
            <input type="text" class="form-control" placeholder="key words">
        </div>
        <div class="col-md-3">
          <select id="inputState" class="form-control">
            @foreach($datas['locations'] as $location)
            <option value="{{$location->id}}">{{$location->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-3">
          <select id="inputState" class="form-control">
            <option>Category one</option>
            <option>Category two</option>
          </select>
        </div>
        <button type="submit" class="btn searchicon"><i class="fa fa-search"></i></button>
      </div>
    </form>
    <div class="row tb35p">
      <div class="col-md-2">
        <div class="white_block">
          <h3 class="h3">Categories</h3>
          <div class="lft_block">
          <ul>
            <li>Accounting <span>(1230)</span></li>
            <li>IT Jobs <span>(230)</span></li>
            <li>Administration <span>(530)</span></li>
            <li>Sales/Marketing <span>(730)</span></li>
            <li>I/NGOs <span>(810)</span></li>
            <li>Financial <span>(500)</span></li>
            <li>General <span>(500)</span></li>
          </ul>
        </div>
          <div class="tp10p">
            <a href="#" class="morejob">All Categories <i class="fa fa-plus"></i></a>
          </div>
        </div>
      </div>

      <div class="col-md-10">
        <div class="row cm10-row">
          <div class="col-md-4">
            <h3 class="h3">Gold Jobs <span class="gold"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></span></h3>
            <div class="comn_block">
              <div class="row">
                <div class="col-md-2">
                  <div class="complogo">
                    <img src="images/joblogo/sbi.jpg">
                  </div>
                </div>
                <div class="col-md-10">
                  <p class="company_name">Nepal SBI Bank Limited (NSBL)</p>
                  <ul class="joblist">
                    <li><a href="#">Senior Officer-Corporate Communication</a></li>
                    <li><a href="#">Junior Officers</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="comn_block">
              <div class="row">
                <div class="col-md-2">
                  <div class="complogo">
                    <img src="images/joblogo/nwh.jpg">
                  </div>
                </div>
                <div class="col-md-10">
                  <p class="company_name">Nepal SBI Bank Limited (NSBL)</p>
                  <ul class="joblist">
                    <li><a href="#">Senior Officer-Corporate Communication</a></li>
                    <li><a href="#">Junior Officers</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <a href="#" class="morejob">Gold Jobs <i class="fa fa-plus"></i></a>
          </div>
          <!-- gold job block ended here -->
          <div class="col-md-4">
            <h3 class="h3">Silver Jobs <span class="silver"><i class="fa fa-star"></i> <i class="fa fa-star"></i></span></h3>
            <div class="comn_block">
              <div class="row">
                <div class="col-md-2">
                  <div class="complogo">
                    <img src="images/joblogo/sbi.jpg">
                  </div>
                </div>
                <div class="col-md-10">
                  <p class="company_name">Nepal SBI Bank Limited (NSBL)</p>
                  <ul class="joblist">
                    <li><a href="#">Senior Officer-Corporate Communication</a></li>
                    <li><a href="#">Junior Officers</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="comn_block">
              <div class="row">
                <div class="col-md-2">
                  <div class="complogo">
                    <img src="images/joblogo/nwh.jpg">
                  </div>
                </div>
                <div class="col-md-10">
                  <p class="company_name">Nepal SBI Bank Limited (NSBL)</p>
                  <ul class="joblist">
                    <li><a href="#">Senior Officer-Corporate Communication</a></li>
                    <li><a href="#">Junior Officers</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <a href="#" class="morejob">Silver Jobs <i class="fa fa-plus"></i></a>
          </div>
          <div class="col-md-4">
            <h3 class="h3">Bronze Jobs <span class="bronze"><i class="fa fa-star"></i> </span></h3>
            <div class="comn_block">
              <div class="row">
                <div class="col-md-2 col-sm-12">
                  <div class="complogo">
                    <img src="images/joblogo/sbi.jpg">
                  </div>
                </div>
                <div class="col-md-10 col-sm-12">
                  <p class="company_name">Nepal SBI Bank Limited (NSBL)</p>
                  <ul class="joblist">
                    <li><a href="#">Senior Officer-Corporate Communication</a></li>
                    <li><a href="#">Junior Officers</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="comn_block">
              <div class="row">
                <div class="col-md-2">
                  <div class="complogo">
                    <img src="images/joblogo/nwh.jpg">
                  </div>
                </div>
                <div class="col-md-10">
                  <p class="company_name">Nepal SBI Bank Limited (NSBL)</p>
                  <ul class="joblist">
                    <li><a href="#">Senior Officer-Corporate Communication</a></li>
                    <li><a href="#">Junior Officers</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <a href="#" class="morejob">Bronze Jobs <i class="fa fa-plus"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="center">
      <a href="#" class="btn browsebtn">Browse all jobs</a>
    </div>
  </div>
</section>
<!-- job block section ended here -->