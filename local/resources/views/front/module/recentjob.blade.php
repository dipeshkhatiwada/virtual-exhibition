

<section class="mt-3">


                                <div class="card">
                                    <div class="card-header py-2" itemtype="http://schema.org/Service">
                                        <strong>

                                            <h1 class="h6 mb-1" itemprop="name"><span class="icon-feature-job mr-1 font-md text-danger"></span> <strong>{{$datas['title']}}</strong></h1>

                                        </strong>
                                    </div>

                                    <div class="card-block p-0">

                <div class="careerfy-job-listing careerfy-featured-listing mt-1">
                                 @foreach($datas['employers'] as $employer)
  <?php if(count($employer['jobs']) > 3) {
                                              $class = 'hover-j-box-inner';
                                            } else {
                                              $class = '';
                                            } ?>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 custom-box-padding">
                            <div class="j-box ">
                                <div class="j-box-inner {{$class}}">
                                    <img class="j-box-img" alt="{{$employer['employer_name']}}" src="{{asset($employer['logo'])}}">
                                    <div class="text-ellipsis " style="max-width: 70%">
                                        <h2 class="job-list-title  text-ellipsis">
                                            

                                            <a href="{{$employer['employer_url']}}" class="green-orange-link font-500 ng-binding"  title="{{$employer['employer_name']}}">
                                                {{$employer['employer_name']}}
                                            </a>


                                        </h2>
                                        @foreach($employer['jobs'] as $job)
                                        <h3 class="job-list-detail text-ellipsis ng-scope">
                                            ⚬  <a href="{{url('/'.$employer['employer_url'].'/'.$job->seo_url)}}"  title="{{$job->title}}" class="title-1 so-link-underline ng-binding">{{$job->title}}
                                            </a>
                                            <br>

                                            
                                        </h3> @endforeach
                                    </div>
                                    <!-- ngIf: com.result.length > 3 -->
                                </div>
                            </div>
                        </div>
@endforeach
                            </div>


                                    </div>



                                    <div class="card-footer p-2 m-0">
                                        <div class="float-right">
                                            <a href="services/hot-job/index.html" class="font-sm">
                                                <span class="icon-preview mr-2"></span> View All
                                            </a>
                                        </div>
                                    </div>






                                </div>
                            </section>











