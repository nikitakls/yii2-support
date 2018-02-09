<?php

use nikitakls\support\helpers\CategoryHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model nikitakls\support\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="support-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(CategoryHelper::getStatusList(), ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('support', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
