<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mr_places".
 *
 * @property string $id
 * @property string $name
 * @property string $category_id
 * @property string $user_id
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $price_from
 * @property string $price_to
 * @property string $slug
 *
 * @property Maps[] $mrMaps
 * @property Phones[] $mrPhones
 * @property Photos[] $mrPhotos
 * @property Categories $category
 * @property Users $user
 * @property PvtPlacesKitchens[] $mrPvtPlacesKitchens
 * @property PvtPlacesMetros[] $mrPvtPlacesMetros
 * @property PvtPlacesServices[] $mrPvtPlacesServices
 */
class Places extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'name',
                'out_attribute' => 'slug',
                'translit' => true
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mr_places';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'category_id', 'user_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'price_from', 'price_to', 'slug'], 'required'],
            [['category_id', 'user_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['price_from', 'price_to'], 'number'],
            [['name', 'slug'], 'string', 'max' => 254]
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
            'category_id' => 'Category ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'price_from' => 'Price From',
            'price_to' => 'Price To',
            'slug' => 'Slug',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrMaps()
    {
        return $this->hasMany(Maps::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrPhones()
    {
        return $this->hasMany(Phones::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrPhotos()
    {
        return $this->hasMany(Photos::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'user_id']);
    }
//    public  function getKitchens(){
//        return $this->hasMany(Kitchens::className(),['id'=>'kitchen_id'])
//            ->via('mrPvtPlacesKitchens');
//
//    }
    public  function getKitchens(){
        return $this->hasMany(Kitchens::className(),['id'=>'kitchen_id'])
            ->viaTable('mr_pvt_places_kitchens', ['place_id' => 'id']);

  }
// public  function getKitchens(){
//        return $this->hasOne(Kitchens::className(),['id'=>'kitchen_id'])
//            ->viaTable('mr_pvt_places_kitchens', ['place_id' => 'id']);
//
//    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrPvtPlacesKitchens()
    {
        return $this->hasMany(PvtPlacesKitchens::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrPvtPlacesMetros()
    {
        return $this->hasMany(PvtPlacesMetros::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMrPvtPlacesServices()
    {
        return $this->hasMany(PvtPlacesServices::className(), ['place_id' => 'id']);
    }
}
