<section class="mt-3">
<div class="card">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs float-left" role="tablist">
            @foreach($datas['tabs'] as $tab)
            <li class="nav-item">
                <a class="nav-link" id="{{$tab['id']}}" data-toggle="tab" href="#" data-target="#tab{{$tab['id']}}" role="tab">
                    <strong>{{$tab['title']}}</strong>
                </a>
            </li>
            @endforeach
            
        </ul>
    </div>

    <div class="card-block">
        <div class="tab-content">
            @foreach($datas['tabs'] as $tabs)
            <div class="tab-pane" id="tab{{$tabs['id']}}" role="tabpanel">
                <div class="row">
                    <div class="col-md-12">
                        
                            <div class="row job-category">
                                                        <ul>
                                                           
                                                            @foreach($tabs['mydata'] as $mdt)
                                                            <li class="text-ellipsis col-lg-4 col-md-4 col-sm-4 col-xs-12"> <a href="{{$mdt['url']}}"><i class="fa fa-caret-right"></i>{{$mdt['title']}}</a> </li>
                                                            @endforeach
                                                       
                                                        </ul>
                                                        
                                                    </div>
                            
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</section>