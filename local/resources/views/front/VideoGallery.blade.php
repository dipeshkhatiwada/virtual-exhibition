<div class="careerfy-blog careerfy-blog-grid">
                                 @foreach($videos->chunk(4) as $chunk)
                                <ul class="row">
                                @foreach($chunk as $video)
                                    <li class="col-md-3 col-sm-6 col-xs-6">
                                       
                                      
                                        <figure><a href="{{url('/video/'.$video->se_url)}}"><img src="{{$video->image}}" alt="<?php echo $video->title;?>"></a></figure>
                                       
                                        <div class="careerfy-blog-grid-text">
                                            
                                            <h2><a href="{{url('/video/'.$video->se_url)}}"><?php echo $video->title;?></a></h2>
                                                                                     
                                            <a href="{{url('/video/'.$video->se_url)}}" class="careerfy-read-more careerfy-bgcolor">Watch Video</a>
                                        </div>
                                    </li>
                                  @endforeach  
                                    
                                </ul>
                                @endforeach
                            </div>

<div class="row">
    <div class="col-xs-12">
      <div class="dataTables_paginate paging_simple_numbers right">
          <?php echo $videos->render();?>
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