<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "device_master".
 *
 * @property int $id
 * @property string $channel_api
 * @property string $channel_id
 * @property string|null $vehicle_model
 * @property string|null $vehicle_reg_no
 * @property string $created_at
 * @property string $channel_status
 */
class DeviceMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'device_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['channel_api', 'channel_id', 'created_at', 'channel_status'], 'required'],
            [['created_at'], 'safe'],
            [['channel_status'], 'string'],
            [['channel_api', 'channel_id'], 'string', 'max' => 255],
            [['vehicle_model'], 'string', 'max' => 150],
            [['vehicle_reg_no'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'channel_api' => 'Channel Api',
            'channel_id' => 'Channel ID',
            'vehicle_model' => 'Vehicle Model',
            'vehicle_reg_no' => 'Vehicle Reg No',
            'created_at' => 'Created At',
            'channel_status' => 'Channel Status',
        ];
    }
}
