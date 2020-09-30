@foreach($datas->chunk(3) as $trainings )
            <div class="row cm10-row">
              @foreach($trainings as $training)
              <div class="col-lg-4 col-md-6">
                <div class="white_block training">
                  <div class="training_icon float-right brandcolor"><i class="fa fa-chalkboard-teacher"></i></div>
                  <h3 class="h3 brandcolor">{{$training->title}}</h3>
                  <div class="border brandbgcolor"></div>
                  <p>{{\App\Library\Settings::getLimitedWords($training->description,0,20)}}</p>
                  <div class="training_info">
                    <p><i class="fa fa-map-marker-alt"></i> {{$training->address}}</p>
                    <p><i class="far fa-calendar-alt"></i> {{$training->start_date.' to '.$training->end_date}}</p>
                    <p><i class="fa fa-money-bill-wave"></i> NPR {{$training->price}}</p>
                    <p><i class="fa fa-clock"></i> {{$training->start_time}} - {{$training->end_time}}</p>
                  </div>
                  <div class="tp10p">
                    <a href="{{url('/trainings/'.$training->seo_url)}}" class="morejob brandcolor">More <i class="fa fa-angle-double-right"></i></a>
                  </div>
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
