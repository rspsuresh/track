<?php

namespace app\controllers;

use app\models\TUser;
use app\models\User;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate(){
        if(\Yii::$app->request->isAjax && !empty($_POST)){
            $user=$this->saveandupdate($_POST);
            return $this->asJson($user);
        }else{
            return $this->render('create');
        }

    }
    public function saveandupdate($data){
        if(!empty($data)){
            $userid=$data['userid'];
            if(!empty($userid)){
                $UserModel=User::findOne($userid);
            }else {
                $UserModel = new User();
            }
                $UserModel->email=$data['email'];
                $UserModel->mobile=$data['mobilenumber'];
                $UserModel->username=$data['username'];
                $UserModel->age=$data['age'];
                $UserModel->gender=$data['gender'];
                $UserModel->device=$data['device'];
                $UserModel->address=$data['address'];
                $UserModel->user_status="A";
                $UserModel->user_type="U";
                $UserModel->password=$data['password'];
                $UserModel->user_createdat=date('Y-m-d H:i:s');
            if($UserModel->save(false)){
                $returnArr=['flag'=>'S','code'=>'200'];
            }else{
                $returnArr=['flag'=>'E','code'=>500];
            }
           return  $returnArr;
        }
    }

}
