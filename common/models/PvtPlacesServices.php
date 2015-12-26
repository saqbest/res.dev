<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mr_pvt_places_services".
 *
 * @property string $id
 * @property string $place_id
 * @property string $service_id
 *
 * @property MrPlaces $place
 * @property MrServices $service
 */
class PvtPlacesServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mr_pvt_places_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_id', 'service_id'], 'required'],
            [['place_id', 'service_id'], 'integer']
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
            'service_id' => 'Service ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(MrPlaces::className(), ['id' => 'place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(MrServices::className(), ['id' => 'service_id']);
    }
}
