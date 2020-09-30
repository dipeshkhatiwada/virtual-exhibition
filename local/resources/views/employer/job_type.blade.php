<div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <div class="modal-title" id="service_title">{{$data['jobtype']->title}} <span class="gold lft15p"><img src="{{asset('/image/'.$data['jobtype']->icon)}}"></span></div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h3 class="greenclr heading">Features</h3>
                    <div class="">
                    <h3 class="heading">Display Type:</h3>
                      <div class="greystrip"><p>{{$data['jobtype']->display_type}}</p></div>
                    </div>
                    <div class="">
                    <h3 class="heading">Display:</h3>
                    <div class="greystrip"><p>{{$data['jobtype']->display}}</p></div>
                    </div>
                    <div class="capsule">
                      <label><h3 class="heading">Priority:</h3></label>
                      <span class="result">{{$data['jobtype']->priority}}</span>
                    </div>
                    <div class="capsule">
                      <label><h3 class="heading">Placement:</h3></label>
                      <span class="result">{{$data['jobtype']->placement}}</span>
                    </div>
                    <div class="capsule">
                      <label><h3 class="heading">Communication with Job seeker:</h3></label>
                      <span class="result">{{ $data['jobtype']->communication == 1 ? 'Yes' : 'No'}}</span>
                    </div>
                    <div class="capsule">
                      <label><h3 class="heading">Job alert:</h3></label>
                      <span class="result">{{ $data['jobtype']->job_alert == 1 ? 'Yes' : 'No'}}</span>
                    </div>
                    <div class="capsule">
                      <label><h3 class="heading">Listing recommended Job/Similar job:</h3></label>
                      <span class="result">{{ $data['jobtype']->listing_recomended == 1 ? 'Yes' : 'No'}}</span>
                    </div>
                    <div class="capsule">
                      <label><h3 class="heading">Listing of search:</h3></label>
                      <span class="result">{{ $data['jobtype']->listing_search == 1 ? 'Yes' : 'No'}}</span>
                    </div>
                    <div class="capsule">
                      <label><h3 class="heading">SMS alert:</h3></label>
                      <span class="result">{{ $data['jobtype']->sms_alert == 1 ? 'Yes' : 'No'}}</span>
                    </div>
                     @if(count($data['prices']))
                    <div class="pricelist">
                      <div class="center"><a href="#" class="btn whitegradient pricebtn">Price List</a></div>
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
                                @foreach($data['prices'] as $price)
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
                                @foreach($data['prices'] as $price)
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
                               @foreach($data['prices'] as $price)
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
                               @foreach($data['prices'] as $price)
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
                </div>
            </div>


