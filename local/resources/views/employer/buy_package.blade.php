@extends('employer_master')
@section('content')
  <h3 class="form_heading" id="buy_job_package_div">Buy Job Package <a href="#buy_tender_package_div" class="btn upgradebtn right hidden-xs">Buy Tender package</a> <a href="#resume_package_div" class="btn upgradebtn right hidden-xs">Buy Resume Package</a> <a href="#upgrade_member_div" class="btn upgradebtn right hidden-xs">Upgrade Member</a> </h3>
    <div class="form_tabbar">
     
      <div class="row cm10-row">
          @foreach($datas['job_type'] as $job_type)
          @php($offer = \App\JobType::CurrentOffers($job_type->id))
          @php($discount_percent = $offer['discount_percent'])
          @php($discount_title = $offer['title'])
          @php($price = \App\JobType::getStartingPrice($job_type->id,$discount_percent))
         
            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="pricelist_block">
                    <div class="priceheading {{\App\JobType::getBackground($job_type->id)}}">
                      <span>{{$job_type->title}}</span>
                      <p class="starting">Starting at</p>
                      <p class="price" id="price-{{$job_type->id}}">
                        @if($price['after_discount'] > 0)
                        @php($display_price = $price['after_discount'])
                        <span class="old_price">{{$price['current_price']}}</span>
                        {{$price['after_discount']}}
                        @else
                         @php($display_price = $price['current_price'])
                        {{$display_price}}
                        @endif
                      </p>
                       @if($discount_percent > 0)
                       <div class="ribbon ribbon-top-left"><span>{{$discount_title}} </span></div>
                       <div class="ribbon ribbon-top-right"><span>{{$discount_percent}}% Discount </span></div>
                       @endif
                    </div>
                    
                    <ul>
                        <!-- <li>Display Type <span class="float-right greenclr"> {{$job_type->display_type}}</span></li>
                        <li>Display <span class="float-right greenclr"> {{$job_type->display}}</span></li> -->
                        <li>Priority <span class="float-right greenclr"> {{$job_type->priority}}</span></li>
                        <li>Placement <span class="float-right greenclr"> {{$job_type->placement}}</span></li>
                        <li>Communication with job seeker<span class="float-right {{$job_type->communication == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$job_type->communication == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                        <li>Job Alert <span class="float-right {{$job_type->job_alert == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$job_type->job_alert == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                        <li>Listing recommended Job/Similar Job <span class="float-right {{$job_type->listing_recomended == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$job_type->listing_recomended == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                        <li>Listing in search <span class="float-right {{$job_type->listing_search == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$job_type->listing_search == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                   
                        <li>SMS alert <span class="float-right {{$job_type->sms_alert == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$job_type->sms_alert == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                        <li>Sorting Features <span class="float-right {{$job_type->process_tab > 0 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$job_type->process_tab > 0 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                    </ul>
                    <form  enctype="multipart/form-data" role="form" id="price_form{{$job_type->id}}" method="POST" action="{{ url('/employer/package/buy') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="job_type" value="{{$job_type->id}}">
                        <input type="hidden" name="number_of_job" id="number_of_job{{$job_type->id}}" value="{{\App\JobType::getStartingPost($job_type->id)}}">
                       <input type="hidden" name="duration" id="duration{{$job_type->id}}" value="7">
                       <input type="hidden" name="amount" id="amount{{$job_type->id}}" value="{{$display_price}}">
                       <input type="hidden" name="discount_percent" id="discount_percent{{$job_type->id}}" value="{{$discount_percent}}">

                      </form>
                    <div class="calculation">
                      <div class="row cm10-row form-group">
                        <div class="col-md-6">
                          <label class="label-control"><strong>Quantity</strong></label>
                          <select id="qty_{{$job_type->id}}" class="qty form-control">
                            @foreach($job_type->JobPrice as $price)
                            <option value="{{$price->no_of_post}}">{{$price->no_of_post}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label class="label-control"><strong>Display Days</strong></label>
                          <select id="duration_{{$job_type->id}}" class="dur form-control">
                            <option value="7">7</option>
                            <option value="14">14</option>
                            <option value="21">21</option>
                            <option value="30">30</option>
                          </select>
                        </div>
                        <p class="price-text">Total price to pay</p>
                        <div id="price-b{{$job_type->id}}" class="price-btn price {{\App\JobType::getBackground($job_type->id)}}">{{$display_price}}</div>
                      </div>
                      
                    </div>
                    <div class="pricing-footer">
                      <div class="buy-now pointer buy-package" id="{{$job_type->id}}">
                        <i class="fa fa-shopping-cart"></i> Buy Now
                      </div>
                    </div>
                    
                </div>
            </div>
            @endforeach
            
            
           
        </div>

         <div class="row cm10-row">
          <div class="all-price-heading">All Package Price</div>

           @foreach($datas['job_type'] as $job_type)
           <div class="col-md-12">
              <div class="priceheading {{\App\JobType::getBackground($job_type->id)}} allprice-heading">
                <span>{{$job_type->title}}</span>
              </div>
               @if(count($job_type->JobPrice) > 0)
                    <div class="listprice">
                      
                      <div class="row cm10-row">
                        <div class="col-md-3">
                          <div class="price_block">
                            <h3 class="package">Seven Days</h3>
                            <table class="table pricetable">
                              <thead>
                                <tr>
                                  <th>Jobs</th>
                                  <th>Amount (Rs)</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($job_type->JobPrice as $price)
                                <tr>
                                  <td>{{$price->no_of_post}}</td>
                                  <td>{{$price->seven_days}}</td>
                                </tr>
                                @endforeach
                               
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="price_block">
                            <h3 class="package">Fourteen Days</h3>
                            <table class="table pricetable">
                              <thead>
                                <tr>
                                  <th>Jobs</th>
                                  <th>Amount (Rs)</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($job_type->JobPrice as $price)
                                <tr>
                                  <td>{{$price->no_of_post}}</td>
                                  <td>{{$price->fourteen_days}}</td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="price_block">
                            <h3 class="package">Twenty-one Days</h3>
                            <table class="table pricetable">
                              <thead>
                                <tr>
                                  <th>Jobs</th>
                                  <th>Amount (Rs)</th>
                                </tr>
                              </thead>
                              <tbody>
                               @foreach($job_type->JobPrice as $price)
                                <tr>
                                  <td>{{$price->no_of_post}}</td>
                                  <td>{{$price->twentyone_days}}</td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="price_block">
                            <h3 class="package">Thirty Days</h3>
                            <table class="table pricetable">
                              <thead>
                                <tr>
                                  <th>Jobs</th>
                                  <th>Amount (Rs)</th>
                                </tr>
                              </thead>
                              <tbody>
                               @foreach($job_type->JobPrice as $price)
                                <tr>
                                  <td>{{$price->no_of_post}}</td>
                                  <td>{{$price->thirty_days}}</td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
           </div>
           @endforeach

         </div>


  </div>
@if(count($datas['member_type']) > 0)
  <h3 class="form_heading" id="upgrade_member_div">Upgrade Member <a href="#buy_tender_package_div" class="btn upgradebtn right hidden-xs">Buy Tender package</a> <a href="#resume_package_div" class="btn upgradebtn right hidden-xs">Buy Resume Package</a> <a href="#buy_job_package_div" class="btn upgradebtn right hidden-xs">Buy Job Package</a></h3>
    <div class="form_tabbar">
     
        <div class="row cm10-row">
          @foreach($datas['member_type'] as $member_type)
          @if($member_type->quarter_price > 0)
          @php($current_price = $member_type->quarter_price)
          @php($current_duration = 3)
          @elseif($member_type->half_price > 0)
          @php($current_price = $member_type->half_price)
           @php($current_duration = 6)
          @elseif($member_type->service_charge > 0)
          @php($current_price = $member_type->service_charge)
           @php($current_duration = 12)
          @else
          @php($current_price = '0.00')
           @php($current_duration = 0)
          @endif
          @php($offer = \App\MemberType::CurrentOffers($member_type->id,$current_price))
         
            <div class="col-md-6">
                <div class="pricelist_block">
                    <div class="priceheading {{$member_type->id == 3 ? 'redbg' : 'dimondbg'}}">
                      <span>{{$member_type->name}}</span>
                     
                     
                      
                    </div>
                    <div class="price member_price {{$member_type->id == 3 ? 'dark_redbg' : 'dark_dimondbg'}}  center whiteclr">
                      @if($offer['discount_percent'] > 0)
                       <span class="old_price">{{$current_price}}</span>
                        
                      {{$offer['discount_price']}}
                      @else
                      {{$current_price}}
                      @endif
                    </div>
                    @if($offer['discount_percent'] > 0)
                       <div class="ribbon ribbon-top-left"><span>{{$offer['title']}} </span></div>
                       <div class="ribbon ribbon-top-right"><span>{{$offer['discount_percent']}}% Discount </span></div>
                       @endif
                  
                    
                    <ul>
                        <li>Display Type <span class="float-right greenclr"> {{$member_type->display_type}}</span></li>
                        <li>Position <span class="float-right greenclr"> {{$member_type->position}}</span></li> 
                        <li>Priority <span class="float-right greenclr"> {{$member_type->priority}}</span></li>
                        <li>Placement <span class="float-right greenclr"> {{$member_type->placement}}</span></li>
                        <li>Control Panel<span class="float-right {{$member_type->control_panel == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->control_panel == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                        <li>Rating Features <span class="float-right {{$member_type->rating_feature == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->rating_feature == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                        <li>Images <span class="float-right {{$member_type->images == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->images == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                        <li>Communication with Job Seeker <span class="float-right {{$member_type->communication == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->communication == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                   
                        <li>Privacy Setting <span class="float-right {{$member_type->privacy_setting == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->privacy_setting == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                        <li>Coloured Background <span class="float-right {{$member_type->background == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->background == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                         <li>Customized Page <span class="float-right {{$member_type->customized_page == 'Yes' ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->customized_page == 'Yes' ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                          <li>Job Alert <span class="float-right {{$member_type->job_alert == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->job_alert == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                        <li>Listing recommended Job/Similar Job <span class="float-right {{$member_type->listing_recomended == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->listing_recomended == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                        <li>Listing in search <span class="float-right {{$member_type->listing_search == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->listing_search == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                   
                        <li>SMS alert <span class="float-right {{$member_type->sms_alert == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->sms_alert == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                        <li>Sorting Features <span class="float-right {{$member_type->process_tab == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->process_tab == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                         <li>Email auto responder <span class="float-right {{$member_type->auto_responder == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->auto_responder == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                         <li>Email auto responder <span class="float-right {{$member_type->app_screeing == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->app_screeing == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                         <li>Application Screening <span class="float-right {{$member_type->app_screeing == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->app_screeing == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>

                         <li>Application Shorting <span class="float-right {{$member_type->app_shorting == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->app_shorting == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>

                         <li>Access on database <span class="float-right {{$member_type->data_access == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->data_access == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                          <li>Pre-Test <span class="float-right {{$member_type->data_access == 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->data_access == 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                         
                         <li>Advertise Post <span class="float-right greenclr"> {{$member_type->advertise_no}}</span></li>
                         <li>Number of User <span class="float-right greenclr"> {{$member_type->user_no}}</span></li>
                         <li>Notice Publish <span class="float-right {{$member_type->user_no > 1 ? 'greenclr' : 'redclr'}}"> <i class="fa {{$member_type->user_no > 1 ? 'fa-check-circle' : 'fa-times'}}"></i></span></li>
                         <li>Number of Recruitment Process <span class="float-right greenclr"> {{$member_type->process_no}}</span></li>
                         <li>Job Type <span class="float-right greenclr"> {{\App\JobType::getTitle($member_type->job_type)}}</span></li>
                    </ul>
                    <form  enctype="multipart/form-data" role="form" id="upgrade_form{{$member_type->id}}" method="POST" action="{{ url('/employer/upgrade/save') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="member_type" value="{{$member_type->id}}">
                        <input type="hidden" name="duration" id="duration_{{$member_type->id}}" value="{{$current_duration}}">
                        <input type="hidden" name="amount" id="amount_{{$member_type->id}}" value="{{$current_price}}">
                       

                      </form>
                       <div class="calculation">
                      <div class="row cm10-row form-group">
                        <div class="col-md-12">
                          <label class="label-control"><strong>Quantity</strong></label>
                          <select id="member_qty_{{$member_type->id}}" class="member_qty form-control">
                            @if($member_type->quarter_price > 0)
                            <option dur="3" value="{{$member_type->quarter_price}}">3 Months ({{$member_type->quarter_price}}) </option>
                            @endif
                            @if($member_type->half_price > 0)
                            <option dur="6" value="{{$member_type->half_price}}">6 Months ({{$member_type->half_price}}) 30% Off</option>
                            @endif
                            <option dur="12" value="{{$member_type->service_charge}}">12 Months ({{$member_type->service_charge}}) 40% Off</option>
                          </select>
                        </div>
                        
                        <p class="price-text">Total price to pay</p>
                        <div id="member_price_b{{$member_type->id}}" class="price-btn price {{$member_type->id == 3 ? 'redbg' : 'dimondbg'}}"> @if($offer['discount_percent'] > 0)
                       <span class="old_price">{{$current_price}}</span>
                        
                      {{$offer['discount_price']}}
                      @else
                      {{$current_price}}
                      @endif</div>
                      </div>
                      
                    </div>
                    
                    <div class="pricing-footer">
                      <div class="buy-now pointer buy-member" id="{{$member_type->id}}">
                        <i class="fa fa-shopping-cart"></i> Add to cart
                      </div>
                    </div>
                    
                </div>
            </div>
            @endforeach
            
            
           
        </div>


  </div>
  @endif

  <h3 class="form_heading" id="resume_package_div">Buy Resume Download Package <a href="#buy_tender_package_div" class="btn upgradebtn right hidden-xs">Buy Tender package</a> <a href="#buy_job_package_div" class="btn upgradebtn right hidden-xs">Buy Job Package</a> <a href="#upgrade_member_div" class="btn upgradebtn right hidden-xs">Upgrade Member</a></h3>
    <div class="form_tabbar">
     
     <form method="POST" action="{{ url('/employer/resumepackage/save') }}">
                        {!! csrf_field() !!}
                        

                     
                        <div class="form-group row">
                            <label for="package" class="col-md-2 col-form-label text-md-right">Select Package</label>
                            <div class="col-md-10">
                               <select class="form-control" name="package">
                                 @foreach($datas['resume_package'] as $resume_package)
                                 @php($label = '')
                                 @if($resume_package->discount > 0)
                                 @php($after_discount = $resume_package->price - ($resume_package->price * ($resume_package->discount / 100)))
                                 @php($label = ' Discount '.$resume_package->discount.'% After discount: '.$after_discount)
                                 @endif
                                  @if(old('package') == $resume_package->id)
                                  <option selected="selected" value="{{$resume_package->id}}">{{$resume_package->title. ' '.$resume_package->resume_number. ' Resume, Valied until '.$resume_package->duration.' Days '.$label}}</option>
                                  @else
                                  <option value="{{$resume_package->id}}">{{$resume_package->title. ' '.$resume_package->resume_number. ' Resume, Valied until '.$resume_package->duration.' Days, Price '.$resume_package->price.$label}}</option>
                                  @endif
                                 @endforeach
                               </select>

                                @if ($errors->has('package'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('package') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn lightgreen_gradient tb10m">
                                   Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
            

        
</div>


<h3 class="form_heading" id="buy_tender_package_div">Buy Tender Package <a href="#buy_job_package_div" class="btn upgradebtn right hidden-xs">Buy Job package</a> <a href="#resume_package_div" class="btn upgradebtn right hidden-xs">Buy Resume Package</a> <a href="#upgrade_member_div" class="btn upgradebtn right hidden-xs">Upgrade Member</a></h3>
    <div class="form_tabbar">
     
      <div class="row cm10-row">
          @foreach($datas['tender_type'] as $tender_type)
          @php($offer = \App\TenderFunctionType::CurrentOffers($tender_type->id))
          @php($discount_percent = $offer['discount_percent'])
          @php($discount_title = $offer['title'])
          @php($price = \App\TenderFunctionType::getStartingPrice($tender_type->id,$discount_percent))
         
            <div class="col-md-4">
                <div class="pricelist_block">
                    <div class="priceheading {{\App\TenderFunctionType::getBackground($tender_type->id)}}">
                      <span>{{$tender_type->title}}</span>
                      <p class="starting">Starting at</p>
                      <p class="price" id="price-{{$tender_type->id}}">
                        @if($price['after_discount'] > 0)
                        @php($display_price = $price['after_discount'])
                        <span class="old_price">{{$price['current_price']}}</span>
                        {{$price['after_discount']}}
                        @else
                         @php($display_price = $price['current_price'])
                        {{$display_price}}
                        @endif
                      </p>
                       @if($discount_percent > 0)
                       <div class="ribbon ribbon-top-left"><span>{{$discount_title}} </span></div>
                       <div class="ribbon ribbon-top-right"><span>{{$discount_percent}}% Discount </span></div>
                       @endif
                    </div>
                    
                    <ul>

                      @if(is_array(json_decode($tender_type->features)))
                        @foreach(json_decode($tender_type->features) as $feature)
                       
                        <li>{{$feature->title}} <span class="float-right greenclr"> {{$feature->detail}}</span></li>
                        @endforeach
                        @endif
                       
                    </ul>
                    <form  enctype="multipart/form-data" role="form" id="tender_form{{$tender_type->id}}" method="POST" action="{{ url('/employer/tender_package/buy') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="tender_type" value="{{$tender_type->id}}">
                        <input type="hidden" name="number_of_tender" id="number_of_tender{{$tender_type->id}}" value="{{\App\TenderFunctionType::getStartingPost($tender_type->id)}}">
                       <input type="hidden" name="tender_duration" id="tender_duration{{$tender_type->id}}" value="7">
                       <input type="hidden" name="tender_amount" id="tender_amount{{$tender_type->id}}" value="{{$display_price}}">
                       <input type="hidden" name="tender_discount" id="tender_discount{{$tender_type->id}}" value="{{$discount_percent}}">

                      </form>
                    <div class="calculation">
                      <div class="row cm10-row form-group">
                        <div class="col-md-6">
                          <label class="label-control"><strong>Quantity</strong></label>
                          <select id="tender_quantity_{{$tender_type->id}}" class="tender_quantity form-control">
                            @foreach($tender_type->TenderPrice as $price)
                            <option value="{{$price->no_of_post}}">{{$price->no_of_post}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-6">
                          <label class="label-control"><strong>Display Days</strong></label>
                          <select id="ten_duration_{{$tender_type->id}}" class="ten_dur form-control">
                            <option value="7">7</option>
                            <option value="15">15</option>
                           
                            <option value="30">30</option>
                          </select>
                        </div>
                        <p class="price-text">Total price to pay</p>
                        <div id="tender_price-b{{$tender_type->id}}" class="price-btn price {{\App\TenderFunctionType::getBackground($tender_type->id)}}">{{$display_price}}</div>
                      </div>
                      
                    </div>
                    <div class="pricing-footer">
                      <div class="buy-now pointer buy-tenderpackage" id="{{$tender_type->id}}">
                        <i class="fa fa-shopping-cart"></i> Buy Now
                      </div>
                    </div>
                    
                </div>
            </div>
            @endforeach
            
            
           
        </div>

         


  </div>







<script type="text/javascript">
    $('.qty').change(function(){
         var id = $(this).attr('id').replace("qty_", "");
         var qty = $('#qty_'+id).val();
         var dur = $('#duration_'+id).val();
         var discount = $('#discount_percent'+id).val();
         var token = $('input[name=\'_token\']').val();
         $('#number_of_job'+id).val(qty);
         $('#duration'+id).val(dur);
         $.ajax({
            type: 'POST',
            url: '{{url("/employer/get-package-amount")}}',
            data: 'package_id='+id+'&_token='+token+'&number_of_post='+qty+'&duration='+dur+'&discount='+discount,
            cache: false,
            success: function(html){
              var datas = html.split('||');
                if (datas[1] > 0) {
                   
                    $('#price-b'+id).html('<span class="old_price">'+datas[0]+'</span>'+datas[1]);
                    $('#amount'+id).val(datas[1]);

                } else{
                   
                    $('#price-b'+id).html(datas[0]);
                    $('#amount'+id).val(datas[0]);
                }
              }
        });

       
    })

    $('.dur').change(function(){
         var id = $(this).attr('id').replace("duration_", "");
         var qty = $('#qty_'+id).val();
         var dur = $('#duration_'+id).val();
         var discount = $('#discount_percent'+id).val();
         var token = $('input[name=\'_token\']').val();
         $('#number_of_job'+id).val(qty);
         $('#duration'+id).val(dur);
         $.ajax({
            type: 'POST',
            url: '{{url("/employer/get-package-amount")}}',
            data: 'package_id='+id+'&_token='+token+'&number_of_post='+qty+'&duration='+dur+'&discount='+discount,
            cache: false,
            success: function(html){
                var datas = html.split('||');
                if (datas[1] > 0) {
                   
                    $('#price-b'+id).html('<span class="old_price">'+datas[0]+'</span>'+datas[1]);
                    $('#amount'+id).val(datas[1]);

                } else{
                   
                    $('#price-b'+id).html(datas[0]);
                    $('#amount'+id).val(datas[0]);
                }
              }
        });

       
    })

    $('.buy-package').on('click', function() {
      var id = $(this).attr('id');
      $('#price_form'+id).submit();
    })

   
</script>
<script type="text/javascript">
    $('.member_qty').on('change', function(){
      var id = $(this).attr('id').replace('member_qty_','');
      var duration = $(this).children(':selected').attr('dur');
      var amount = $(this).val();
      var discount_percent = '{{$offer['discount_percent']}}';
      if (discount_percent > 0) {
        var discount_amount = Number(amount) - ((Number(amount) * Number(discount_percent)) / 100);
        var priceb = '<span class="old_price">'+amount+'</span>'+discount_amount.toFixed(2)
        
      }else{
        var discount_amount = amount;
        var priceb = amount;
      }

      $('#duration_'+id).val(duration);
      $('#amount_'+id).val(discount_amount.toFixed(2))
      $('#member_price_b'+id).html(priceb);

    })

     $('.buy-member').on('click', function() {
      var id = $(this).attr('id');
      $('#upgrade_form'+id).submit();
    })
  </script>



  <script type="text/javascript">
    $('.tender_quantity').change(function(){
         var id = $(this).attr('id').replace("tender_quantity_", "");
         var qty = $('#tender_quantity_'+id).val();
         var dur = $('#ten_duration_'+id).val();
         var discount = $('#tender_discount'+id).val();
         var token = $('input[name=\'_token\']').val();
         $('#number_of_tender'+id).val(qty);
         $('#tender_duration'+id).val(dur);
         $.ajax({
            type: 'POST',
            url: '{{url("/employer/get-tender-package-amount")}}',
            data: 'package_id='+id+'&_token='+token+'&number_of_post='+qty+'&duration='+dur+'&discount='+discount,
            cache: false,
            success: function(html){
              var datas = html.split('||');
                if (datas[1] > 0) {
                   
                    $('#tender_price-b'+id).html('<span class="old_price">'+datas[0]+'</span>'+datas[1]);
                    $('#tender_amount'+id).val(datas[1]);

                } else{
                   
                    $('#tender_price-b'+id).html(datas[0]);
                    $('#tender_amount'+id).val(datas[0]);
                }
              }
        });

       
    })

    $('.ten_dur').change(function(){
         var id = $(this).attr('id').replace("ten_duration_", "");
        var qty = $('#tender_quantity_'+id).val();
         var dur = $('#ten_duration_'+id).val();
         var discount = $('#tender_discount'+id).val();
         var token = $('input[name=\'_token\']').val();
         $('#number_of_tender'+id).val(qty);
         $('#tender_duration'+id).val(dur);
         $.ajax({
            type: 'POST',
            url: '{{url("/employer/get-tender-package-amount")}}',
            data: 'package_id='+id+'&_token='+token+'&number_of_post='+qty+'&duration='+dur+'&discount='+discount,
            cache: false,
            success: function(html){
                var datas = html.split('||');
                if (datas[1] > 0) {
                   
                    $('#tender_price-b'+id).html('<span class="old_price">'+datas[0]+'</span>'+datas[1]);
                    $('#tender_amount'+id).val(datas[1]);

                } else{
                   
                    $('#tender_price-b'+id).html(datas[0]);
                    $('#tender_amount'+id).val(datas[0]);
                }
              }
        });

       
    })

    $('.buy-tenderpackage').on('click', function() {
      var id = $(this).attr('id');
      $('#tender_form'+id).submit();
    })

   
</script>

@endsection