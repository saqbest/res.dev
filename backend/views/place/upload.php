<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use kartik\select2\Select2;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Places */
/* @var $form yii\widgets\ActiveForm */
?>
    <style>
        .kv-file-remove.btn.btn-xs.btn-default {
            display: none;
        }
    </style>
    <div class="places-form">


        <?= FileInput::widget([
            'name' => 'Places[imageFiles]',
            'attribute' => 'Places[imageFiles]',
            // 'language' => 'ru',
            'options' => ['multiple' => true,
                'id' => '111',

            ],
            'pluginOptions' => [
                // 'showPreview' => false,
                // 'showUploadedThumbs' => false,
//            'showRemove' => false,
//            'showUpload' => false,
                'uploadUrl' => Url::to(['/place/upload']),
                'uploadExtraData' => [
                    'place_id' => $model->id,

                ],
            ],
            'pluginEvents' => [
                'filepredelete' => "function(event, key) {
return (!confirm('Are you sure you want to delete ?'));
}",
                'filedeleted' => 'function(event, key) { alert(111); }',
            ]
        ]); ?>


    </div>
<?php
$script = <<< JS

$(document).ready(function(){


})

JS;
$this->registerJs($script);
?>