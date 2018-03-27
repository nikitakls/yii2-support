<?php

use nikitakls\support\Support;

/* @var $this yii\web\View */
/* @var $model nikitakls\support\models\Content */
/* @var $formModel \nikitakls\support\forms\content\ContentEditForm */

$this->title = Support::t('base', 'Update Content: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Support::t('base', 'Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Support::t('base', 'Update');
?>
<div class="content-update">

    <?= $this->render('_form', [
        'model' => $formModel,
    ]) ?>

</div>
