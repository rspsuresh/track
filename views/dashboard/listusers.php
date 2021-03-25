<link rel="stylesheet" href="<?=\Yii::getAlias('@web');?>/dist/assets/dataTables.bootstrap.min.css">
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    .float-rightwithclass {
        float: right;
        margin-right: 10px;
</style>
<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">User List</h3>
            </div>
            <div class="float-rightwithclass">
                <a href="<?=Yii::$app->urlManager->createUrl('dashboard/create')?>"   class="btn btn-primary">
                Create User</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="usertable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Device</th>
                        <th>Engine on/off</th>
                        <th>Location Request</th>
                        <th>Status</th>
                    </tr>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($resultarr as $key =>$rowval) { ?>
                        <tr>
                            <td><?=$key+1?></td>
                            <td><?=$rowval['mobile']?></td>
                            <td><?=$rowval['email']?></td>
                            <td><?=$rowval['gender']?></td>
                            <td><?=$rowval['age']?></td>
                            <td><?=$rowval['device']?></td>
                            <td>
                                <?php
                                  $DeviceMaster=\app\models\DeviceMaster::findOne($rowval['device']);
                                $channelapi=$DeviceMaster->channel_api;
                                $channelid=$DeviceMaster->channel_id;
                                $EngineOnReq="https://api.thingspeak.com/update?api_key=".$channelapi."&field2=1";
                                $EngineOffREq="https://api.thingspeak.com/update?api_key=".$channelapi."&field2=0";
                                $EngineModel=\app\models\EngineTracker::find()->where('created_by=:created_by',[':created_by'=>$rowval['u_id']])->one();
                                ?>
                                <label class="switch">
                                    <input type="checkbox"
                                        <?=(!isset($EngineModel->status) || $EngineModel->status=='OFF' || empty($EngineModel))?'checked':''?>
                                           onchange="engineonoff(event,'<?=$rowval['device']?>')">
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                jhkjhkjh
                            </td>
                            <td>
                                    <label class="switch">
                                        <input type="checkbox"
                                            <?=$rowval['user_status']=="A"?'checked':''?>
                                               onchange="statuschange('<?=$rowval['u_id']?>',event)">
                                        <span class="slider round"></span>
                                    </label>
                                <?php if($rowval['user_status'] =='A') { ?>
                                    <button  onclick="sendmail('<?=$rowval['u_id']?>')" class="btn btn-info pull-right">Mail</button>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<script src="<?=\Yii::getAlias('@web');?>/dist/assets/jquery.dataTables.min.js"></script>
<script src="<?=\Yii::getAlias('@web');?>/dist/assets/dataTables.bootstrap.min.js"></script>
<script>
    $(function () {
        $('#usertable').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
    function statuschange(id,event){
        $.ajax({
            type: 'GET',
            url: '<?=Yii::$app->urlManager->createUrl('dashboard/changestatus')?>?id='+id,
            success:function(data){
                var obj = JSON.parse(data);
                if (obj.flag === "S") {
                    swal("Success", obj.msg, "success");
                }else{
                    swal("Error", obj.msg, "Error");
                }
            }
        });
    }
    function sendmail(user){
        $.ajax({
            type: 'GET',
            url: '<?=Yii::$app->urlManager->createUrl('dashboard/sendmail')?>?id='+user,
            success:function(data){
                var obj = JSON.parse(data);
                if (obj.flag === "S") {
                    swal("Success", obj.msg, "success");
                }else{
                    swal("Error", obj.msg, "error");
                }
            }
        });
    }
    function engineonoff(event,device){

    }
</script>
