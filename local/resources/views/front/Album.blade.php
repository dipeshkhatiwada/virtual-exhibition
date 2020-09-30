<div class="careerfy-blog careerfy-blog-grid">
     @foreach($albums->chunk(4) as $chunk)
                                <ul class="row">
                                @foreach($chunk as $album)
                                    <li class="col-md-3 col-sm-6 col-xs-6">
                                        <?php $photo = \App\Album::getImage($album->id); ?>
                                        @if( $photo != '')
                                        <figure><a href="{{url('/photo/'.$album->se_url)}}"><img src="{{asset($photo)}}" alt="<?php echo $album->title;?>"></a></figure>
                                        @endif
                                        <div class="careerfy-blog-grid-text">
                                            
                                            <h2><a href="{{url('/photo/'.$album->se_url)}}"><?php echo $album->title;?></a></h2>
                                                                                     
                                            <a href="{{url('/photo/'.$album->se_url)}}" class="careerfy-read-more careerfy-bgcolor">View Images</a>
                                        </div>
                                    </li>
                                  @endforeach  
                                    
                                </ul>
                                @endforeach
                            </div>

<div class="row">
    <div class="col-xs-12">
      <div class="dataTables_paginate paging_simple_numbers right">
          <?php echo $albums->render();?>
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
