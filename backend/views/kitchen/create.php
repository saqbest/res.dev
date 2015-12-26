<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Kitchens */

$this->title = 'Create Kitchens';
$this->params['breadcrumbs'][] = ['label' => 'Kitchens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kitchens-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
