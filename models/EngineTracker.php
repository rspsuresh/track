<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "engine_tracker".
 *
 * @property int $id
 * @property int $device_id
 * @property string $status
 * @property string $created_at
 * @property int $created_by
 */
class EngineTracker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'engine_tracker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'device_id', 'status', 'created_at', 'created_by'], 'required'],
            [['id', 'device_id', 'created_by'], 'integer'],
            [['status'], 'string'],
            [['created_at'], 'safe'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'device_id' => 'Device ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}
