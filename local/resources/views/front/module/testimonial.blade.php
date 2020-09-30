<div class="clear"></div>


<div class="prl-1">
        <div class="prlx">
          <div class="container">
            <div class="row">
             
              <div class="col-lg-12">

                <div class="careerfy-testimonial-slider">
                     <?php $i = 0; ?>
                        
                         <?php foreach ($datas['mydata'] as $data) { ?>
                                        <div class="careerfy-testimonial-slide-layer">
                                                <div class="careerfy-testimonial-wrap">
                                                    <p><?php echo $data['description']; ?></p>
                                                    <div class="careerfy-testimonial-text">
                                                        <h2>{{$data['title']}}</h2>
                                                        <span>{{$data['address']}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            
                                        </div>
              
              </div>
            </div>
          </div>
        </div>
      </div>




