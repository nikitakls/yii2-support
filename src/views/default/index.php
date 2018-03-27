<?php

use nikitakls\support\helpers\TicketHelper;
use nikitakls\support\models\search\CategorySearch;
use nikitakls\support\models\Ticket;
use nikitakls\support\Support;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel \nikitakls\support\models\search\TicketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Support::t('base', 'Requests to support');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Support::t('base', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'title',
            [
                'label' => Support::t('base', 'Category'),
                'attribute' => 'category_id',
                'filter' => CategorySearch::items(),
                'value' => function (Ticket $item) {
                    return $item->category->title;
                }
            ],
            [
                'label' => Support::t('base', 'Status'),
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => TicketHelper::getStatusList(),
                'value' => function (Ticket $item) {
                    return TicketHelper::statusLabel($item->status);
                }
            ],

            'created_at:datetime',
            [
                'class' => yii\grid\ActionColumn::class,
                'template' => '{view}'
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
