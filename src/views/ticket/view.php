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

    <div class="row">
        <div class="col-md-6">
            <p>
                <?= Html::a(Support::t('base', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Support::t('base', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Support::t('base', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

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
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function (Ticket $item) {
                            return TicketHelper::statusLabel($item->status);
                        }
                    ],
                    [
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
    <div class="answer-form">
        <?= $this->render('_answer', ['model' => $contentForm]) ?>
    </div>

</div>
