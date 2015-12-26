<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Places */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Рестораны', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="places-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'slug' => $model->slug], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'slug' => $model->slug], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'label'=>'Category',
                'attribute' =>'category.name',
                // ...
            ],
            [
                'label'=>'Created by',
                'attribute' =>'user.first_name',
                // ...
            ],
//            [
//              //'label'=>'kitch',
//                //'value'=>$model::find()->where(['id'=>'5'])->one()->getKitchens()->all(),
//               // 'attribute'=>'kitchens.name'
//            ],
            'status',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'price_from',
            'price_to',
            'slug',
        ],
    ]) ?>

</div>
