<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mr_pvt_places_metros".
 *
 * @property string $id
 * @property string $place_id
 * @property string $metro_id
 *
 * @property MrMetros $metro
 * @property MrPlaces $place
 */
class PvtPlacesMetros extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mr_pvt_places_metros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'metro_id'], 'required'],
            [['place_id', 'metro_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'place_id' => 'Place ID',
            'metro_id' => 'Metro ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMetro()
    {
        return $this->hasOne(MrMetros::className(), ['id' => 'metro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(MrPlaces::className(), ['id' => 'place_id']);
    }
}
