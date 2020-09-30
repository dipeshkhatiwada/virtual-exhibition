 <div class="">
    @if (Session::has('alert-danger') || Session::has('alert-success'))
          <div class="row">
            <div class="col-xs-12">
              @if (Session::has('alert-danger'))
              <div class="alert alert-danger">{{ Session::get('alert-danger') }}</div>
              @endif
              @if (Session::has('alert-success'))
              <div class="alert alert-success">{{ Session::get('alert-success') }}</div>
              @endif

            </div>

          </div>
          @endif
       @if(count($errors))
                <div class="row">
            <div class="col-xs-12">
            <div class="alert alert-danger">
             @foreach($errors->all() as $error)
              {{ '* : '.$error }}</br>
             @endforeach
                </div>
            </div>

          </div>
       @endif
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">

                 <div class="customclass">


                                 <?php if(isset($datas['article_id'])){
    if($datas['article_id'] != ''){

    ?>
    
               
                
                <?php if($datas['image'] != ''){ ?>  
                <div class="row">
                 <div class="col-md-12 article_image"> 
                 <img src="<?php echo $datas['image'];?>" style="width: 100%;">
                 </div>
                 </div>
                 <?php }?>
       <div class="row">
             <div class="col-md-12 "> 
                                            <p><?php 
                            echo $datas['description'];
                            ?>
                                                
                                            </p>
                                            
                           </div>                 
                                           
                                    
        
            </div>
             <?php if(!empty($datas['video'])){
                                $links=str_replace('watch?v=', 'embed/', $datas['video']);
                                ?>
            <div class="row">
                <div class="col-sm-12 animate" data-anim-type="fadeInRight" data-anim-delay="300">
                <div class="col-sm-12" style="position: relative;padding-bottom: 56.25%; padding-top: 25px;height: 0;">
 <iframe src="<?php echo $links;?>" frameborder="0" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;"></iframe>
</div>
                </div>
            </div>
            
              <?php }?>

              <?php if(!empty($datas['file'])){
                                                                ?>
            <div class="row">
                <div class="col-sm-12 animate file" data-anim-type="fadeInRight" data-anim-delay="300"> :
                <a href="{{url('image/'.$datas['file'])}}" target="_blank"> <i class="fa fa-file-pdf-o"></i> Click Here to Download File</a>
                </div>
            </div>
            
              <?php }?>


                      
                                     
                                    

<?php }else { ?>
Comming Soon
<?php }} else { ?>
Comming Soon
<?php }?>
                
                              <?php if($modules){?>

     <?php foreach ($modules as $value) {
        echo $value['module'];
     } ?>

                
                <?php }?>        
                                </div>
                            </div>


  </div>
</div>

