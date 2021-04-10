<title>AI-Map</title>
<section class="content">
    <a href="#" class="btn btn-primary " id="directionMap" target="_blank"
       style="display:none;float:right;margin-bottom: 10px ">open in gmap</a>
    <div class="row" >
        <div id="map">

        </div>
    </div>
</section>
<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<script type="text/javascript">
    $(function (){
        $.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyB6jDIrWc2mVd0jqBCgJA4R0VfcM7SEJ7Q&callback=initMap&libraries=&v=weekly", function() {
        });
    })
    function initMap() {
       const myLatLng = { lat: <?=$_GET['lat']?>, lng: <?=$_GET['lng']?>};
      //  const myLatLng = { lat: lat, lng: long};
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 10,
            center: myLatLng,
        });
        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "Location Picker",
        });
        let urladdress='https://maps.googleapis.com/maps/api/geocode/json?latlng=13,80&key=AIzaSyB6jDIrWc2mVd0jqBCgJA4R0VfcM7SEJ7Q';
        $.ajax({
            url: urladdress,
            type: "get",
            success: function (result) {
              console.log(result.results[0].formatted_address,'tsttttttttttttt');
              let pasteUrl='https://www.google.com/maps/dir/'+result.results[0].formatted_address;
              $("#directionMap").attr('href',pasteUrl);
                $("#directionMap").show();
            }
        })
    }
</script>
