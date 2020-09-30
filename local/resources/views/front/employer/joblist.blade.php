<h1 class="title_one brandcolor btm15p">Available Job List</h1>
        @foreach($datas as $job)
        <div class="white_block btm5m">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-7">
                            <h3 class="job_post">{{$job['title']}}</h3>
                            <div class="vacancy_code brandcolor">{{$job['vacancy_code']}}
                
                <span class="bold job_time">Source:</span> {{$job['vacancy_source']}}
                <span class="bold job_time brandcolor"><i class="fa fa-eye"></i></span> {{$job['views']}}
              </div>
                            <div class="opening_date">
                                <i class="fas fa-calendar-alt"></i> <span class="bold">Opening Date:</span> {{$job['published_date']}} <span class="bold">To</span>  <span class="brandcolor">{{$job['deadline']}}</span>
                                <span class="job_time">
                                    <span class="part_time"><i class="far fa-clock"></i></span> {{$job['job_availability']}}
                </span>
                <span class="bold job_time">Job Type:</span> {{$job['job_type']}}
                                
              </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-5">
                            <a href="{{$job['job_url']}}" class="btn applybtn float-right brandbgcolor">View Detail</a>
                        </div>
                    </div>
        </div>
        @endforeach

        