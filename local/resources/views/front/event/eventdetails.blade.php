@extends('front.event-master')
<style>
  @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

  fieldset, label { margin: 0; padding: 0; }
  /* body{ margin: 20px; } */
  /* h1 { font-size: 1.5em; margin: 10px; } */

  /****** Style Star Rating Widget *****/
  .full{
    font-size:15px
  }

  .rating {
    border: none;
    float: left;
  }

  .rating > input { display: none; }
  .rating > label:before {
    margin: 5px;
    font-size: 1.25em;
    font-family: FontAwesome;
    display: inline-block;
    content: "\f005";
  }

  .rating > .half:before {
    content: "\f089";
    position: absolute;
  }

  .rating > label {
    color: #ddd;
  float: right;
  }

  /***** CSS Magic to Highlight Stars on Hover *****/

  .rating > input:checked ~ label, /* show gold star when clicked */
  .rating:not(:checked) > label:hover, /* hover current star */
  .rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

  .rating > input:checked + label:hover, /* hover current star when changing rating */
  .rating > input:checked ~ label:hover,
  .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
  .rating > input:checked ~ label:hover ~ label { color: #FFED85;  }


  #leave-comment {
    font-size: 1.25rem;
    height:62px;
  }
  .pb-cmnt-textarea {
      padding: 20px;
      height: 130px;
      width: 100%;
      border: 2px solid #F2F2F2;
      border-radius: 25px 25px 25px 25px;
    }
  /* #share{
      margin-top: 3px;
      margin-left: 5px;
      margin-top: 15px;
    } */

  .heading {
      font-size: 20px;
      margin-right: 20px;
    }

  .checked {
      color: orange;
    }

  /* Three column layout */
  .side {
      float: left;
      width: 15%;
      margin-top:10px;
      margin-left:10px;
    }

  .middle {
      margin-top:10px;
      float: left;
      width: 60%;
    }

/* Responsive layout - make the columns stack on top of each other instead of next to each other */
  @media (max-width: 400px) {
    .side, .middle {
      width: 100%;
    }
    .right {
      display: none;
    }
  }
  #tickettable{
      border: 2px solid #F2F2F2;
      border-radius: 25px 25px 25px 25px;
  }
</style>
@section('header')
<section class="event_banner">
  <div class="container rn_container">
    @include('front/common/event_header')
    <div class="">
      <h3 class="tp30p center"><span class="whiteclr">Search Training</span> <span class="greencolor"> With Category </span> </h3>
      <div class="search_background">
        <form class="search_form">
          <div class="row cm10-row">
            <div class="col-md-10 col-9">
              <input type="text" class="form-control careerfy-placeholder" placeholder="Enter Keywords i.e. Seminar & Meeting">
            </div>
            <div class="col-md-2 col-3">
              <button class="btn searchbtn">Search</button>
            </div>
          </div>
        </form>
      </div>

      <div class="tb20p center">
        <a class="btn bluecomnbtn">TOP TRAINING</a>
      </div>
    </div>
  </div>
