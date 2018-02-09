<?php

/* @var $this yii\web\View */
/* @var $model nikitakls\support\models\Ticket */
/* @var $formModel \nikitakls\support\forms\ticket\TicketEditForm */

$this->title = Yii::t('support', 'Update Support Request: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('support', 'Support Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('support', 'Update');
?>
<div class="support-request-update">

    <?= $this->render('_update', [
        'model' => $formModel,
    ]) ?>

</div>
