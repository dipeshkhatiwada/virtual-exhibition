<section class="mt-3">


                            <div class="card">
                                <div class="card-header py-2" itemtype="http://schema.org/Service">
                                    <strong>

                                        <h1 class="h6 mb-1" itemprop="name"><span class="icon-top-job mr-1 font-md text-success"></span>
                                            <strong>{{$datas['title']}}</strong></h1>

                                        </strong>
                                    </div>

                                    <div class="card-block p-0">

                                       @foreach(array_chunk($datas['employers'], 3) as $row)
                                        <div class="row no-gutters hj-row">

                                          @foreach($row as $employer)
                                            <?php if(count($employer['jobs']) > 3) {
                                              $class = 'has-multiple';
                                            } else {
                                              $class = '';
                                            } ?>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 border-right-1  border-bottom-1 job-card">
                                                <div class="{{$class}} p-2">
                                                    <div class="row no-gutters" itemscope itemtype="http://schema.org/JobPosting">
                                                        <div class="media">

                                                            <div class="border-1 mr-2" itemprop="hiringOrganization" itemscope itemtype="http://schema.org/Organization">
                                                                <meta itemprop="name" content=""/>


                                                                <img class="d-flex shadow lazy" data-original="{{asset($employer['logo'])}}" alt="{{$employer['employer_name']}}" itemprop="image"/>


                                                            </div>

                                                            <div class="media-body">

                                                                <h2 title="{{$employer['employer_name']}}" itemprop="title" class="text-ellipsis font-md-xxs" style="width: 90%">
                                                                    {{$employer['employer_name']}}
                                                                </h2>
                                                                 @foreach($employer['jobs'] as $job)
                                                                <h3 class="text-ellipsis font-sm mb-1" style="width: 90%">
                                                                    <p class="font-sm mb-0 ">
                                                                        &bull;
                                                                        <a class="text-ellipsis job_title hover-primary" style="" href="{{url('/'.$employer['employer_url'].'/'.$job->seo_url)}}" title="{{$job->title}}">
                                                                            <span itemprop="title">

                                                                                {{$job->title}}

                                                                            </span>

                                                                        </a>
                                                                    </p>
                                                                </h3>
                                                                @endforeach
                                                            </div>
                                                            @if($class != '')

                                                            <div class="absolute-dropdown">
                                                                <span class="float-right"><span class="icon-arrow-down"></span></span>
                                                            </div>

                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                        @endforeach
                                        
                                        


                                    </div>


                                    







                                </div>
                            </section>


