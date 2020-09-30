<div class="clear"></div>

            <div class="promo-block">
              <div class="promo-text">{{$datas['title']}}</div>
              <div class="center-line"></div>
            </div>
            <div class="row marg50 ">
              @if(count($datas['mydata']) > 0)
             
              @foreach($datas['mydata'] as $employ)
               @if(count($employ['jobs']) > 3)
              <?php $cl = 'hasmore'; $abcl = 'absolute-dropdown' ?>
              @else
              <?php $cl = ''; $abcl = 'd-dropdown' ?>
              @endif
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-ms-12 mnjob">
                <div class="blog-main {{$cl}} mjob ">
                  <div class="blog-images">
                    <div class="view view-fifth ">
                      @if($employ['thumb'] != '')
                      
                            <img src="{{asset($employ['thumb'])}}" alt="">
                      
                      @endif
                      <div class="mask"><a href="{{url($employ['href'])}}" class="btn-blog">Read More</a></div>
                    </div>
                  </div>
                  <div class="blog-content">
                  <div class="blog-name"><a  href="{{url($employ['href'])}}">{{$employ['title']}}</a></div>
                  @if(count($employ['jobs']) > 0)
                 
                  @foreach($employ['jobs'] as $job)
                  <div class="blog-desc" style="width: 100%;"><a  href="{{$job['href']}}"><i class="fa fa-caret-right"></i> {{$job['title']}}</a> </div>
                  @endforeach
                  @endif
                   
              </div>
                </div>
                 <div class="{{$abcl}}">
                <i class="fa fa-caret-down"></i>
              </div>
              </div>
              @endforeach
              @endif
            </div>
         
<script>
$(document).ready(function(){
    $(".hasmore").hover(function(){
        
        $(this).removeClass("mjob");
        $(this).addClass("mjmany");
        }, function(){
          $(this).removeClass("mjmany");
        $(this).addClass("mjob");
    });
});
</script>

<div class="clear"></div>