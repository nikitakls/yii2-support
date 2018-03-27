<?php

use nikitakls\support\Support;

/* @var $this yii\web\View */
/* @var $model nikitakls\support\models\Ticket */
/* @var $formModel \nikitakls\support\forms\ticket\TicketEditForm */

$this->title = Support::t('base', 'Update Support Request: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Support::t('base', 'Support Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Support::t('base', 'Update');
?>
<div class="support-request-update">

    <?= $this->render('_update', [
        'model' => $formModel,
    ]) ?>

</div>
