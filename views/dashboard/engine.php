<!-- Main content -->
<?php
use app\models\EngineTracker;
$channelapi=$_SESSION['channelapi'];
$channelid=$_SESSION['channelid'];
$EngineOnReq="https://api.thingspeak.com/update?api_key=".$channelapi."&field2=1";
$EngineOffREq="https://api.thingspeak.com/update?api_key=".$channelapi."&field2=0";
$EngineModel=EngineTracker::find()->where('created_by=:created_by',
    [':created_by'=>$_SESSION['userid']])->asArray()->one();

//echo "<pre>";print_r($EngineModel);die;

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
<title>Vehicle Control Management</title>
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Engine Request</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                    <i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="col-lg-5 card m-r-10 <?=(!empty($EngineModel) && $EngineModel['status'] =="ON")?'section-blur':''?>" >
                <img class="card-img-top" height="324px"
                     src="<?=Yii::$app->request->baseUrl?>/dist/assets/on.jpeg"
                     alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Vehicle Kick start</h4>
                    <p class="card-text">Someone wants to start your vehicle !!
                        Please click on START if you want approve the request.
                        Leave it in STOP mode if you don't want to approve.</p>
                    <a   onclick="OnOffrequest('<?=$EngineOnReq?>','1')" class="btn btn-primary">
                        Start</a>
                </div>
            </div>
            <div class="col-lg-5 card m-r-10 <?=(!empty($EngineModel) &&  $EngineModel['status']=='OFF')?'section-blur':''?>">
                <img class="card-img-top" height="324px"
                     src="<?=Yii::$app->request->baseUrl?>/dist/assets/eff.jpeg"
                     alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Vehicle Kick off </h4>
                    <p class="card-text">If you're not going to use your car and protect its usage from strangers,,please Click on STOP</p>
                    <a   onclick="OnOffrequest('<?= $EngineOffREq?>','0')"
                         class="btn btn-primary">Stop</a>
                </div>
            </div>
        </div>
    </div>
</section>
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