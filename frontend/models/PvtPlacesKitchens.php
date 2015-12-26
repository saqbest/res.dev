<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mr_pvt_places_kitchens".
 *
 * @property string $id
 * @property string $place_id
 * @property string $kitchen_id
 *
 * @property MrKitchens $kitchen
 * @property MrPlaces $place
 */
class PvtPlacesKitchens extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mr_pvt_places_kitchens';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'kitchen_id'], 'required'],
            [['place_id', 'kitchen_id'], 'integer']
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
            'kitchen_id' => 'Kitchen ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKitchen()
    {
        return $this->hasOne(Kitchens::className(), ['id' => 'kitchen_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(MrPlaces::className(), ['id' => 'place_id']);
    }
}
