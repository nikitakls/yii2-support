<?php

/* @var $this yii\web\View */
/* @var $model nikitakls\support\models\Content */
/* @var $formModel \nikitakls\support\forms\content\ContentEditForm */

$this->title = Yii::t('support', 'Update Content: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('support', 'Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('support', 'Update');
?>
<div class="content-update">

    <?= $this->render('_form', [
        'model' => $formModel,
    ]) ?>

</div>
