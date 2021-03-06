<link rel="stylesheet" href="<?=\Yii::getAlias('@web');?>/dist/assets/dataTables.bootstrap.min.css">
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
                        <th>S.No</th>
                        <th>Resource Link</th>
                        <th>Resource Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                   <?php foreach ($resultarr as $key =>$rowval) { ?>
                     <tr>
                       <td><?=$key+1?></td>
                       <td><img class="img-circle" width="100" height="100"  src="<?=$rowval['url']?>" onclick="window.open('<?=$rowval['url']?>')" target="_blank"></a></td>
                       <td><?=$rowval['type']?></td>
                       <td>
                           <?php
                           if(!empty($rowval['name'][1])) { ?>
                           <a onclick="deleteclodinary('<?=$rowval['name'][1]?>')">Delete</a>
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
               url: '<?=Yii::$app->urlManager->createUrl('dashboard/clouddelete')?>?id='+ref,
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
</script>