<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mr_kitchens".
 *
 * @property string $id
 * @property string $name
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updtaed_by
 *
 * @property MrPvtPlacesKitchens[] $mrPvtPlacesKitchens
 */
class Kitchens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mr_kitchens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'created_at', 'created_by', 'updated_at', 'updtaed_by'], 'required'],
            [['status', 'created_by', 'updtaed_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 254]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updtaed_by' => 'Updtaed By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrPvtPlacesKitchens()
    {
        return $this->hasMany(MrPvtPlacesKitchens::className(), ['kitchen_id' => 'id']);
    }
}
