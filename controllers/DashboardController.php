<?php

namespace app\controllers;

use app\models\AuthorizeImg;
use app\models\EngineTracker;
use app\models\ResponseTracker;
use app\models\TUser;
use app\models\User;
use yii\web\UploadedFile;

class DashboardController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreate(){
        if(\Yii::$app->request->isAjax && !empty($_POST)){
            $user=$this->saveandupdate($_POST);
            return json_encode($user);
        }else{
            return $this->render('create');
        }

    }
    public function saveandupdate($data){
        if(!empty($data)){
            $userid=$data['userid'];
            if(!empty($userid)){
                $UserModel=User::findOne($userid);
                $msg='Updated Successfully';
            }else {
                $UserModel = new User();
                $msg='Updated Successfully';
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
                $returnArr=['flag'=>'S','code'=>'200','msg'=>$msg];
            }else{
                $returnArr=['flag'=>'E','code'=>500,'msg'=>$msg];
            }
            return  $returnArr;
        }
    }

    public function actionSavetracker()
    {
        if (isset($_REQUEST)) {
            $requesturl=$_REQUEST['requesturl'];
            $responseArr = [];
            $REsponseModel = new ResponseTracker();
            $REsponseModel->response_text = $this->Curlexe($requesturl);
            $REsponseModel->response_createdon = date('Y-m-d');
            $REsponseModel->response_created_by = $_SESSION['userid'];
            if ($REsponseModel->save(false)) {
                $responseArr = ['flag' => 'S', 'Code' => '200', 'msg' => 'Response Tracked Successfully', 'data' => json_encode($REsponseModel->response_text)];
            } else {
                $responseArr = ['flag' => 'E', 'Code' => '500', 'msg' => 'Response Tracked Failed', 'data' => json_encode($REsponseModel->response_text)];
            }
            return json_encode($responseArr);
        }
    }

    public function Curlexe($url){
        // init curl object
        $ch = curl_init();
// define options
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
// apply those options
        curl_setopt_array($ch, $optArray);
// execute request and get response
        $result = curl_exec($ch);

        return $result;
    }

    public function actionEngine()
    {
        $reTEngineArr=[];
        if(isset($_REQUEST) && isset($_REQUEST['status'])){
             $EngineModel=EngineTracker::find()->where('device_id=:device',[':device'=>1])->one();
             if(empty($EngineModel)){
                 $EngineModel=new EngineTracker();
             }
            $EngineModel->status=$_REQUEST['status']==1?'ON':'OFF';
            $EngineModel->created_at=date("Y-m-d H:i:s");
            $EngineModel->created_by=$_SESSION['userid'];
            $EngineModel->device_id=1;
            $onOROFF=$_REQUEST['status']==1?'ON':'OFF';
            if($EngineModel->save(false)){
                $reTEngineArr=['flag'=>'S','Code'=>200,'msg'=>"Engine {$onOROFF} Successfully" ];
            }else{
                $reTEngineArr=['flag'=>'E','Code'=>500,'msg'=>"Something Went Wrong" ];
            }
            return  json_encode($reTEngineArr);
        }else{
            return $this->render('engine');
        }
    }

    public function actionCloud(){
        if(isset(\Yii::$app->request->isPost) && $_FILES){
            $file=UploadedFile::getInstance($model, 'picture');
            //$test=\Cloudinary\Uploader::upload($file->tempName, array("public_id" => "authorizedimage/".rand(1,1000)));
            $test=\Cloudinary\Uploader::upload($file->tempName, array("public_id" => "authorizedimage/".rand(1,1000)));
        }else {
            return $this->render('cloud',['model'=>$model,'resultarr'=>$resultArray]);
        }
    }

    public function actionReslist(){
        $resultArray=[];
        $model=new AuthorizeImg();
        $api = new \Cloudinary\Api();
        $result = $api->resource('',array("prefix" => "authorizedimage"));
        foreach ($result['resources'] as $key=>$val){
            $publicId=explode('/',$val['public_id']);
            $resultArray[$key]['url']=$val['secure_url'];
            $resultArray[$key]['type']=$publicId[0];
        }
        return $this->render('resgrid',['resultarr'=>$resultArray]);
    }
}
