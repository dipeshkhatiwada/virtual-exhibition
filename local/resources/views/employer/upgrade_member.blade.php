@extends('employer_master')
@section('content')
  <h3 class="form_heading">Upgrade Member</h3>
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
                    <div class="priceheading {{$member_type->id == 3 ? 'redbg' : 'dimondbg'}} p25">
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
                    <form  enctype="multipart/form-data" role="form" id="price_form{{$member_type->id}}" method="POST" action="{{ url('/employer/upgrade/save') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="member_type" value="{{$member_type->id}}">
                        <input type="hidden" name="duration" id="duration_{{$member_type->id}}" value="{{$current_duration}}">
                        <input type="hidden" name="amount" id="amount_{{$member_type->id}}" value="{{$current_price}}">
                       

                      </form>
                       <div class="calculation">
                      <div class="row cm10-row form-group">
                        <div class="col-md-12">
                          <label class="label-control"><strong>Quantity</strong></label>
                          <select id="qty_{{$member_type->id}}" class="qty form-control">
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
                        <div id="price-b{{$member_type->id}}" class="price-btn price {{$member_type->id == 3 ? 'redbg' : 'dimondbg'}}"> @if($offer['discount_percent'] > 0)
                       <span class="old_price">{{$current_price}}</span>
                        
                      {{$offer['discount_price']}}
                      @else
                      {{$current_price}}
                      @endif</div>
                      </div>
                      
                    </div>
                    
                    <div class="pricing-footer">
                      <div class="buy-now pointer" id="{{$member_type->id}}">
                        <i class="fa fa-shopping-cart"></i> Add to cart
                      </div>
                    </div>
                    
                </div>
            </div>
            @endforeach
            
            
           
        </div>


  </div>

  <script type="text/javascript">
    $('.qty').on('change', function(){
      var id = $(this).attr('id').replace('qty_','');
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
      $('#price-b'+id).html(priceb);

    })

     $('.buy-now').on('click', function() {
      var id = $(this).attr('id');
      $('#price_form'+id).submit();
    })
  </script>



@endsection