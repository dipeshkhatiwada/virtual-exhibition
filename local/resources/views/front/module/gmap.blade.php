@if(count($datas['locations']) > 0)

 
    
   
    <div class="row cm10-row">
      <div class="col-12">
          <div id="map_canvas" style="height: 400px; width: 100%;"></div>
      </div>
    </div>
   
    
 

<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyD72DVMbMzjPBwABjd1F2MV8s7VQplAQbs&v=3&libraries=panoramio&language=ne&region=NP"></script>


   <script type="text/javascript">
    var locations = [
    @foreach($datas['locations'] as $location)
      ['{{$location["marker"]}}', {{$location["lat"]}}, {{$location["lng"]}}, '{{$location["title"]}}'],
      @endforeach
    ];

    var map = new google.maps.Map(document.getElementById('map_canvas'), {
      zoom: 8,
      center: new google.maps.LatLng(27.690604,85.329743),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var infoWindowContent = [
    @foreach($datas['locations'] as $location)
        ["{!! $location["infowindow_content"] !!}"],
        @endforeach
        
    ];

    var infowindow = new google.maps.InfoWindow(),marker, i;

    

    for (i = 0; i < locations.length; i++) { 
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: locations[i][0],
        title: locations[i][3]
        

      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(infoWindowContent[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
 
@endif