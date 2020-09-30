<section id="training" class="r_training tb60p">
  <div class="container rn_container">
    <div class="center">
      <p class="titlelogo"><img src="{{asset($datas['logo'])}}"></p>
      <p class="whiteclr">{{$datas['description']}}</p>
      <div class="title_bg"></div>
    </div>
   
    <div class="row cm10-row tb35p">
         @foreach(array_chunk($datas['trainings'], 3) as $trainings )
      @foreach($trainings as $training)
      <div class="col-md-4">
        <div class="white_block training">
          <div class="training_icon float-right"><i class="fa fa-chalkboard-teacher"></i></div>
          <h3 href="{{$training['href']}}"  class="h3">{{$training['title']}}</h3>
          <div class="border"></div>
          <p>{{$training['description']}}</p>
          <div class="tp10p">
           <a href="{{$training['href']}}"  class="morejob">More <i class="fa fa-arrow-alt-circle-right"></i></a>
          </div>
        </div>
      </div>
      @endforeach
       @endforeach
    </div>
   
    <div class="center">
      <a href="{{url('/trainings')}}"  class="btn browsebtn fffbtn">Browse all Trainings</a>
    </div>
  </div>
</section>