</section>
<!-- header part with navigation ended here -->
@stop
@section('banner')
<!-- banner section with search form ended here -->
@stop
@section('content')
<?php if (count($datas['left_content']) > 0 && count($datas['right_content']) > 0) {
$class = 'col-lg-7 col-md-6 col-sm-12 col-xs-12';
} elseif (count($datas['left_content']) > 0 && count($datas['right_content']) < 1) {
$class = 'col-lg-9 col-md-8 col-sm-12 col-xs-12';
}
elseif (count($datas['left_content']) < 1 && count($datas['right_content']) > 0) {
$class = 'col-lg-10 col-md-8 col-sm-12 col-xs-12';
} else{
$class = 'col-md-12';
} ?>
<section>
  <div class="container">
    <div class="white_div neg_margin">
      @if(count($datas['top_content']) > 0)

      <div class="row cm10-row">
        <div class="col-md-12">
          @foreach($datas['top_content'] as $tcontent)
          <?php echo $tcontent['module']; ?>
          @endforeach
        </div>
      </div>
      @endif
      <div class="row cm10-row">

        @if (count($datas['left_content']) > 0)
        <aside class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
          @foreach($datas['left_content'] as $lcontent)
          <?php echo $lcontent['module']; ?>
          @endforeach
        </aside>
        @endif
        <div class="{{$class}}">
          <div class="trainingblock">
            @if(isset($datas['event']->id))
            @if(!empty($datas['image']))
            <div class="row cm10-row">
              <img src="{{asset($datas['image'])}}" style="width: 30%; margin-left:auto;margin-right:auto;">
            </div>
            @endif
            <div class="row cm10-row">
              <div class="tb20p">
                <h2 class="title_two btm7m">{{$datas['event']->title}}</h2>
                <div class="title_three">Description
                  @if($datas['event']->ticket_type == 1)
                    <span class="badge badge-primary">Free Event</span>
                  @endif
                  @if($datas['event']->ticket_type == 2)
                    <span class="badge badge-primary">NRS. {{$datas['event']->price}}</span>
                  @endif
                  @if($datas['event']->ticket_type == 3)
                    <table class="table table-bordered" id="tickettable">
                      <thead>
                        <tr>
                          <th>Ticket Type</th>
                          <th>Capacity</th>
                          <th>Description</th>
                          <th>Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($datas['event']['eventTicketType'] as $ticket)
                          <tr>
                            <td>{{$ticket->name}}</td>
                            <td>{{$ticket->capacity}}</td>
                            <td>{{$ticket->description}}</td>
                            <td>{{$ticket->price}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  @endif
                </div>
                <div class="blueborder tp5m"></div>
                <div class="paragraph">
                  <?php echo $datas['event']->description;?>
                </div>
                <div class="title_three btm15m">Organizer : <a href="{{url('/events/business/'.\App\Employers::getUrl($datas['event']->employers_id))}}" class="blueclr italic">{{\App\Employers::getName($datas['event']->employers_id)}}</a></div>

                <div class="title_three btm15m">Event Category : <a href="{{url('/events/category/'.\App\EventCategory::getUrl($datas['event']->event_category_id))}}" class="blueclr italic">{{$datas['event_category']}}</a></div>
                <div class="event_info">
                  <p><i class="fa fa-landmark"></i> {{$datas['event']->venue}}</p>
                  <p><i class="fa fa-map-marker-alt"></i> {{$datas['event']->address}}</p>
                  <p><i class="far fa-calendar-alt"></i> {{$datas['event']->event_date}}</p>

                </div>
                @if(count($datas['event']->Sponsors) > 0)
                <h5 class="title_three tp20p">SPONSORED BY:</h5>
                <div class="sponsors">
                  @foreach($datas['event']->sponsors as $sponsors)
                  @if(is_file(DIR_IMAGE.$sponsors->logo))
                  @php($image = \App\Imagetool::mycrop($sponsors->logo,200,200))
                  <div class="col-lg-1 col-md-2 col-sm-4 col-6" >
                    @if($sponsors->url != '')
                    <a href="{{$sponsors->url}}" target="_blank"><img src="{{asset($image)}}" style="width: 100% !important;"></a>
                    @else
                    <img src="{{asset($image)}}" style="width: 100% !important">
                    @endif
                  </div>
                  @endif
                  @endforeach
                </div>
                @endif
                <div class="tp20m">
                  @if($datas['event']->event_type == 1)
                    @if($datas['event']->ticket_type == 1)
                      @if(isset(Auth::guard('employee')->user()->firstname))
                        @if($datas['event']->event_reserved)
                          @if($datas['event']->event_date." ".$datas['event']->start_time <= $datas['event']->current_dt &&
                            $datas['event']->to_date." ".$datas['event']->end_time >= $datas['event']->current_dt)
                            <a href="{{$datas['event']->eventMeeting->join_url}}" target="_blank" class="btn lightgreen_gradient">Participate Now</a>
                          @elseif($datas['event']->event_date." ".$datas['event']->start_time > $datas['event']->current_dt)
                            <div class="alert alert-info">
                              <strong>Success!</strong> Your payment is Successful. The meeting will start at {{$datas['event']->event_date}} {{$datas['event']->start_time}}.
                            </div>
                          @elseif($datas['event']->to_date." ".$datas['event']->end_time < $datas['event']->current_dt)
                            <div class="alert alert-danger">
                              <strong>The event was held on {{$datas['event']->event_date}}.</strong>
                            </div>
                          @endif
                        @else
                          @if($datas['event']->participants_limit == 1)
                            <a class="btn lightgreen_gradient" event-id="{{$datas['event']->id}}" id="book-inhouse-event-ticket"><i class='fas fa-cart-plus'></i> Book</a>
                          @else
                            <!-- check if the seats are available -->
                            @if(count($datas['event']->eventReservation) < $datas['event']->participants_max_limit)
                              <!-- booking/payment process -->
                              <a class="btn lightgreen_gradient" event-id="{{$datas['event']->id}}" id="book-inhouse-event-ticket"><i class='fas fa-cart-plus'></i> Book</a>
                              <!-- booking/payment process -->
                            @else
                              <div class="alert alert-danger">
                                <strong>Sorry!</strong> All the Seats have been taken.
                              </div>
                            @endif
                          @endif
                        @endif
                      @else
                        <a class="btn lightgreen_gradient" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo">Login to Join this event</a>
                      @endif
                    @elseif($datas['event']->ticket_type == 2 || $datas['event']->ticket_type == 3)
                      @if(isset(Auth::guard('employee')->user()->firstname))
                        <!-- check if there participant limit -->
                        @if($datas['event']->event_reserved)
                            @if($datas['event']->invoice_status == 'Complete')
                              @if($datas['event']->event_date." ".$datas['event']->start_time <= $datas['event']->current_dt &&
                                $datas['event']->to_date." ".$datas['event']->end_time >= $datas['event']->current_dt)
                                <a href="{{$datas['event']->eventMeeting->join_url}}" target="_blank" class="btn lightgreen_gradient">Participate Now</a>
                              @elseif($datas['event']->event_date." ".$datas['event']->start_time > $datas['event']->current_dt)
                                <div class="alert alert-info">
                                  <strong>Success!</strong> Your payment is Successful. The meeting will start at {{$datas['event']->event_date}} {{$datas['event']->start_time}}.
                                </div>
                              @elseif($datas['event']->to_date." ".$datas['event']->end_time < $datas['event']->current_dt)
                                <div class="alert alert-danger">
                                  <strong>The event was held on {{$datas['event']->event_date}}.</strong>
                                </div>
                              @endif
                            @else
                              <div class="alert alert-info">
                                <strong>Please Be patient!</strong> Your Payment is processing..
                              </div>
                            @endif
                        @else
                          @if($datas['event']->participants_limit == 1)
                            @if(count($datas['event']['eventTicketType']) > 0)
                              <label for="ticket_type">Choose Ticket Type:</label>
                              <select name="ticket_type" id="ticket_type">
                                @foreach($datas['event']['eventTicketType'] as $ticket)
                                  <option price="{{$ticket->price}}" value="{{$ticket->id}}">{{$ticket->name}}</option>
                                @endforeach
                              </select>
                            @endif
                            <a class="btn lightgreen_gradient" event-id="{{$datas['event']->id}}" id="buy-inhouse-event-ticket"><i class='fas fa-cart-plus'></i>Buy</a>
                          @else
                            <!-- check if the seats are available -->
                            @if(count($datas['event']->eventReservation) < $datas['event']->participants_max_limit)
                              <!-- booking/payment process -->
                              @if(count($datas['event']['eventTicketType']) > 0)
                                <label for="ticket_type">Choose Ticket Type:</label>
                                <select name="ticket_type" id="ticket_type">
                                  @foreach($datas['event']['eventTicketType'] as $ticket)
                                    <option price="{{$ticket->price}}" value="{{$ticket->id}}">{{$ticket->name}}</option>
                                  @endforeach
                                </select>
                              @endif
                              <a class="btn lightgreen_gradient" event-id="{{$datas['event']->id}}" id="buy-inhouse-event-ticket"><i class='fas fa-cart-plus'></i> Buy</a>
                              <!-- booking/payment process -->
                            @else
                              <div class="alert alert-danger">
                                <strong>Sorry!</strong> All the Seats have been taken.
                              </div>
                            @endif
                          @endif
                        @endif
                      @else
                        <a class="btn lightgreen_gradient" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo">Login to Join this event</a>
                      @endif
                    @endif
                  @elseif($datas['event']->event_type == 2)
                    @if($datas['event']->ticket_type == 1)
                    @elseif($datas['event']->ticket_type == 2 || $datas['event']->ticket_type == 3)
                      @if(isset(Auth::guard('employee')->user()->firstname))
                        @if($datas['event']->participants_limit == 1)
                          @if(count($datas['event']['eventTicketType']) > 0)
                            <label for="ticket_type">Choose Ticket Type:</label>
                            <select name="ticket_type" id="ticket_type">
                              @foreach($datas['event']['eventTicketType'] as $ticket)
                                <option price="{{$ticket->price}}" value="{{$ticket->id}}">{{$ticket->name}}</option>
                              @endforeach
                            </select>
                          @endif
                          <label for="quantity">Quantity</label>
                          <input type="number" name="quantity" id="quantity" value="1">
                          <a class="btn lightgreen_gradient" target="_blank" event-id="{{$datas['event']->id}}" id="buy-outsource-event-ticket"><i class='fas fa-cart-plus'></i> Buy</a>
                        @else
                          <!-- check if the seats are available -->
                          @if(count($datas['event']->eventReservation) < $datas['event']->participants_max_limit)
                            <!-- booking/payment process -->
                            @if(count($datas['event']['eventTicketType']) > 0)
                              <label for="ticket_type">Choose Ticket Type:</label>
                              <select name="ticket_type" id="ticket_type">
                                @foreach($datas['event']['eventTicketType'] as $ticket)
                                  <option price="{{$ticket->price}}" value="{{$ticket->id}}">{{$ticket->name}}</option>
                                @endforeach
                              </select>
                            @endif
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" value="1">
                            <a class="btn lightgreen_gradient" event-id="{{$datas['event']->id}}" id="buy-outsource-event-ticket"><i class='fas fa-cart-plus'></i> Buy</a>
                            <!-- booking/payment process -->
                          @else
                            <div class="alert alert-danger">
                              <strong>Sorry!</strong> All the Seats have been taken.
                            </div>
                          @endif
                        @endif
                      @else
                        <a class="btn lightgreen_gradient" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo">Login to Join this event</a>
                      @endif
                    @endif
                  @endif

                  <!-- @if(isset(Auth::guard('employee')->user()->firstname))
                  <a href="" onclick="alert('Contact the Organizer')" class="btn lightgreen_gradient">Participate Now</a>
                  @else
                  <a class="btn lightgreen_gradient" data-toggle="modal" data-target="#individualModal" data-whatever="@mdo">Login to Join this event</a>
                  @endif -->

                </div>

                <!--  Bidder list started here -->
              </div>
            </div>
            <div class="tabsection">
              <nav>
                <div class="nav nav-tabs event_tab" id="nav-tab"  role="tablist" >

                  <a class="nav-item nav-link active tab_font" id="nav-comment-tab" data-toggle="tab" href="#nav-comment" role="tab" aria-controls="nav-comment" aria-selected="true">COMMENTS</a>

                  <a class="nav-item nav-link tab_font" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">REVIEWS</a>

                </div>
              </nav>
              <div class="tab-content stroke" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-comment" role="tabpanel" aria-labelledby="nav-comment-tab">
                  <div id="pb-cmnt-container" class="event_gallery">
                    <div class="row cm10-row">
                      <div class="col-md-12">
                        <div class="panel-body">
                          <!-- <textarea placeholder="Write your comment here!" id="leave-comment" class="pb-cmnt-textarea"></textarea> -->
                          <!-- <form class="form-inline"> -->
                              <!-- <div class="btn-group">
                                  <button class="btn" type="button"><span class="fa fa-picture-o fa-lg"></span></button>
                                  <button class="btn" type="button"><span class="fa fa-video-camera fa-lg"></span></button>
                                  <button class="btn" type="button"><span class="fa fa-microphone fa-lg"></span></button>
                                  <button class="btn" type="button"><span class="fa fa-music fa-lg"></span></button>
                              </div> -->
                              <!-- <button id="share" class="btn btn-primary pull-right" type="button">Share</button> -->
                          <!-- </form> -->
                            <div class="container">
                              <div class="col-md-12" id="fbcomment">
                                <!-- <div class="header_comment">
                                  <div class="row">
                                    <div class="col-md-6 text-left">
                                      <span class="count_comment">264235 Comments</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                      <span class="sort_title">Sort by</span>
                                      <select class="sort_by">
                                      <option>Top</option>
                                      <option>Newest</option>
                                      <option>Oldest</option>
                                      </select>
                                    </div>
                                  </div>
                                </div> -->

                                <div class="body_comment">
                                  @if(Auth::guard('employee')->check() || Auth::guard('employee')->check())

                                    <div class="row">
                                      <!-- <div class="avatar_comment col-md-1">
                                        <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
                                      </div> -->
                                      <div class="box_comment col-md-11">
                                        <textarea class="commentar" id="leave-comment" placeholder="Add a comment..."></textarea>
                                        <div class="box_post">
                                        <div class="pull-left">
                                          <!-- <input type="checkbox" id="share"/> -->
                                          <!-- <label for="post_fb">Also post on Facebook</label> -->
                                        </div>
                                        <div class="pull-right">
                                          <!-- <span>
                                          <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar" />
                                          <i class="fa fa-caret-down"></i>
                                          </span> -->
                                          <button id="share" type="button">Post</button>
                                        </div>
                                        </div>
                                      </div>
                                    </div>
                                  @endif
                                  <div class="row">
                                    <ul id="list_comment" class="col-md-12">
                                      @foreach($datas['event']['comment'] as $comment)
                                        @if($comment->parent_id == null)
                                          <li class="box_result row">
                                            <div class="avatar_comment col-md-1">
                                              <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
                                            </div>
                                            <div class="result_comment col-md-11">
                                              <h4>
                                                {{$comment->employee != null ? $comment->employee->firstname.' '.$comment->employee->lastname:''}}
                                                {{$comment->employer != null ? $comment->employer->firstname.' '.$comment->employer->lastname:''}}
                                              </h4>
                                              <p>{{$comment->comment}}</p>
                                              <div class="tools_comment">
                                                <!-- <a class="like" href="#">Like</a> -->
                                                <!-- <span aria-hidden="true"> · </span> -->
                                                @if(Auth::guard('employee')->check() || Auth::guard('employee')->check())
                                                  <a class="replay" href="" comment_id="{{$comment->id}}">Reply</a>
                                                  <!-- <span aria-hidden="true"> · </span> -->
                                                  <!-- <i class="fa fa-thumbs-o-up"></i> <span class="count">1</span>  -->
                                                  <span aria-hidden="true"> · </span>
                                                @endif
                                                <span>{{\Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans()}}</span>
                                              </div>
                                              <ul class="child_replay">
                                                @if($comment->replies!= null)
                                                  @foreach($comment->replies as $reply)
                                                    <li class="box_reply row">
                                                      <div class="avatar_comment col-md-1">
                                                        <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
                                                      </div>
                                                      <div class="result_comment col-md-11">
                                                        <h4>
                                                          {{$reply->employee != null ? $reply->employee->firstname.' '.$reply->employee->lastname:''}}
                                                          {{$reply->employer != null ? $reply->employer->firstname.' '.$reply->employer->lastname:''}}
                                                        </h4>
                                                        <p>{{$reply->comment}}</p>
                                                        <div class="tools_comment">
                                                          @if(Auth::guard('employee')->check() || Auth::guard('employee')->check())
                                                            <!-- <a class="like" href="#">Like</a> -->
                                                            <!-- <span aria-hidden="true"> · </span> -->
                                                            <a class="replay" href="#">Reply</a>
                                                            <span aria-hidden="true"> · </span>
                                                          @endif
                                                          <!-- <i class="fa fa-thumbs-o-up"></i> <span class="count">1</span>  -->
                                                          <!-- <span aria-hidden="true"> · </span> -->
                                                          <span>{{\Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans()}}</span>
                                                        </div>
                                                        <ul class="child_replay"></ul>
                                                      </div>
                                                    </li>
                                                  @endforeach
                                                @endif
                                              </ul>
                                            </div>
                                          </li>
                                        @endif
                                      @endforeach
                                    </ul>
                                  <!-- <button class="show_more" type="button">Load 10 more comments</button> -->
                                  </div>
                                </div>
                              </div>
                            </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- tab navigarion items !-->
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                  <!-- review section of comment/review tab!-->
                  <div class="container">
                    <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="card bg-light card-body mb-3 card bg-faded">
                                    <div class="row">
                                        <div class="col-12 col-lg-6 text-center">
                                            <h1 class="rating-num">
                                            {{number_format($datas['event']['avgRatings'], 1)}}
                                            </h1>
                                              <div class="row">
                                              <fieldset class="col-md-12 rating" style="padding-right:240px">
                                                  <input type="radio" disabled  {{  ($datas['event']['avgRatings']<=5 && $datas['event']['avgRatings']>4.5 )   ? 'checked': '' }}  id="avgStar5" name="rating" value="5" /><label class = "full" for="avgStar5" title="Awesome - 5 stars"></label>
                                                  <input type="radio" disabled  {{  ($datas['event']['avgRatings']<=4.5 && $datas['event']['avgRatings']>4 )   ? 'checked': '' }}  id="avgStar4half" name="rating" value="4 and a half" /><label class="half" for="avgStar4half" title="Pretty good - 4.5 stars"></label>
                                                  <input type="radio" disabled  {{  ($datas['event']['avgRatings']<=4 && $datas['event']['avgRatings']>3.5 )   ? 'checked': '' }}  id="avgStar4" name="rating" value="4" /><label class = "full" for="avgStar4" title="Pretty good - 4 stars"></label>
                                                  <input type="radio" disabled  {{  ($datas['event']['avgRatings']<=3.5 && $datas['event']['avgRatings']>3 )   ? 'checked': '' }}  id="avgStar3half" name="rating" value="3 and a half" /><label class="half" for="avgStar3half" title="Meh - 3.5 stars"></label>
                                                  <input type="radio" disabled  {{  ($datas['event']['avgRatings']<=3 && $datas['event']['avgRatings']>2.5 )   ? 'checked': '' }}  id="avgStar3" name="rating" value="3" /><label class = "full" for="avgStar3" title="Meh - 3 stars"></label>
                                                  <input type="radio" disabled  {{  ($datas['event']['avgRatings']<=2.5 && $datas['event']['avgRatings']>2 )   ? 'checked': '' }}  id="avgStar2half" name="rating" value="2 and a half" /><label class="half" for="avgStar2half" title="Kinda bad - 2.5 stars"></label>
                                                  <input type="radio" disabled  {{  ($datas['event']['avgRatings']<=2 && $datas['event']['avgRatings']>1.5 )   ? 'checked': '' }}  id="avgStar2" name="rating" value="2" /><label class = "full" for="avgStar2" title="Kinda bad - 2 stars"></label>
                                                  <input type="radio" disabled  {{  ($datas['event']['avgRatings']<=1.5 && $datas['event']['avgRatings']>1 )   ? 'checked': '' }}  id="avgStar1half" name="rating" value="1 and a half" /><label class="half" for="avgStar1half" title="Meh - 1.5 stars"></label>
                                                  <input type="radio" disabled  {{  ($datas['event']['avgRatings']<=1 && $datas['event']['avgRatings']>0.5 )   ? 'checked': '' }}  id="avgStar1" name="rating" value="1" /><label class = "full" for="avgStar1" title="Sucks big time - 1 star"></label>
                                                  <input type="radio" disabled  {{  ($datas['event']['avgRatings']<=0.5 && $datas['event']['avgRatings']>0 )   ? 'checked': '' }}  id="avgStarhalf" name="rating" value="half" /><label class="half" for="avgStarhalf" title="Sucks big time - 0.5 stars"></label>
                                              </fieldset>
                                              <div class="col-md-12">
                                                <span class="glyphicon glyphicon-user"></span>{{count($datas['event']->reviews)}} total
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-5">
                                            <div class="row rating-desc">
                                                <div class="col-3 col-lg-3 text-right"> <span class="glyphicon glyphicon-star"></span>5</div>
                                                <div class="col-8 col-lg-9">
                                                    <div class="progress progress-striped">
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 80%"> <span class="sr-only">80%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end 5 -->
                                                <div class="col-3 col-lg-3 text-right"> <span class="glyphicon glyphicon-star"></span>4</div>
                                                <div class="col-8 col-lg-9">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 60%"> <span class="sr-only">60%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end 4 -->
                                                <div class="col-3 col-lg-3 text-right"> <span class="glyphicon glyphicon-star"></span>3</div>
                                                <div class="col-8 col-lg-9">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end 3 -->
                                                <div class="col-3 col-lg-3 text-right"> <span class="glyphicon glyphicon-star"></span>2</div>
                                                <div class="col-8 col-lg-9">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 20%"> <span class="sr-only">20%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end 2 -->
                                                <div class="col-3 col-lg-3 text-right"> <span class="glyphicon glyphicon-star"></span>1</div>
                                                <div class="col-8 col-lg-9">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80"
                                                        aria-valuemin="0" aria-valuemax="100" style="width: 15%"> <span class="sr-only">15%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end 1 -->
                                            </div>
                                            <!-- end row -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(Auth::guard('employee')->check() || Auth::guard('employee')->check())
                      <div class="container">
                        <div class="row" id="post-review-box">
                          <div class="card bg-light card-body mb-3 card bg-faded">
                            <div>
                              <label for="">Add a Review</label>
                              <input id="ratings-hidden" name="review_rating" type="hidden">
                              <textarea class="form-control animated" cols="50" id="new-review" name="review_comment" placeholder="Enter your review here..." rows="5"></textarea>
                              <fieldset class="rating">
                                  <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                  <!-- <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label> -->
                                  <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                  <!-- <input type="radio" id="star3half" name="rating" checked value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label> -->
                                  <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                  <!-- <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label> -->
                                  <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                  <!-- <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label> -->
                                  <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                  <!-- <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label> -->
                              </fieldset>
                              <div class="text-right">
                                <button class="btn btn-success btn-sm" id="addReview" style="margin-top:8px">Save</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif


                    @foreach($datas['event']->reviews as $review)
                      <div class="container">
                        <div class="row card">
                            <div class="card bg-light card-body card bg-faded">
                                <div class="row">
                                    <!-- <div class="col-md-2">
                                        <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
                                      </div> -->
                                      <div class="col-md-12">
                                        <p>
                                          <a class="float-left" href="">
                                            <strong>
                                            {{$review->employee != null ? $review->employee->firstname.' '.$review->employee->lastname:''}}
                                            {{$review->employer != null ? $review->employer->firstname.' '.$review->employer->lastname:''}}
                                          </strong>
                                        </a>
                                        @for ($i = 0; $i < $review->rating; $i++)
                                        <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                                        @endfor
                                      </p>
                                      <div class="clearfix"></div>
                                      <p>{{$review->review}}</p>
                                      <p class="text-secondary">{{\Carbon\Carbon::createFromTimeStamp(strtotime($review->created_at))->diffForHumans()}}</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                      </div>
                    @endforeach

                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
            @if(count($datas['event']->Photos) > 0 || $datas['event']->video != '')
            <div class="tabsection">
              <nav>
                <div class="nav nav-tabs event_tab" id="nav-tab"  role="tablist" >

                  <a class="nav-item nav-link active tab_font" id="nav-comment-tab" data-toggle="tab" href="#nav-comment" role="tab" aria-controls="nav-comment" aria-selected="true">PHOTOS</a>

                  <a class="nav-item nav-link tab_font" id="nav-review-tab" data-toggle="tab" href="#nav-review" role="tab" aria-controls="nav-review" aria-selected="false">VIDEOS</a>

                </div>
              </nav>
              <div class="tab-content stroke" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-comment" role="tabpanel" aria-labelledby="nav-comment-tab">
                  <div class="event_gallery">
                    <div class="row cm10-row">
                      @if(count($datas['event']->Photos) > 0)
                      @foreach($datas['event']->Photos as $photo)
                      @if(is_file(DIR_IMAGE.$photo->image))
                      @php($event_photo = \App\Imagetool::mycrop($photo->image,400,225))
                      <div class="col-md-2">
                        <img src="{{asset($event_photo)}}" class="rgt8m img_size">
                      </div>
                      @endif
                      @endforeach
                      @else
                      <div class="col-md-12"><div class="alert alert-info">No any Sponsors</div></div>
                      @endif
                    </div>
                  </div>
                </div>
                <!-- tab navigarion items !-->
                <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                  <!-- video section of photo/video tab!-->
                  <div class="event_gallery">
                    <div class="row cm10-row">
                      <div class="col-md-12">
                        @if(!empty($datas['event']->video))
                        @php($links=str_replace('watch?v=', 'embed/', $datas['event']->video))
                        <div class="col-sm-12" style="position: relative;padding-bottom: 56.25%; padding-top: 25px;height: 0;">
                          <iframe src="<?php echo $links;?>" frameborder="0" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;"></iframe>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            @endif
            @if(isset($datas['map']))
            <div class="row cm10-row">
              <div class="col-md-12">
                <?php echo $datas['map']['js']; ?>
                <?php echo $datas['map']['html']; ?>
              </div>
            </div>
            @endif

            @else
            <div class="row cm10-row">
              <div class="col-md-12">
                <div class="alert alert-info">Sorry data not found.</div>
              </div>
            </div>
            @endif
          </div>
          @foreach($datas['main_modules'] as $main_module)
          <?php echo $main_module['module']; ?>
          @endforeach
        </div>
        @if (count($datas['right_content']) > 0)
        <aside class="col-lg-2 col-md-4 col-sm-12 col-xs-12">
          @foreach($datas['right_content'] as $rcontent)
          <?php echo $rcontent['module']; ?>
          @endforeach
        </aside>
        @endif

      </div>
    </div>
  </div>
</section>

@if(count($datas['bottom_content']) > 0 || count($datas['related']) > 0)
<section id="bottom_content" class="jobs tb35p">
  <div class="container">
    <div class="white_div">
      <div class="tp20p">
        @if(count($datas['related']) > 0)
        @foreach($datas['related']->chunk(3) as $related )
        <div class="row cm10-row">
          <div class="col-md-12 btm15m">
            <div class="title_three">Related Event</div>
          </div>
          @foreach($related as $event)
          <div class="col-md-4">
            <div class="white_block event">
              <div class="event_icon float-right"><i class="fa fa-chalkboard-teacher"></i></div>
              <h3 class="h3">{{$event->title}}</h3>
              <div class="border"></div>
              <p>{{\App\Library\Settings::getLimitedWords($event->description,0,20)}}</p>
              <div class="event_info">
                <p><i class="fa fa-map-marker-alt"></i> {{$event->address}}</p>
                <p><i class="fa fa-landmark"></i> {{$event->venue}}</p>
                <p><i class="far fa-calendar-alt"></i> {{$event->event_date}}</p>
              </div>
              <div class="tp10p">
                <a href="{{url('/events/'.$event->seo_url)}}" class="morejob">More <i class="fa fa-angle-double-right"></i></a>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        @endforeach

        @endif
        @if(count($datas['bottom_content']) > 0)
        <div class="row">
          <div class="col-md-12">
            @foreach($datas['bottom_content'] as $bcontent)
            <?php echo $bcontent['module']; ?>
            @endforeach
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>
@endif
<script type="text/javascript">
    $('#buy-inhouse-event-ticket, #buy-outsource-event-ticket').click(function(){
        var event_id = $(this).attr('event-id');
        var ticket_type = $("#ticket_type").val();
        var quantity = $("#quantity").val();
        var ticket_price = $("#ticket_type option:selected").attr('price');
        var token = $('input[name=\'_token\']').val();
        if (event_id) {
            $.ajax({
                type: 'POST',
                url: '/employee/event/buy',
                data: 'event_id='+event_id+'&ticket_type='+ticket_type+'&ticket_price='+ticket_price+'&quantity='+quantity+'&_token='+token,
                cache: false,
                success: function(response){
                  console.log(response);
                  window.location.href = "/employee/cart";
                }
            });
        } else{
            alert('Payment Option not seleted.');
        }
    });
    $('#book-inhouse-event-ticket').click(function(){
        var event_id = $(this).attr('event-id');
        var token = $('input[name=\'_token\']').val();
        if (event_id) {
            $.ajax({
                type: 'POST',
                url: '/employee/event/'+event_id+'/book',
                data: 'event_id='+event_id+'&_token='+token,
                cache: false,
                success: function(response){
                  location.reload();
                  console.log(response);
                }
            });
        } else{
            alert('Payment Option not seleted.');
        }
    })
</script>
<script>
  //please check event-comments.js and event-coment.css.
  $( document ).ready(function() {

    $("#share").on("click", function(){
      var event_id = "{{$datas['event']->id}}";
      var token = $('input[name=\'_token\']').val();
      var comment = $("#leave-comment").val();
      $.ajax({
          type: 'POST',
          url: '/employee/event/'+event_id+'/comment',
          data: 'event_id='+event_id+'&_token='+token+'&comment='+comment,
          cache: false,
          success: function(response){
            location.reload();
            console.log(response);
          }
      });
    });
  });
  function saveReply(comment_id){
    var reply_comment = $("#reply-comment").val();
    var event_id = "{{$datas['event']->id}}";
    var token = $('input[name=\'_token\']').val();
    $.ajax({
        type: 'POST',
        url: '/employee/event/'+event_id+'/comment/'+comment_id+'/reply',
        data: 'event_id='+event_id+'&_token='+token+'&comment_id='+comment_id+'&reply='+reply_comment,
        cache: false,
        success: function(response){
          location.reload();
          console.log(response);
        }
    });
    return;
  }

  $("#addReview").on("click", function(e){
    var event_id = "{{$datas['event']->id}}";
    var review = $('#new-review').val();
    var rating = $('input[name=\'rating\']:checked').val();
    var token = $('input[name=\'_token\']').val();
    // console.log(rating,review);
    $.ajax({
        type: 'POST',
        url: '/employee/event/'+event_id+'/review',
        data: 'event_id='+event_id+'&_token='+token+'&review='+review+'&rating='+rating,
        cache: false,
        success: function(response){
          location.reload();
          console.log(response);
        }
    });
  });
</script>
@stop
