<div class="row"> 
    <div class="col-sm-12 module_cont pb0">
        <div><h2 class="blogpost_title"><?php echo addslashes($title);?></h2> </div>
        <div class="col-sm-12 module_cont pb60 module_feature_posts"> 
            <div class="featured_items"> 
                <div class="items3 featured_posts"> 
                    <ul class="item_list"> 
                        <?php foreach($testimonials as $artic){ ?>
                        <li class="animate" data-anim-type="fadeInUp" data-anim-delay="300">
                            <div class="item">
                                <div class="item_wrapper">
                                    <?php if(isset($artic['image'])){?>
                                    <div class="img_block wrapped_img">
                                        <img src="<?php echo $artic['image'];?>" alt="<?php echo $artic['name'];?>"/>
                                        <span class="block_fade"></span>
                                        <div class="post_hover_info"> 
                                            <a class="featured_ico_link view_link" href="<?php echo url($artic['href']);?>">
                                                <i class="icon-link"></i></a> 
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="featured_items_body">
                                        <div class="featured_items_title">
                                            <h5><a href="<?php echo url($artic['href']);?>"><?php echo $artic['name'];?></a></h5>
                                        </div>
                                        <div class="featured_item_content">
                                            <?php echo $artic['description'];?>.... 
                                        </div>
                                        <div class="featured_meta">
                                            <?php if(!empty($artic['dates'])){
                                                $date = new DateTime($artic['dates']);
                                                $day =$date->format('d'); 
                                                $month=$date->format('M');
                                                $year=$date->format('Y');
                                            ?> 
                                            <div class="date"> 
                                                <i class="icon-calendar"></i><?php echo $month.' '.$day.', '.$year;?> 
                                            </div>
                                            <?php }?>
                                            <div class="comments">
                                                <a class="shortcode_button btn_small btn_type16" style="color:#FFF;" href="<?php echo url($artic['href']);?>">Countinue.. </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
 <div class="row">
    <div class="col-xs-12">
      <div class="dataTables_paginate paging_simple_numbers right">
          <?php echo $testimonials->render();?>
      </div>
    </div>
  </div>
  
  <div class="col-sm-12 module_cont pb20 animate" data-anim-type="fadeInUp" data-anim-delay="300">   
                 <div class="bg_title"> <h2>Your Feedback Details...</h2> </div>             
               <div class="module_content contact_form"> 
                                          @if (Session::has('alert-danger'))
                                            <div class="alert alert-danger">{{ Session::get('alert-danger') }}</div>
                                              @endif
                                              @if (Session::has('alert-success'))
                                            <div class="alert alert-success">{{ Session::get('alert-success') }}</div>
                                              @endif
                                         <div id="fields"> 
                                         <form action="{{url('testimonail/save')}}" method="post" enctype="multipart/form-data"> 
                                            {!! csrf_field() !!} 
                                         <div class="row row20"> 
                                         <div class="col-sm-12 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                         <label>Your Name</label>
                                         <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Name *"/>
                                         @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                         </div>
                                         <div class="col-sm-12 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                         <label>Your Email</label>
                                         <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Email *"/>
                                         @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                         </div>
                                         <div class="col-sm-12 form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                         <label>Your Address</label>
                                         <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Postal Address"/>
                                         @if ($errors->has('address'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                         </div>
                                         </div>
                                         <div class="form-group {{ $errors->has('message') ? ' has-error' : '' }}">
                                         <label>Your Feedback</label>
                                         <textarea name="message" id="message" placeholder="Write Your Feedback Here...">{{ old('message') }}</textarea> 
                                         @if ($errors->has('message'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('message') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                          <div class="row row20"> 
                                          <div class="col-sm-12 form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                        <label>Your Image</label>
                                         <input type="file" accept="image/*" name="image" id="image" class="form-control" />
                                        @if ($errors->has('image'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                        @endif
                                        
                                        </div>
                                         
                                        
                                        </div>
                                         <input type="submit"  value="Submit"> </form> </div></div>
            </div>

                
                              <?php if($modules){?>

     <?php foreach ($modules as $value) {
        echo $value['module'];
     } ?>

                
                <?php }?>        
                                </div>
                            </div>
