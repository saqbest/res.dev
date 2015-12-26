<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mr_metros".
 *
 * @property string $id
 * @property string $name
 * @property integer $status
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 *
 * @property MrPvtPlacesMetros[] $mrPvtPlacesMetros
 */
class Metros extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mr_metros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
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
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrPvtPlacesMetros()
    {
        return $this->hasMany(MrPvtPlacesMetros::className(), ['metro_id' => 'id']);
    }
}
