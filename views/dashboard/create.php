<style>
    .error{
        color:red;
    }
    #map {
        height: 400px;
        width: 100%;
    }
</style>
<button onclick="checkwithclick()">click me</button>
<section class="content">
    <div class="row">
        <div class="col-md-8">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Create Users</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" id="register" name="register" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" required class="form-control" id="username" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" required class="form-control" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mobile Number</label>
                            <div class="col-sm-10">
                                <input required type="text" maxlength="12" name="mobilenumber" class="form-control" id="mobilenumber" placeholder="Mobile number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Gender</label>
                            <div class="col-sm-10">
                                <select  name="gender" id="gender" class="form-control" required>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Age</label>
                            <div class="col-sm-10">
                                <input type="text" required class="form-control" id="age" name="age" placeholder="Age">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Mail Id</label>
                            <div class="col-sm-10">
                                <input type="email" required class="form-control" name="email" id="email" placeholder="Mail Id">
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
                        <input type="hidden" id="userid" name="userid">
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="address"></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="reset" class="btn btn-default">Cancel</button>
                        <button type="submit" class="btn btn-info pull-right">Sign in</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script type="text/javascript">
    $("#register").on("submit", function(event) {
        event.preventDefault();
    }).validate({
        rules: {
            username: {required:true,remote:'<?=Yii::$app->urlManager->createUrl('site/checkunique?type=U')?>'},
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
                 remote: "The corresponding email already exists"
            },
            passwrd: "Password cannot be blank",
            age: "Age cannot be blank",
            gender: "Gender cannot be blank",
            device: "Device cannot be blank",
            email: "Email Address cannot be blank",
            mobilenumber: "Mobile Number cannot be blank"
        },
        onkeyup: false,
        onblur: true,
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
                        window.location.href="<?=Yii::$app->urlManager->createUrl(['dashboard/index?flag='])?>"+obj.flag;
                    }else{
                        swal("Error", obj.msg, "Error");
                    }
                }
            });
        }
    });
var latitude_long = "";
function checkwithclick(){
    $.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyB6jDIrWc2mVd0jqBCgJA4R0VfcM7SEJ7Q&callback=initMap&libraries=&v=weekly", function() {
    });
}

</script>