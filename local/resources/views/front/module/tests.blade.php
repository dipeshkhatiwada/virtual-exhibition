<section id="test" class="test tb60p">
  <div class="container rn_container">
    <div class="center">
      <p class="titlelogo"><img src="{{asset($datas['logo'])}}"></p>
      <p>{{$datas['description']}}</p>
      <div class="title_bg"></div>
    </div>
    <div class="row tb35p">
      <a class="col-md-6" href="{{url('/employee/finger_test')}}" >
        <div class="test_div">
          <div class="row cm-row">
            <div class="col-md-5">
              <h3 class="h3 typing">Typing Test</h3>
              <div class="test_icon"><i class="fas fa-keyboard"></i></div>
            </div>
            <div class="col-md-7">
              <div class="test_content">
                <p>Check out the finger speed</p>
              </div>
            </div>
          </div>
        </div>
      </a>
      <a class="col-md-6" href="{{url('/skill-test')}}" >
        <div class="test_div">
          <div class="row cm-row">
            <div class="col-md-5">
              <h3 class="h3 typing">Skill Test</h3>
              <div class="test_icon"><i class="fas fa-question-circle"></i></div>
            </div>
            <div class="col-md-7">
              <div class="test_content">
                <p>Give Your smart answer</p>
              </div>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</section>
