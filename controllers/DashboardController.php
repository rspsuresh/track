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
            $User=new User();
            if(isset($_GET['id'])){
                $userid=intval($_GET['id']);
                $User=User::findOne($userid);
            }
            return $this->render('create',['user'=>$User]);
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
                $msg='Created Successfully';
                $UsernameCheck=User::find()->where('username=:usrname',[':usrname'=>$_POST['username']])->one();
                if(!empty($UsernameCheck)){
                    $returnArr=['flag'=>'E','code'=>500,'msg'=>'Username already exists'];
                    return  $returnArr;
                }
                $UsernameMail=User::find()->where('email=:email',[':email'=>$_POST['email']])->one();
                if(!empty($UsernameMail)){
                    $returnArr=['flag'=>'E','code'=>500,'msg'=>'Email already exists'];
                    return  $returnArr;
                }
                $UsernameMobile=User::find()->where('mobile=:mobile',[':mobile'=>$_POST['mobilenumber']])->one();
                if(!empty($UsernameMobile)){
                    $returnArr=['flag'=>'E','code'=>500,'msg'=>'Mobile already exists'];
                    return  $returnArr;
                }
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
            if(isset($_FILES)){
                $target_dir = "assets/uploads/";
                $target_file = $target_dir . basename($_FILES["profile"]["name"]);
                move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file);
                $UserModel->user_profile=$_FILES["profile"]["name"];
            }
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
    public function actionClouddelete(){
        \Cloudinary::config(array(
            'cloud_name' => 'project301220',
            'api_key' => '138435171694115',
            'api_secret' => 'ZUpVJ3PPWazj4hO3NDm7pyKXM4o',
        ));
        if(isset($_GET['id'])){
            $api = new \Cloudinary\Api();
            $api->delete_resources(['authorizedimage/'.$_GET['id']], $options = array());
            $reTEngineArr=['flag'=>'S','Code'=>200,'msg'=>"Deleted Successfully" ];
        }
        return  json_encode($reTEngineArr);
    }
    public function actionCloud(){
        $model=new AuthorizeImg();
        if(isset(\Yii::$app->request->isPost) && $_FILES){
            $file=UploadedFile::getInstance($model, 'picture');
            $publicId='authorizedimage-'.rand(1,1000);
            $AuthModel=new  \app\models\AuthorizeImg;
            $AuthModel->picture=$publicId;
            $AuthModel->created_by=$_SESSION['userid'];
            $AuthModel->save();

            \Cloudinary\Uploader::upload($file->tempName, array("folder" => "authorizedimage/","public_id" =>$publicId ));

        }
        return $this->render('cloud',['model'=>$model]);
        //  }
    }

    public function actionReslist(){
        $resultArray=[];
        $model=new AuthorizeImg();
        $api = new \Cloudinary\Api();
        $result = $api->resource('',["type" => "upload", "max_results" => 5000]);
        foreach ($result['resources'] as $key=>$val){
            $publicId=explode('/',$val['public_id']);
            $resultArray[$key]['url']=$val['secure_url'];
            $resultArray[$key]['type']=$publicId[0];
            if($publicId[0] =='authorizedimage'){
                $resultArray[$key]['name']=$publicId;
            }
        }
        //    echo "<pre>";print_r($resultArray);die;
        return $this->render('resgrid',['resultarr'=>$resultArray]);
    }

    public function actionUserlist(){
        $UserModel=User::find()->where('user_type=:type',[':type'=>'U'])->asArray()->all();
        return $this->render('listusers',['resultarr'=>$UserModel]);
    }
    public function actionChangestatus(){
        $filterId=intval($_GET['id']);
        $UserModel=User::findOne($filterId);
        $UserModel->user_status=$UserModel->user_status=='A'?'I':'A';
        if($UserModel->save(false)){
            $reTEngineArr=['flag'=>'S','Code'=>200,'msg'=>"Status Changed Successfully" ];
        }else{
            $reTEngineArr=['flag'=>'E','Code'=>500,'msg'=>"Something Went Wrong" ];
        }
        return  json_encode($reTEngineArr);
    }

    public function actionSendmail(){
        $filterId=intval($_GET['id']);
        $UserModel=User::findOne($filterId);
        $to = 'rsprampaul14321@gmail.com';
        $subject = 'Password Invite';
        $from = 'peterparker@email.com';
// To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();

// Sending email
        $message= $content=\Yii::$app->controller->renderPartial('passwordinvite',['usermodel'=>$UserModel],false,true);
        if(mail($to, $subject, $message, $headers)){
            $reTEngineArr=['flag'=>'S','Code'=>200,'msg'=>"Mail Send Successfully"];
        } else{
            $reTEngineArr=['flag'=>'E','Code'=>200,'msg'=>"Error in mail send" ];
        }
        return  json_encode($reTEngineArr);
    }
    public function actionMapshow(){
        return $this->render('map');
    }
}
