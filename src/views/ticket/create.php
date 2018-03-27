<?php

use nikitakls\support\Support;

/* @var $this yii\web\View */
/* @var $model \nikitakls\support\forms\ticket\TicketCreateForm */

$this->title = Support::t('base', 'Create Support Request');
$this->params['breadcrumbs'][] = ['label' => Support::t('base', 'Support Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-request-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
