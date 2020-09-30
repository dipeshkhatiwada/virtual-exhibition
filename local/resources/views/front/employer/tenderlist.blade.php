

@foreach($datas as $tender)
<?php 
if (is_file(DIR_IMAGE.$tender->image)) {
                $thumb = \App\Imagetool::mycrop($tender->image,400,400);
                $image = asset('/image/'.$tender->image);
              } else{
                $thumb = \App\Imagetool::mycrop('no-image.png', 300,300);
                $image = asset('/image/no-image.png');
              }


              $diff = \Carbon\Carbon::parse($tender->submission_end_date)->diff(\Carbon\Carbon::now())->format('%D:%H:%I');
             $diffs = explode(':', $diff);
             if ($diffs[0] != 0) {
                 $difference = $diffs[0].' Days left';
             } elseif ($diffs[1] != 0) {
                 $difference = $diffs[1].' Hours left';
             }elseif ($diffs[2] != 0) {
                 $difference = $diffs[2].' Minutes left';
             } else {
                  $difference = '';
             }

                  $submission = \Carbon\Carbon::parse($tender->submission_end_date);
?>


<div class="list_block btm7m">
					<div class="tender_list_body">
					  <div class="row">
						<div class="col-md-7">
						  <p class="brandcolor bold">Tender Code : {{$tender->tender_code}}</p>
						  <p>
							<a href="{{url('/tenders/business/'.\App\Employers::getUrl($tender->employers_id))}}"  class="bold"> {{\App\Employers::getName($tender->employers_id)}} </a>
							
						  </p>
						  <p>{{$tender->title}}</p>
						  
						</div>
						<div class="col-md-2">
						  <span class="">NRs. {{$tender->estimate_cost}}</span>
						</div>
						<div class="col-md-2">
						  <p>{{$difference}}</p>
						  <p><span class="brandcolor">{{$tender->submission_end_date}}</span></p>
						</div>
						<div class="col-md-1">
						  <div class="tender_thumb">
							<img onclick="viewImage('{{$tender["id"]}}')" src="{{asset($thumb)}}" style="cursor: pointer;">
						  </div>
						</div>
					  </div>
					</div>
					<div class="tp10p">
					  <div class="row">  <!-- Tender Sector eg: Civil Works !-->
					  <div class="col-md-10">
						 @if($tender->project_location != '')
					      <span><i class="fa fa-map-marker-alt blueclr"></i> {{$tender->project_location}} </span>
					      @endif
					      <div class="hidden-xs"><span class="blueclr italic lft10p">{{\App\TenderType::getTitle($tender->tender_type_id)}}</span></div>
					  </div>
					  <div class="col-md-2">
						 <a href="{{url('/tenders/'.$tender->seo_url)}}" class="btn applybtn float-right brandbgcolor" >View <i class="fa fa-eye"></i></a>
					  </div>
					</div>
				  </div>
				</div>
<div class="modal fade servicemodal" id="tender-image{{$tender['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog" data-dismiss="modal" style="margin:auto;">
  <div class="modal-content">
    <div class="modal-body">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
      <img src="{{$image}}" style="width: 100%;">
    </div>
    
    
    
  </div>
</div>


</div>

@endforeach
 <div class="tb20p">
              <nav aria-label="Page navigation example">
                <?php echo $datas->render();?>
              </nav>
            </div>
<script type="text/javascript">
  function viewImage(id) {
    $('#tender-image'+id).modal('show');
  }
</script>