<?php

use nikitakls\support\helpers\TicketHelper;
use nikitakls\support\models\search\CategorySearch;
use nikitakls\support\models\Ticket;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel \nikitakls\support\models\search\TicketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('support', 'Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-request-index">

    <p>
        <?= Html::a(Yii::t('support', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('support', 'Categories'), ['category/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'label' => Yii::t('support', 'Category'),
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
