@foreach($datas as $blog)
 <?php
                   if (is_file(DIR_IMAGE.$blog->image)) {
             $image = $blog->image;
           } else{
            $image = 'no-image.png';
           }

           $cdate = \Carbon\Carbon::parse($blog->created_at)
           ?>
<div class="boxborder btm5m">
					<div class="row cm10-row">
						<div class="col-md-4">
							<div class="img-box">
								<div class="blogpost_date">
									<p>{{$cdate->day}} <br>{{$cdate->formatLocalized('%b')}}.</p>
									<p class="year brandbgcolor">{{$cdate->year}}</p>
								</div>
								<img src="{{asset(\App\Imagetool::mycrop($image,540,300))}}">
								<div class="overlay"></div>
							</div>
						</div>
						<div class="col-md-8 content">
							<h5><a class="brandcolor" href="{{url('/blog/'.\App\Employers::getUrl($blog->employers_id).'/'.$blog->seo_url)}}">{{$blog->title}}</a></h5>
							<p>{!! \App\Library\Settings::getLimitedWords($blog->description,0,60)!!}</p>
							<a href="{{url('/business/blog/'.\App\Employers::getUrl($blog->employers_id).'/'.$blog->seo_url)}}" class="btn applybtn brandbgcolor">Readmore</a>
						</div>
					</div>
				</div>
@endforeach


 <div class="tb20p">
              <nav aria-label="Page navigation example">
                <?php echo $datas->render();?>
              </nav>
            </div>
