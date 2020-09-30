<div class="row"> 
                                <div class="col-sm-12 module_cont pb60 module_blog">
                                 <div><h2 class="blogpost_title"><?php echo addslashes($title);?></h2> </div>
   <?php foreach($articles as $datas){ ?>
    
                <div class="blog_post_preview animate" style="margin-bottom:0px;" data-anim-type="fadeInRight" data-anim-delay="300">
                
                <?php if($datas['image'] != ''){
                    $class = 'col-sm-9 right' ?>  
                 <div class="blog_post_image col-sm-3 left"> 
                 <img src="<?php echo $datas['image'];?>">
                 </div>
                 <?php } else {
                     $class = '';
                     
                 }?>
       <div class="blog_content <?php echo $class;?>"> 
       <div class="blog_content"> 
            <h2 class="blogpost_title"><a href="{{url($datas['href'])}}"><?php echo addslashes($datas['title']);?></a></h2> 
                                            <div class="listing_meta">
                                            <?php if(!empty($datas['published'])){
                                $date = new DateTime($datas['published']);
                                $day =$date->format('d'); 
                                $month=$date->format('M');
                                $year=$date->format('Y');
                                 ?> 
                                                <span><?php echo $month.' '.$day.', '.$year;?></span> 
                                                <?php }?>
                                               
                                                
                                                
                                            </div>
                                            </div>
             
                                            <p><?php 
                            echo $datas['description'];
                            ?>...
                                                
                                            </p>
                                            
                                            
                              <div class="featured_meta"> 
                                      <div class="text-right"><a class="shortcode_button btn_normal btn_type5" style="margin:0px; color:#FFF;" href="<?php echo url($datas['href']);?>">Read More</a></div>
                                        
                                     </div>             
                                    
        
            </div>
             
            
                      <div class="clear"></div>
                                        </div>
                                       
                                    
<?php }?>
 <div class="row">
    <div class="col-xs-12">
      <div class="dataTables_paginate paging_simple_numbers right">
          <?php echo $articles->render();?>
      </div>
    </div>
  </div>

                
                              <?php if($modules){?>

     <?php foreach ($modules as $value) {
        echo $value['module'];
     } ?>

                
                <?php }?>        
                                </div>
                            </div>
