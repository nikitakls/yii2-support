<?php

use nikitakls\support\Support;

/* @var $this yii\web\View */
/* @var $model nikitakls\support\models\Category */
/* @var $formModel \nikitakls\support\forms\category\CategoryEditForm */

$this->title = Support::t('base', 'Update Support Category: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Support::t('base', 'Support Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Support::t('base', 'Update');
?>
<div class="support-category-update">

    <?= $this->render('_form', [
        'model' => $formModel,
    ]) ?>

</div>
