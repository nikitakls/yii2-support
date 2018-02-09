<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \nikitakls\support\forms\ticket\TicketCreateForm */

$this->title = Yii::t('support', 'Create Support Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('support', 'Support Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
