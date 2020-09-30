
 <?php $links=str_replace('watch?v=', 'embed/', $video->utube_url); ?>
            <div class="row">
                        
                       
                <div class="col-sm-12" style="position: relative;padding-bottom: 56.25%; padding-top: 25px;height: 0;">
 <iframe src="<?php echo $links;?>?autoplay=1&mute=1&enablejsapi=1" frameborder="0" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;"></iframe>
</div>
              
            </div>
<div class="row marg75">
                        
                        <!-- Job Detail List -->
                        <div class="careerfy-column-12 marg75">
            <div class="careerfy-description marg75" style=" text-align: justify;">
                                        <?php echo $video->description; ?>
                                       
                                    </div>
            
            </div>
        </div>


<div class="row"> 
        <div class="col-sm-12">
                               
    
         


                
                              <?php if($modules){?>

     <?php foreach ($modules as $value) {
        echo $value['module'];
     } ?>

                
                <?php }?>        
                                </div>
                            </div>
   