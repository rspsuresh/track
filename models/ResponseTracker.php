<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "response_tracker".
 *
 * @property int $id
 * @property string $response_text
 * @property string $response_createdon
 * @property int $response_created_by
 */
class ResponseTracker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'response_tracker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['response_text', 'response_createdon', 'response_created_by'], 'required'],
            [['response_text'], 'string'],
            [['response_createdon'], 'safe'],
            [['response_created_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'response_text' => 'Response Text',
            'response_createdon' => 'Response Createdon',
            'response_created_by' => 'Response Created By',
        ];
    }
}
