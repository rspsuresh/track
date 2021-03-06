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
 * @property string|null $gender
 * @property int|null $age
 * @property string|null $address
 * @property string $password
 * @property int|null $device
 * @property string $user_status
 * @property string $user_type
 * @property string|null $user_createdat
 */
class User extends \yii\db\ActiveRecord
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
            [['gender', 'address', 'user_status', 'user_type','user_profile'], 'string'],
            [['age', 'device'], 'integer'],
            [['user_createdat','profile','user_profile'], 'safe'],
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
            'gender' => 'Gender',
            'age' => 'Age',
            'address' => 'Address',
            'password' => 'Password',
            'device' => 'Device',
            'user_status' => 'User Status',
            'user_type' => 'User Type',
            'user_createdat' => 'User Createdat',
        ];
    }
}
