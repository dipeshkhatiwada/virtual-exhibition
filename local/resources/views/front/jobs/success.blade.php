
 <div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="panel panel-default">
                <div class="panel-heading"><b style="font-size:14px;">Email Conformation</b></div>
                <div class="panel-body">
                  @if (Session::has('alert-success'))
                  <div class="alert alert-success" style="font-size: 20px; font-weight: bold;">{{ Session::get('alert-success') }}</div>
                  @else
                  <div class="alert alert-success" style="font-size: 20px; font-weight: bold;">We have successfully received your application. Please visit {{url('/status')}} to know the updates of Recruitment and Selection process.</div>
                  @endif     
                </div>
            </div>
        </div>
    </div>
</div>
</div>
