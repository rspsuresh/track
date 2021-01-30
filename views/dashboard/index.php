<!-- Main content -->
<?php
  $channelapi=$_SESSION['channelapi'];
  $channelid=$_SESSION['channelid'];
  $locationRequest="https://api.thingspeak.com/update?api_key=".$channelapi."&field3=3";
  $locationRequestReceive="https://api.thingspeak.com/channels/".$channelid."/fields/3.json?results=1";
?>
<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Request to IOT</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="col-md-3 col-sm-6 col-xs-12" onclick="locationrequest('<?=$locationRequest?>')">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-location"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="margin-top: 30px">Location Request</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12" id="receiverequest"
                 onclick="locationrequestreceive('<?= $locationRequestReceive?>')">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-location-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="margin-top: 30px">Receive Response</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box -->
    <div class="box" id="map" style="display: none">

    </div>
</section>
<!-- /.content -->
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script type="text/javascript">
    var lat='';
    var long='';
    function locationrequest(paramsurl){
        window.open(paramsurl, '_blank');
        swal("Success", "Successfully Requested", "success");
        setTimeout(()=>{
            $("#receiverequest").show();
        },500)
    }
    function locationrequestreceive(url){
        $.ajax({
            url: '<?=Yii::$app->urlManager->createUrl('dashboard/savetracker')?>?requesturl='+url,
            type: "get",
            success: function (result) {
                var channelArr=Object.values(result);
                let ltln=channelArr[1][0].field3;
                if (obj.flag === "S" ) {
                    swal("Success", obj.msg, "success");
                    if(ltln.input(',')){
                        $("#map").show();
                        let seprateLtLN=ltln.split(',');
                        lat=seprateLtLN[0];
                        long=seprateLtLN[1];
                        console.log(lat,long,'sdfdsfsdfds')
                        $.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyB6jDIrWc2mVd0jqBCgJA4R0VfcM7SEJ7Q&callback=initMap&libraries=&v=weekly", function() {
                        });
                    }

                }else{
                    swal("Error", obj.msg, "Error");
                }
            }
        });
    }
    function initMap() {
        //const myLatLng = { lat: 13.082, lng: 80.2707};
        const myLatLng = { lat: lat, lng: long};
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