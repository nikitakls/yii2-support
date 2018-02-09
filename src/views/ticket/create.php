<?php


/* @var $this yii\web\View */
/* @var $model \nikitakls\support\forms\ticket\TicketCreateForm */

$this->title = Yii::t('support', 'Create Support Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('support', 'Support Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-request-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
