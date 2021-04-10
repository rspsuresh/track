<link rel="stylesheet" href="<?=\Yii::getAlias('@web');?>/dist/assets/dataTables.bootstrap.min.css">
<title>AI-Activity Log</title>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Resource List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>S.no</th>
                        <th>App Name</th>
                        <th>Public Id</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                   <?php foreach ($resultarr as $key =>$rowval) { ?>
                     <tr>
                       <td><?=$key+1?></td>
                         <td>Tracker</td>
                         <td><?=$rowval->auth_img?></td>
                         <td>
                             <button onclick="setimageSrc(this)"
                                     data-src="<?=$rowval->img_url?>"
                                     class="btn btn-primary"
                                     data-toggle="modal"
                                     data-target="#exampleModal">View</button>
                             <button class="btn btn-danger"
                                     onclick="deleteclodinary('<?=$rowval->public_id?>')">
                                 Delete</button>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Image</h5>
            </div>
            <div class="modal-body">
                <img id="popupsrc"  width="100%" height="200" src="<?=Yii::$app->request->baseUrl?>/assets/default.jpg">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?=\Yii::getAlias('@web');?>/dist/assets/jquery.dataTables.min.js"></script>
<script src="<?=\Yii::getAlias('@web');?>/dist/assets/dataTables.bootstrap.min.js"></script>
<script>
    $(function () {
        $('#example1').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
    function deleteclodinary(ref){
        if(confirm('Are You Sure want to delete?')){
            $.ajax({
                url: '<?=Yii::$app->urlManager->createUrl('dashboard/clouddeletetrack')?>?id='+ref,
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
    }

    function setimageSrc(a){
        //console.log($(a).attr('data-src'))
        $("#popupsrc").attr('src',$(a).attr('data-src'))
    }
</script>