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
    <link rel="stylesheet" href="<?=\Yii::getAlias('@web');?>/dist/assets/parsley.css">
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
</style>
<body class="hold-transition login-page backgroundFortrack">
<div class="login-box">
    <div class="login-logo">
        <a href="#0"><b>Tracking App</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form  id="loginform" method="post" data-parsley-validate="">
            <div class="form-group has-feedback">
                <input type="email" class="form-control" data-parsley-error-message="Email or Username or Mobile Cannot be blank" placeholder="Email" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" data-parsley-error-message="Password Cannot be blank" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-offset-8 col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 3 -->
<script src="<?=\Yii::getAlias('@web');?>/dist/assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=\Yii::getAlias('@web');?>/dist/assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=\Yii::getAlias('@web');?>/dist/assets/iCheck/icheck.min.js"></script>
<script src="<?=\Yii::getAlias('@web');?>/dist/assets/parsley.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });


        $('#loginform').parsley().on('field:validated', function() {
            var ok = $('.parsley-error').length === 0;
            $('.bs-callout-info').toggleClass('hidden', !ok);
            $('.bs-callout-warning').toggleClass('hidden', ok);
            }).on('form:submit', function() {
                console.log('yes');
                return false; // Don't submit form for this demo
            });
    });

</script>
</body>
</html>
