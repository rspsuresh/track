<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authorize_img".
 *
 * @property int $id
 * @property string $asset_id
 * @property int $created_by
 * @property string|null $created_on
 * @property string $public_id
 * @property string $auth_img
 * @property string $img_url
 */
class AuthorizeImg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authorize_img';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asset_id', 'created_by', 'public_id', 'auth_img', 'img_url'], 'required'],
            [['created_by'], 'integer'],
            [['created_on'], 'safe'],
            [['asset_id'], 'string', 'max' => 250],
            [['public_id', 'auth_img', 'img_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asset_id' => 'Asset ID',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'public_id' => 'Public ID',
            'auth_img' => 'Auth Img',
            'img_url' => 'Img Url',
        ];
    }
}
