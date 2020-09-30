

 @foreach($datas->chunk(3) as $events )
                <div class="row cm10-row">
                  @foreach($events as $event)
                  <?php
                   if (is_file(DIR_IMAGE.$event->image)) {
             $image = $event->image;
           } else{
            $image = 'no-image.png';
           }
           ?>
                    <div class="col-lg-4 col-md-4 col-12">
                      <div class="event_container center btm7m whitebg">
                        <img src="{{asset(\App\Imagetool::mycrop($image,300,200))}}">
                        <a href="{{url('/events/'.$event->seo_url)}}" >
                          <div class="event_overlay">
                            <h1 class="title_one text-ellipsis">{{$event->title}}</h1>
                            <div class="btm15p">
                              <span class="brandcolor"><i class="fa fa-map-marker-alt"></i></span>
                              <p>{{$event->address}}</p>
                            </div>
                            <div class="venue">
                              <span class="venue_icon float-left">
                                <i class="fa fa-landmark"></i> 
                              </span>
                              <span class=""><a href="{{url('/events/category/'.\App\EventCategory::getUrl($event->event_category_id))}}" >{{\App\EventCategory::getTitle($event->event_category_id)}}</a></span>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                  @endforeach
                </div>
                @endforeach


 <div class="tb20p">
              <nav aria-label="Page navigation example">
                <?php echo $datas->render();?>
              </nav>
            </div>
