<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <?php
            if(isset($_SESSION) && isset($_SESSION['userid']) ){
                $user=\app\models\TUser::findOne($_SESSION['userid']);
            }
            ?>
            <div class="pull-left image">
                <img onerror="this.onerror=null;this.src='<?=Yii::$app->request->baseUrl?>/assets/default.jpg';"
                     src="<?=Yii::$app->request->baseUrl?>/assets/uploads/<?=$user->user_profile?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=$_SESSION['username']?></p>
                <a href="#">Role: <?=($_SESSION['usertype']=="A")?"Admin":"User"?></a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                    <?php if(isset($_SESSION) && $_SESSION['usertype'] =='A') { ?>
                        <li><a href="<?=Yii::$app->urlManager->createUrl('dashboard/userlist')?>"><i class="fa fa-circle-o"></i>
                                Manager Users</a></li>
                        <li><a href="<?=Yii::$app->urlManager->createUrl('dashboard/create')?>"><i class="fa fa-circle-o"></i>
                                Create User</a></li>
                        <li><a href="<?=Yii::$app->urlManager->createUrl('dashboard/cloud')?>"><i class="fa fa-circle-o"></i>
                                Cloundinary</a></li>
                        <li><a href="<?=Yii::$app->urlManager->createUrl('dashboard/reslist')?>"><i class="fa fa-circle-o"></i>
                                Cloundinary Manage</a></li>
                    <?php } ?>
                    <li><a href="<?=Yii::$app->urlManager->createUrl('dashboard/index')?>"><i class="fa fa-circle-o"></i>
                            Location Request</a></li>
                    <li><a href="<?=Yii::$app->urlManager->createUrl('dashboard/engine')?>"><i class="fa fa-circle-o"></i>
                            Engine On/Off</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
