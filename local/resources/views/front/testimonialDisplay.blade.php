<div class="row"> 
    <div class="col-sm-12 module_cont pb60 module_blog">
        <div class="blog_post_preview animate" data-anim-type="fadeInRight" data-anim-delay="300">
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
                        <?php } echo ' '. $datas['address'];?>
                        <span>
                            <div class="share-icons">
                               <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_native_toolbox"></div>
                               <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54bc94e45906540f"></script>
                            </div>
                        </span>
                </div>
            </div>
            <?php if($datas['image'] != ''){ ?>  
            <div class="blog_post_image "> 
                <img src="<?php echo $datas['image'];?>">
            </div>
            <?php }?>
            <div class="blog_content"> 
                <p><?php echo $datas['description'];?></p>
            </div>
            <div class="row">
                <div class="col-sm-12 animate" data-anim-type="fadeInRight" data-anim-delay="300">
                    <div class="fb-comments" data-width="100%" data-href="<?php echo $hrf;?>" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <?php if($modules){?>
        <?php foreach ($modules as $value) {echo $value['module'];} ?>
        <?php }?>        
    </div>
</div>
   