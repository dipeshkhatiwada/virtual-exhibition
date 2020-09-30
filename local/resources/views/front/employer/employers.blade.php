<div class="row">
     <!-- Job Detail List -->
                       

                        @if(count($datas) > 0)
                        <div class="careerfy-column-12 careerfy-typo-wrap">
                            
                            
                            
                            
                            <div class="careerfy-job careerfy-joblisting-classic careerfy-jobdetail-joblisting">
                                <ul id="accordion" class="careerfy-row ">
                                    <?php $i = 1; ?>
                                    @foreach($datas as $data)
                                    <?php $address = \App\EmployerAddress::where('employers_id', $data->id)->first(); ?>
                                    
                                    <li class="careerfy-column-12">
                                        <div class="careerfy-joblisting-classic-wrap bgcolor{{$i++}}">
                                            @if($data->logo)
                                            <figure><a href="{{url($data->seo_url)}}"><img src="{{asset('/image/'.$data->logo)}}" alt=""></a></figure>
                                            @endif
                                            <div class="careerfy-joblisting-text">
                                                <div class="careerfy-list-option">
                                                    <h2><a href="{{url($data->seo_url)}}">{{$data->name}}</a> <span>{{\App\OrganizationType::getOrgTypeTitle($data->org_type)}}</span></h2>
                                                    <ul>
                                                        @if($data->email != '')
                                                        <li><i class="careerfy-icon careerfy-mail"></i>{{$data->email}}</li>
                                                        @endif
                                                        @if($data->address != '')
                                                        <li><i class="careerfy-icon careerfy-maps-and-flags"></i> {{$address->address}}</li>
                                                        @endif
                                                        @if($data->phone != '')
                                                        <li><i class="careerfy-icon careerfy-filter-tool-black-shape"></i> {{$address->phone}}</li>
                                                        @endif
                                                        @if($address->website != '')
                                                        <li><i class="careerfy-icon careerfy-internet"></i><a href="{{$address->website}}" target="_blank"> {{$address->website}}</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                                
                                            <div class="clearfix"></div>
                                            </div>
                                            
                                        </div>
                                    </li>
                                    @endforeach
                                    
                                    
                                    
                                    
                                </ul>
                            </div>
                        </div>
                        @endif
 </div>