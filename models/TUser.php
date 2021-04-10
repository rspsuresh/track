<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $u_id
 * @property string $username
 * @property string $mobile
 * @property string $email
 * @property string $password
 * @property string $user_status
 * @property string $user_type
 * @property string|null $user_createdat
 */
class TUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'mobile', 'email', 'password', 'user_status', 'user_type'], 'required'],
            [['user_status', 'user_type','user_profile'], 'string'],
            [['user_createdat','user_profile'], 'safe'],
            [['username'], 'string', 'max' => 255],
            [['mobile', 'email'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'u_id' => 'U ID',
            'username' => 'Username',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'password' => 'Password',
            'user_status' => 'User Status',
            'user_type' => 'User Type',
            'user_createdat' => 'User Createdat',
        ];
    }
    public static  function loginCheck($data){
        $Usermodel=self::find()->where('(username=:username or mobile=:username or email=:username) and password=:password and user_status="A"',
            [':username'=>$data['username'],
                ':password'=>$data['password']
            ])->asArray()->one();

        $statusarray=[];
       if(!empty($Usermodel)){
           if(!isset($_SESSION))
           {
               session_start();
           }

           $_SESSION['username']=$Usermodel['username'];
           $_SESSION['userid']=$Usermodel['u_id'];
           $_SESSION['usertype']=$Usermodel['user_type'];
           $device=$Usermodel['device']?$Usermodel['device']:1;
           $DeviceModel=DeviceMaster::findOne($device);
           $_SESSION['channelapi']=$DeviceModel->channel_api;
           $_SESSION['channelid']=$DeviceModel->channel_id;

           $statusarray['flag']="S";
           $statusarray['msg']="login successfully";
       }else{
           $statusarray['flag']="E";
           $statusarray['msg']="Incorrect username and password";
       }
       return $statusarray;
    }

}
