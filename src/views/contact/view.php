<?php

use nikitakls\support\helpers\TicketHelper;
use nikitakls\support\models\Ticket;
use nikitakls\support\Support;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model nikitakls\support\models\Ticket */
/* @var $contentForm \nikitakls\support\forms\content\ContentCreateForm */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Support::t('base', 'Support Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'label' => Support::t('base', 'Category'),
                        'attribute' => 'category_id',
                        'value' => function (Ticket $item) {
                            return $item->category->title;
                        }
                    ],
                    [
                        'label' => Support::t('base', 'Status'),
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function (Ticket $item) {
                            return TicketHelper::statusLabel($item->status);
                        }
                    ],
                    [
                        'label' => Support::t('base', 'Level'),
                        'attribute' => 'level',
                        'format' => 'raw',
                        'value' => function (Ticket $item) {
                            return TicketHelper::levelLabel($item->level);
                        }
                    ],
                ],
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'updated_at:datetime',
                    'user_id',
                    'email:email',
                    'fio',
                ],
            ]) ?>

        </div>
    </div>

    <div>
        <?php foreach ($model->contents as $id => $item): ?>
            <?= $this->render('_item', [
                'model' => $item
            ]) ?>
        <?php endforeach; ?>
    </div>
</div>
