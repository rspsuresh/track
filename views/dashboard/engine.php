<!-- Main content -->
<?php

use app\models\EngineTracker;

$channelapi=$_SESSION['channelapi'];
$channelid=$_SESSION['channelid'];
$EngineOnReq="https://api.thingspeak.com/update?api_key=".$channelapi."&field2=1";
$EngineOffREq="https://api.thingspeak.com/update?api_key=".$channelapi."&field2=0";
$EngineModel=EngineTracker::find()->where('created_by=:created_by',[':created_by'=>$_SESSION['userid']])->one();
?>
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
            <?php if($EngineModel->status=="ON" || empty($EngineModel)) { ?>
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