<?php echo $datas['header']; ?>
<?php if (isset($datas['banner'])) { ?>
<img src="{{asset($datas['banner'])}}" width="100%;">
<?php } ?>
<?php if ($datas['topfull']) { 
	echo $datas['topfull'];
} ?>

<?php if ($datas['right'] != '' && $datas['left'] != '') { ?>
    <?php $class = 'col-lg-7 col-md-9 col-sm-12 col-xs-12'; ?>
    
    <?php } elseif ($datas['left'] != '' && $datas['right'] == '') {
       $class = 'col-lg-9 col-md-9 col-sm-12 col-xs-12';
    } elseif ($datas['right'] != '' && $datas['left'] == '') {
        $class = 'col-lg-10 col-md-10 col-sm-12 col-xs-12';
    } else { ?>
    <?php $class = 'col-lg-12 col-md-12 col-sm-12 col-xs-12'; ?>
    <?php } ?>
<div class="container">
        <?php if (config('app.meta_type') == 'Employer' || config('app.meta_type') == 'Job' && config('app.id') != '') { ?>
            <div class="row">
                        <div class="col-md-12 banner">
                            <div class="big">
            <?php
            $employer = \App\Employers::select('id', 'logo', 'name', 'banner')->where('id', config('app.id'))->first();
            if (isset($employer->banner)) {
                if (is_file(DIR_IMAGE.$employer->banner)) { ?>
                    
                    <img class="width-100" src="{{asset('/image/'.$employer->banner)}}" itemprop="image" alt="{{$employer->name}}">
                
               
               <?php }
            } ?>
            </div>
            <?php if (isset($employer->logo)) {
                if (is_file(DIR_IMAGE.$employer->logo)) { ?>
                   <img class="card-profile-block full-z-index" src="{{asset(\App\Imagetool::mycrop($employer->logo,160,160))}}" alt="{{$employer->name}}" itemprop="image">
                <?php }
            } ?>

            <div class="banner-gradient">
           
            <div class="col-md-8 d-flex align-items-center mt-4">
                <h2 class="ml-5 pl-5 h5">
                    
                        <a class="ml-5  text-white" href="#">
                            <span itemprop="name">{{$employer->name}}</span>
                        </a>

                    
                </h2>
            </div>
            <div class="col-md-4 d-flex align-items-end justify-content-end mt-4">
                <div class="">
                        @if($datas['employer_data']['followed'] > 0)
                        <button type="button" class="d-inline btn btn-sm btn-outline-secondary"><span class="icon-circle-add mr-2"></span>Followed  </button>
                        @elseif(isset(auth()->guard('employee')->user()->id))
                        <button type="button" id="follow_button" class="d-inline btn btn-sm btn-outline-secondary" onclick="followEmployer('{{$employer->id}}')"><span class="icon-circle-add mr-2"></span>Follow  </button>
                        @else
                        <button type="button" class="d-inline btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#generic-modal-box" data-remote="{{url('/employee/poplogin')}}"><span class="icon-circle-add mr-2"></span>Follow  </button>
                        @endif
                        
                         <button type="button" class="d-inline btn btn-sm btn-outline-secondary" ></span>Total Follow ({{$datas['employer_data']['total_follower']}})  </button>
                    
                </div>

            </div>
        </div>

             </div>
                </div>

        <?php  } ?>
	
	<?php if($datas['top'] != '') {?>
            <div class="row mb-3">
                <div class="col-md-12">
            	<?php echo $datas['top'];?>
                    </div>
            </div>
        <?php } ?>
        <div class="row mb-3">
            <?php if($datas['left'] != '') { ?>
                <div class="col-md-3 pl-md-0">
                    <?php echo $datas['left'];?>
                </div>
            <?php } ?>
        	<div class="{{$class}}">
        		<?php echo $datas['main'];?>
        	</div>
        	<?php if($datas['right'] != '') { ?>
        		<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 pl-md-0 hidden-md">
        			<?php echo $datas['right'];?>
        		</div>
        	<?php } ?>
        </div>
           <?php if ($datas['bottom']) { 
    echo $datas['bottom'];
} ?>
           
        </div>
<?php if ($datas['bottomfull']) { 
	echo $datas['bottomfull'];
} ?>
<?php echo $datas['footer']; ?>