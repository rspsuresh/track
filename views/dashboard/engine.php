<!-- Main content -->
<?php
use app\models\EngineTracker;
$channelapi=$_SESSION['channelapi'];
$channelid=$_SESSION['channelid'];
$EngineOnReq="https://api.thingspeak.com/update?api_key=".$channelapi."&field2=1";
$EngineOffREq="https://api.thingspeak.com/update?api_key=".$channelapi."&field2=0";
$EngineModel=EngineTracker::find()->where('created_by=:created_by',[':created_by'=>$_SESSION['userid']])->one();
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .row.heading h2 {
        color: #fff;
        font-size: 52.52px;
        line-height: 95px;
        font-weight: 400;
        text-align: center;
        margin: 0 0 40px;
        padding-bottom: 20px;
        text-transform: uppercase;
    }
    ul{
        margin:0;
        padding:0;
        list-style:none;
    }
    .heading.heading-icon {
        display: block;
    }
    .padding-lg {
        display: block;
        padding-top: 60px;
        padding-bottom: 60px;
    }
    .practice-area.padding-lg {
        padding-bottom: 55px;
        padding-top: 55px;
    }
    .practice-area .inner{
        border:1px solid #999999;
        text-align:center;
        margin-bottom:28px;
        padding:40px 25px;
    }
    .our-webcoderskull .cnt-block:hover {
        box-shadow: 0px 0px 10px rgba(0,0,0,0.3);
        border: 0;
    }
    .practice-area .inner h3{
        color:#3c3c3c;
        font-size:24px;
        font-weight:500;
        font-family: 'Poppins', sans-serif;
        padding: 10px 0;
    }
    .practice-area .inner p{
        font-size:14px;
        line-height:22px;
        font-weight:400;
    }
    .practice-area .inner img{
        display:inline-block;
    }


    .our-webcoderskull{


    }
    .our-webcoderskull .cnt-block{
        float:left;
        width:100%;
        background:#fff;
        padding:30px 20px;
        text-align:center;
        border:2px solid #d5d5d5;
        margin: 0 0 28px;
    }
    .our-webcoderskull .cnt-block figure{
        width:148px;
        height:148px;
        border-radius:100%;
        display:inline-block;
        margin-bottom: 15px;
    }
    .our-webcoderskull .cnt-block img{
        width:148px;
        height:148px;
        border-radius:100%;
    }
    .our-webcoderskull .cnt-block h3{
        color:#2a2a2a;
        font-size:20px;
        font-weight:500;
        padding:6px 0;
        text-transform:uppercase;
    }
    .our-webcoderskull .cnt-block h3 a{
        text-decoration:none;
        color:#2a2a2a;
    }
    .our-webcoderskull .cnt-block h3 a:hover{
        color:#337ab7;
    }
    .our-webcoderskull .cnt-block p{
        color:#2a2a2a;
        font-size:13px;
        line-height:20px;
        font-weight:400;
    }
    .our-webcoderskull .cnt-block .follow-us{
        margin:20px 0 0;
    }
    .our-webcoderskull .cnt-block .follow-us li{
        display:inline-block;
        width:auto;
        margin:0 5px;
    }
    .our-webcoderskull .cnt-block .follow-us li .fa{
        font-size:24px;
        color:#767676;
    }
    .our-webcoderskull .cnt-block .follow-us li .fa:hover{
        color:#025a8e;
    }

</style>
<section class="our-webcoderskull padding-lg">
    <div class="container">
        <h3 class="box-title text-center">Request to IOT</h3>
<!--        <div class="row heading heading-icon">-->
<!--            <h2 class="box-title">Request Control</h2>-->
<!--        </div>-->
        <ul class="row">
            <?php if($EngineModel->status=='OFF' || empty($EngineModel)) { ?>
            <li class="col-12 col-md-6 col-lg-12">
                <div class="cnt-block equal-hight" style="height: 349px;">
                    <figure><img src="<?=Yii::$app->request->baseUrl?>/assets/pinlocation.jpg" class="img-responsive" alt=""></figure>
                    <h3><a style="cursor: pointer" onclick="OnOffrequest('<?=$EngineOnReq?>','1')">Engine on</a></h3>
                </div>
            </li>
            <?php } ?>
            <?php if($EngineModel->status =="ON" || empty($EngineModel)) { ?>
            <li class="col-12 col-md-6 col-lg-12">
                <div class="cnt-block equal-hight" style="height: 349px;">
                    <figure><img src="<?=Yii::$app->request->baseUrl?>/assets/pinlocation.jpg" class="img-responsive" alt=""></figure>
                    <h3><a style="cursor: pointer" onclick="OnOffrequest('<?= $EngineOffREq?>','0')">Engine Off</a></h3>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</section>

<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Request to IOT</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <?php if($EngineModel->status=='OFF' || empty($EngineModel)) { ?>
                <div class="col-md-3 col-sm-6 col-xs-12" onclick="OnOffrequest('<?=$EngineOnReq?>','1')">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-location"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text" style="margin-top: 30px">Engine On</span>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if($EngineModel->status =="ON" || empty($EngineModel)) { ?>
                <div class="col-md-3 col-sm-6 col-xs-12" id="receiverequest"
                     onclick="OnOffrequest('<?= $EngineOffREq?>','0')">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-location-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text" style="margin-top: 30px">Engine Off</span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- /.content -->
<script type="text/javascript">
    function OnOffrequest(url,status){
        $.ajax({
            url: '<?=Yii::$app->urlManager->createUrl('dashboard/engine')?>?status='+status,
            type: "get",
            success: function (result) {
                var obj = JSON.parse(result);
                if (obj.flag === "S") {
                    swal("Success", obj.msg, "success");
                }else{
                    swal("Error", obj.msg, "Error");
                }
                window.location.reload();
            }
        });
    }
</script>