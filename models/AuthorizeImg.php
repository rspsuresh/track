<?php

namespace app\models;

use nikosid\cloudinary\CloudinaryBehavior;
use Yii;

/**
 * This is the model class for table "authorize_img".
 *
 * @property int $id
 * @property string $picture
 * @property int $created_by
 * @property string $created_on
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
    public function behaviors()
    {
        return [
            'cloudinary' => [
                'class' => CloudinaryBehavior::class,
                'attribute' => 'picture',
                'publicId' => Yii::$app->name . '/authorizedimage/',
                'thumbs' => [
                    'large' => ['secure' => true, 'width' => 848, 'height' => 536, 'crop' => 'fill'],
                    'medium' => ['secure' => true, 'width' => 555, 'height' => 536, 'crop' => 'fill'],
                    'small' => ['secure' => true, 'width' => 130, 'height' => 125, 'crop' => 'fill'],
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['picture', 'created_by', 'created_on'], 'required'],
            [['created_by'], 'integer'],
            [['created_on'], 'safe'],
            ['picture', 'image', 'extensions' => 'jpg, jpeg, gif, png', 'on' => ['insert', 'update']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'picture' => 'Picture',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
        ];
    }
}
