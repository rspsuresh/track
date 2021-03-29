<style>
    .error{
        color:red;
    }
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<?php
$disabledCheck=isset($_GET['id'])?'readonly':'';
$LabelCheck=isset($_GET['id'])?'Update':'Create';
?>
<section class="content">
    <div class="row">
        <div class="col-md-10">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?=$LabelCheck?> Users</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" autocomplete="off" id="register" name="register" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text"
                                       value="<?=$user->username?>"
                                    <?=$disabledCheck?> name="username"
                                       required class="form-control"
                                       id="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" value="<?=$user->password?>" name="password" required class="form-control" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mobile Number</label>
                            <div class="col-sm-10">
                                <input required type="text" value="<?=$user->mobile?>" <?=$disabledCheck?> maxlength="12" name="mobilenumber" class="form-control" id="mobilenumber" placeholder="Mobile number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-10">
                                <select  name="gender" id="gender" class="form-control" required>
                                    <option <?=$user->gender =='M'?'selected':''?> value="M">Male</option>
                                    <option <?=$user->gender =='F'?'selected':''?> value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Age</label>
                            <div class="col-sm-10">
                                <input type="text"  value="<?=$user->age?>" maxlength="2" required class="form-control" id="age" name="age" placeholder="Age">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Mail Id</label>
                            <div class="col-sm-10">
                                <input type="email"value="<?=$user->email?>"  <?=$disabledCheck?> required class="form-control" name="email" id="email" placeholder="Mail Id">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Device</label>
                            <div class="col-sm-10">
                                <select  name="device" id="device" class="form-control" required>
                                    <option value="1">one</option>
                                    <option value="1">two</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" id="userid" name="userid" value="<?=$user->u_id?>">
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <textarea  class="form-control" name="address"><?php echo htmlspecialchars($user->address, ENT_QUOTES, 'UTF-8') ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Profile</label>
                            <div class="col-sm-10">
                                <input type="file" name="profile" accept="image/*">
                                <?php if($user->user_profile) { ?>
                                    <img width=50 height=50 class="img-circle" src="<?=Yii::$app->request->baseUrl?>/assets/uploads/<?=$user->user_profile?>">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button type="submit" id="submit" class="btn btn-info pull-right"><?=$LabelCheck?></button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
<script src="<?=\Yii::getAlias('@web');?>/dist/assets/jquery.validate.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>-->
<script type="text/javascript">
    $("#register").on("submit", function(event) {
        event.preventDefault();
    }).validate({
        rules: {
            username: {
                required:true
            },
            password: "required",
            age: "required",
            gender: "required",
            device: "required",
            email: "required",
            mobilenumber: "required"
        },
        messages: {
            username:{
                required:"Username cannot be blank",
            },
            passwrd: "Password cannot be blank",
            age: "Age cannot be blank",
            gender: "Gender cannot be blank",
            device: "Device cannot be blank",
            email: "Email Address cannot be blank",
            mobilenumber: "Mobile Number cannot be blank"
        },
        submitHandler: function(form,event) {
            event.preventDefault();
            var formData = new FormData($('#register')[0]);
            var url='<?=Yii::$app->urlManager->createUrl(['dashboard/create'])?>'
            $.ajax({
                url: url,
                type: "post",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function (result) {
                    var obj = JSON.parse(result);
                    if (obj.flag === "S") {
                        swal("Success", obj.msg, "success");
                        <?php if($_SESSION['usertype'] =='A') { ?>
                        window.location.href="<?=Yii::$app->urlManager->createUrl(['dashboard/userlist?flag='])?>"+obj.flag;
                        <?php } else { ?>
                        window.location.href="<?=Yii::$app->urlManager->createUrl(['dashboard/index?flag='])?>"+obj.flag;
                        <?php } ?>

                    }else{
                        swal("Error", obj.msg, "error");
                        $("#register")[0].reset();
                    }
                }
            });
        }
    });
</script>