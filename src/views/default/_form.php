<?php

use nikitakls\support\models\search\CategorySearch;
use nikitakls\support\Support;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model nikitakls\support\models\Ticket */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="support-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList(CategorySearch::items(), ['prompt' => '']) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->content, 'message')->textarea(['rows' => 6]) ?>

    <?= $form->field($model->content, 'filename')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Support::t('base', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
