<div class="careerfy-blog careerfy-blog-grid">
                                <ul class="row">
                                @foreach($photos as $photo)
                                    <li class="col-md-3 col-sm-6 col-xs-6">
                                       
                                        <figure>
                                            <a href="{{asset('/image/'.$photo->image)}}" title="<?php echo $photo->description;?>" class="fancybox" data-fancybox-group="group4">
                                    <img src="{{asset(\App\Imagetool::mycrop($photo->image,$datas['width'],$datas['height']))}}" class="attachment-document-image wp-post-image" alt="<?php echo $photo->description;?>">
                                </a>
                                        </figure>
                                       
                                        
                                    </li>
                                  @endforeach  
                                    
                                </ul>
                            </div>

<div class="row">
    <div class="col-xs-12">
      <div class="dataTables_paginate paging_simple_numbers right">
          <?php echo $photos->render();?>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
                              <?php if($modules){?>

     <?php foreach ($modules as $value) {
        echo $value['module'];
     } ?>

                
                <?php }?>        
</div>
  </div>












 <script type="text/javascript" src="{{ asset('/css/facybox/jquery.fancybox.js?v=2.1.5') }}" ></script>
<script type="text/javascript" src="{{ asset('/css/facybox/jquery.fancybox-media.js?v=1.0.6') }}" ></script>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/facybox/fancybox.css?v=2.1.5') }}" media="screen" />
<script type="text/javascript" src="{{ asset('/css/facybox/myfunction.js?v=2.1.5') }}" ></script>