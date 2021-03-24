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
            <div class="col-lg-5 card m-r-10 <?=($EngineModel->status =="ON" || empty($EngineModel))?'section-blur':''?>" >
                <img class="card-img-top" height="324px"
                     src="<?=Yii::$app->request->baseUrl?>/dist/assets/lockationrequest.png"
                     alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title"> Engine on Request</h4>
                    <p class="card-text">Some example text some example text.
                        John Doe is an architect and engineer</p>
                    <a   onclick="OnOffrequest('<?=$EngineOnReq?>','1')" class="btn btn-primary">
                        Engine on</a>
                </div>
            </div>
            <div class="col-lg-5 card m-r-10 <?=($EngineModel->status=='OFF' || empty($EngineModel))?'section-blur':''?>">
                <img class="card-img-top"
                     src="<?=Yii::$app->request->baseUrl?>/dist/assets/reponse.jpg"
                     alt="Card image" style="width:100%">
                <div class="card-body">
                    <h4 class="card-title"> Engine off request</h4>
                    <p class="card-text">Some example text some example text.
                        John Doe is an architect and engineer</p>
                    <a   onclick="OnOffrequest('<?= $EngineOffREq?>','0')"
                         class="btn btn-primary">Engine Off</a>
                </div>
            </div>
        </div>
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