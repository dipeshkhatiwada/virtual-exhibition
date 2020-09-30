@if(count($datas['blogs']) > 0)

<div class="row blogs mt-4 ">
                    <div class="col-6 col-md-6">
                        <h4 class="title_one">{{$datas['title']}}</h4>
                    </div>
                    <div class="col-6 col-md-6">
                        <a href="{{$datas['href']}}" class="btn lightgreen_gradient lr15p right">View All</a>
                    </div>
                </div>
        @foreach(array_chunk($datas['blogs'], 3) as $blogs)
        <div class="row cm10-row sports-content mt-3 btm7m">
                   @foreach($blogs as $blog) 
                    
                    <div class='col-md-4'>
                        <div class="img-box">
                            <img class="card-img-top" src="{{asset($blog['image'])}}" alt="Card image cap">
                            <div class="overlay"></div>
                        </div>
                        <div class="newsblock">
                            <h5><a href="{{$blog['href']}}" class="card-title">{{$blog['title']}}</a></h5>
                            <span class="sub-title"><i class="fa fa-eye"></i> {{$blog['view']}} <i class="far fa-clock"></i> {{$blog['date']}} </span>
                            <p class="card-text"><?php echo  $blog['description']; ?></p>
                            <p class="text-right"><a href="{{$blog['href']}}" class="btn btn-readmore">Readmore <i class="fas fa-angle-double-right "></i></a></p>
                        </div>
                    </div>
                    @endforeach
                </div>

    @endforeach


@endif