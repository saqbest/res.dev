<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "mr_places".
 *
 * @property string $id
 * @property string $name
 * @property string $description
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
 * @property MrMaps[] $mrMaps
 * @property MrPhones[] $mrPhones
 * @property MrPhotos[] $mrPhotos
 * @property MrCategories $category
 * @property MrUsers $user
 * @property MrPvtPlacesKitchens[] $mrPvtPlacesKitchens
 * @property MrPvtPlacesMetros[] $mrPvtPlacesMetros
 * @property MrPvtPlacesServices[] $mrPvtPlacesServices
 */
class Places extends \yii\db\ActiveRecord
{
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
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4, 'maxSize' => 1024 * 1024 * 2],
//            [['name', 'description', 'category_id', 'user_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'price_from', 'price_to', 'slug'], 'required'],
//            [['description'], 'string'],
//            [['category_id', 'user_id', 'status', 'created_by', 'updated_by'], 'integer'],
//            [['created_at', 'updated_at'], 'safe'],
//            [['price_from', 'price_to'], 'number'],
//            [['name', 'slug'], 'string', 'max' => 254],
//            [['kitchensIds', 'servicesIds', 'metrosIds'], 'safe'],

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
            'description' => 'Description',
            'category_id' => 'Category',
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
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    /////////get kitchens///////////////////
    // declare authorsId property
    public $kitchensIds = [];
    public function getKitchens()
    {
        return $this->hasMany(Kitchens::className(), ['id' => 'kitchen_id'])
            ->via('pvtPlacesKitchens');

    }

    public function getPvtPlacesKitchens()
    {
        return $this->hasMany(PvtPlacesKitchens::className(), ['place_id' => 'id']);
    }



// you need a getter for select2 dropdown
    public function getdropKitchens()
    {
        $data = Kitchens::find()->all();
        return \yii\helpers\ArrayHelper::map($data, 'id', 'name');
    }

// You will need a getter for the current set o Authors in this Book
    public function getKitchensIds()
    {
        $this->kitchensIds = \yii\helpers\ArrayHelper::getColumn(
            $this->getPvtPlacesKitchens()->all(),
            'kitchen_id'
        );
        return $this->kitchensIds;
    }
///////image/////////
    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    public function test()
    {
        $s = Yii::getAlias('@savepic');

        mkdir($s . '/888', 0777);

    }

    public function upload($place_id)
    {
        if ($this->validate()) {
            $s = Yii::getAlias('@savepic');
            if (!is_dir($s . '/' . $place_id)) {
                mkdir($s . '/' . $place_id . '', 0777);
                $loc = $s . '/' . $place_id;

            } else {
                $loc = $s . '/' . $place_id;

            }
            foreach ($this->imageFiles as $file) {
                $file->saveAs($loc . '/' . $file->baseName . date('Y-h-i-s') . '.' . $file->extension);
            }
//            $model2 = new Page();
//            $model2->pic_name = 'uploads/' . $file->baseName .date('Yhis') .'.' . $file->extension;
//            $model2->user_id=Yii::$app->user->identity->id;
//            $model2->up_date=date('Y-m-d');
//            $model2->status=0;
//            $model2->insert();
            return true;
        } else {
            return false;
        }
    }
/////services////////
    public $servicesIds = [];

    public function getServices()
    {
        return $this->hasMany(Services::className(), ['id' => 'service_id'])
            ->via('pvtPlacesServices');

    }

    public function getPvtPlacesServices()
    {
        return $this->hasMany(PvtPlacesServices::className(), ['place_id' => 'id']);
    }


// you need a getter for select2 dropdown
    public function getdropServices()
    {
        $data = Services::find()->all();
        return \yii\helpers\ArrayHelper::map($data, 'id', 'name');
    }

// You will need a getter for the current set o Authors in this Book
    public function getServicesIds()
    {
        $this->servicesIds = \yii\helpers\ArrayHelper::getColumn(
            $this->getPvtPlacesServices()->all(),
            'service_id'
        );
        return $this->servicesIds;
    }
////////////metros/////
    public $metrosIds = [];

    public function getMetros()
    {
        return $this->hasMany(Services::className(), ['id' => 'metro_id'])
            ->via('pvtPlacesMetros');

    }

    public function getPvtPlacesMetros()
    {
        return $this->hasMany(PvtPlacesMetros::className(), ['place_id' => 'id']);
    }


// you need a getter for select2 dropdown
    public function getdropMetros()
    {
        $data = Metros::find()->all();
        return \yii\helpers\ArrayHelper::map($data, 'id', 'name');
    }

// You will need a getter for the current set o Authors in this Book
    public function getMetrosIds()
    {
        $this->metrosIds = \yii\helpers\ArrayHelper::getColumn(
            $this->getPvtPlacesMetros()->all(),
            'metro_id'
        );
        return $this->metrosIds;
    }
////////
// You need to save the relations in BookHasAuthor table (adicional code for updates)
    public function afterSave($insert, $changedAttributes)
    {

        PvtPlacesKitchens::deleteAll('place_id = :placeId', [':placeId' => $this->id]);
        PvtPlacesServices::deleteAll('place_id = :placeId', [':placeId' => $this->id]);
        PvtPlacesMetros::deleteAll('place_id = :placeId', [':placeId' => $this->id]);

        if (!empty($this->kitchensIds)) { //save the relations

            foreach ($this->kitchensIds as $id) {
                $k = new PvtPlacesKitchens();
                $k->place_id = $this->id;
                $k->kitchen_id = $id;
                $k->save();

            }
        }
        if (!empty($this->servicesIds)) { //save the relations

            foreach ($this->servicesIds as $id) {
                $s = new PvtPlacesServices();
                $s->place_id = $this->id;
                $s->service_id = $id;
                $s->save();

            }
        }
        if (!empty($this->metrosIds)) { //save the relations

            foreach ($this->metrosIds as $id) {
                $m = new PvtPlacesMetros();
                $m->place_id = $this->id;
                $m->metro_id = $id;
                $m->save();

            }
        }
        parent::afterSave($insert, $changedAttributes); //don't forget this

    }


}
