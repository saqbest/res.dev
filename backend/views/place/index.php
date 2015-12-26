<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PlacesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Places';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="places-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Places', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
            [
                'label'=>'Category',
                'attribute' =>'category.name',
                // ...
            ],
            'description:ntext',
            //'category_id',
           // 'user_id',
            [
                'label'=>'Created by',
                'attribute' =>'user.first_name',
                // ...
            ],
             'status',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
             'price_from',
             'price_to',
             'slug',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
