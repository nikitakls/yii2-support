<?php

/* @var $this yii\web\View */
/* @var $model nikitakls\support\models\Category */
/* @var $formModel \nikitakls\support\forms\category\CategoryEditForm */

$this->title = Yii::t('support', 'Update Support Category: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('support', 'Support Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('support', 'Update');
?>
<div class="support-category-update">

    <?= $this->render('_form', [
        'model' => $formModel,
    ]) ?>

</div>
