<div class="clear"></div>
<div class="row">
<div class="col-sm-12 module_cont pb0"> 
     <div class="bg-ea">
<div class="bg_title"> <h2><?php echo $data['title'];?></h2> </div>
</div>
</div>
</div>

<div class="row"> 
	<div class="col-sm-12 module_cont pb10 module_feature_posts"> 
    	<div class="featured_items"> 
        	<div class="items4 featured_posts" id="recent_trip"> 
            	<ul class="item_list"> 
                <?php foreach ($articles as $value) {
                	 ?>
                     <?php if(!empty($value['thumb'])){?>
                	<li class="animate" data-anim-type="fadeInUp" data-anim-delay="300"> 
                    	<div class="item"> 
                        	<div class="item_wrapper"> 
                            
                            	<div class="img_block wrapped_img"> 
                                	<img src="{{$value['thumb']}}" alt="<?php echo $value['title'];?>"/>  
                                    <span class="block_fade"></span> 
                                    <div class="post_hover_info"> 
                                    <a class="featured_ico_link view_link" href="{{url($value['href'])}}">
                                    <i class="icon-link"></i></a> 
                                    </div>
                                 </div>
                           
                                 <div class="featured_items_body"> 
                                 	<div class="featured_items_title"> 
                                    	<h5><a href="{{url($value['href'])}}"><?php echo $value['title'];?></a></h5> 
                                    </div>
                                    <div class="featured_item_content">
                                   <?php                echo $value['description'];?>...
                                     </div>
                                     <div class="featured_meta"> 
                                     	<div class="text-center"><a class="shortcode_button btn_normal btn_type5" style="margin:0px; color:#FFF;" href="<?php echo url($value['href']);?>">Detail</a></div>
                                     </div>
                                 </div>
                            </div>
                        </div>
                    </li>
                 <?php }?>
                   <?php }?>
                 </ul> 
            </div>
         </div>
    </div>
</div>
<div class="clear"></div>
