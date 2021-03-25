<section class="content">
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
    }
</script>
