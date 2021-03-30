<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tracking  App | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?=\Yii::getAlias('@web');?>/dist/assets/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=\Yii::getAlias('@web');?>/dist/assets/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=\Yii::getAlias('@web');?>/dist/assets/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=\Yii::getAlias('@web');?>/dist/assets/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?=\Yii::getAlias('@web');?>/dist/assets/iCheck/square/blue.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style>
    .backgroundFortrack{
        background-image: url('<?=\Yii::getAlias('@web');?>/dist/assets/bg/track.jpg');
        background-repeat: no-repeat;
        background-position:center center;
        background-size:cover
    }
    .error{
        color:red;
    }
</style>
<body class="hold-transition login-page backgroundFortrack">
<div class="login-box">
    <div class="login-logo">
        <a href="#0"><b style="color: black !important;">AI Smart Tracking</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <div id="loginformdiv">
            <b><p class="login-box-msg">Sign in to start your session</p></b>
            <form  id="loginform" name="loginform" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username"
                           placeholder="Email" required>
                    <!--                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>-->
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password"
                           placeholder="Password" required>
                    <!--                <span class="glyphicon glyphicon-lock form-control-feedback"></span>-->
                </div>
                <div id="incorrect" class="error" style="display: none"><p class="text-center" >Incorrect Username and Password</p></div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-offset-8 col-xs-4">
                        <button  class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <a style="cursor: pointer" onclick="forgotpasswordsection()">I forgot my password</a>
        </div>
        <div id="forgotpassworddiv" style="display:none">
            <b> <p class="login-box-msg">Forgot password</p></b>
            <form  id="forgotpassword" name="forgotpassword" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username"
                           placeholder="Email" required>
                </div>
                <div class="row">
                    <div class="col-xs-offset-8 col-xs-4">
                        <button  class="btn btn-primary btn-block btn-flat">Submit</button>
                    </div>
                </div>
            </form>
            <a style="cursor: pointer" onclick="backtologin()">Back to Login</a>
        </div>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3 -->
<!--<script src="--><?//=\Yii::getAlias('@web');?><!--/dist/assets/jquery/dist/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=\Yii::getAlias('@web');?>/dist/assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=\Yii::getAlias('@web');?>/dist/assets/iCheck/icheck.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script type="text/javascript">
    $("#loginform").on("submit", function(event) {
        event.preventDefault();
    }).validate({
        rules: {
            username: "required",
            password: "required"
        },
        messages: {
            username: "Please enter your username",
            password: "Please enter your password",
        },
        submitHandler: function(form,event) {
            event.preventDefault();
            var formData = new FormData($('#loginform')[0]);
            var url='<?=Yii::$app->urlManager->createUrl(['site/login'])?>'
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
                        window.location.href="<?=Yii::$app->urlManager->createUrl(['dashboard/index'])?>";
                    }else{

                       $("#incorrect").show();
                    }
                }
            });
            return false;
        }
    });
    function forgotpasswordsection(){
        $("#loginformdiv").hide();
        $("#forgotpassworddiv").show();
    }
    function backtologin(){
        $("#loginformdiv").show();
        $("#forgotpassworddiv").hide();
    }
</script>
</body>
</html>
