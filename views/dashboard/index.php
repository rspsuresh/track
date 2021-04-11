<!-- Main content -->
<?php
  $channelapi=$_SESSION['channelapi'];
  $channelid=$_SESSION['channelid'];
  $locationRequest="https://api.thingspeak.com/update?api_key=".$channelapi."&field3=3";
  $locationRequestReceive="https://api.thingspeak.com/channels/".$channelid."/fields/3.json?results=1";
?>
<link rel="stylesheet" href="<?=\Yii::getAlias('@web');?>/dist/assets/card.css">
<style>
    .section-blur {
        -webkit-filter: blur(5px);
        -moz-filter: blur(5px);
        -o-filter: blur(5px);
        -ms-filter: blur(5px);
        filter: blur(10px);
        pointer-events: none;
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
</style>
<title>Tracking Management</title>
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
            <div class="col-lg-5 card m-r-10" >
                <img class="card-img-top" height="324px"
                     src="<?=Yii::$app->request->baseUrl?>/dist/assets/lockationrequest.png"
                     alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Track Vehicle Location</h4>
                    <p class="card-text">Now you have access to the live location of your vehicles.Know it by clicking </p>
                    <a   onclick="locationrequest('<?=$locationRequest?>')" class="btn btn-primary">
                        Track Vehicle</a>
                </div>
            </div>
            <div class="col-lg-5 card m-r-10 section-blur" id="receiverequest">
                <img class="card-img-top"
                     src="<?=Yii::$app->request->baseUrl?>/dist/assets/reponse.jpg"
                     alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Direction locator</h4>
                    <p class="card-text">We are here to guide you and help you reach your destination.Click on Route Map to know the directions!</p>
                    <a   onclick="locationrequestreceive('<?= $locationRequestReceive?>')"
                         class="btn btn-primary">Route Map</a>
                </div>
            </div>
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script type="text/javascript">
    var lat='';
    var long='';
    $("#receiverequest").css({
        pointerEvents: 'none'
    });
    function locationrequest(paramsurl){
        $.ajax({
            url: paramsurl,
            type: "get",
            success: function (result) {
                swal("Success", "Successfully Requested", "success");
                setTimeout(()=>{
                    $("#receiverequest").css({
                        pointerEvents: 'auto'
                    });
                    $("#receiverequest").removeClass('section-blur');
                },2000)
            }
        })
        }
    function locationrequestreceive(url){
        $.ajax({
            url: '<?=Yii::$app->urlManager->createUrl('dashboard/savetracker')?>?requesturl='+url,
            type: "get",
            success: function (result) {
                let parSECDE=JSON.parse(result);
                console.log(parSECDE);
                let firstLevel=JSON.parse(parSECDE.data);
                let secondLevel=JSON.parse(firstLevel);
                let lngLnSplit=secondLevel.feeds[0].field3?secondLevel.feeds[0].field3.split(','):[13,80];
                if(secondLevel.feeds[0].field3 !=3){
                   window.open('<?=Yii::$app->urlManager->createUrl('dashboard/mapshow')?>?lat='+lngLnSplit[0]+'&lng='+lngLnSplit[1], '_blank');
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