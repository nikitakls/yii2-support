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

$this->title = Support::t('base', 'Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-request-index">

    <p>
        <?= Html::a(Support::t('base', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Support::t('base', 'Categories'), ['category/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'label' => Support::t('base', 'Category'),
                'attribute' => 'category_id',
                'filter' => CategorySearch::items(),
                'value' => function (Ticket $item) {
                    return $item->category->title;
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => TicketHelper::getStatusList(),
                'value' => function (Ticket $item) {
                    return TicketHelper::statusLabel($item->status);
                }
            ],
            [
                'attribute' => 'level',
                'format' => 'raw',
                'filter' => TicketHelper::getLevelList(),
                'value' => function (Ticket $item) {
                    return TicketHelper::levelLabel($item->level);
                }
            ],
            'created_at:datetime',
            'title',
            'user_id',
            'email:email',
            'fio',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
