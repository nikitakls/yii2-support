<?php

use nikitakls\support\helpers\CategoryHelper;
use nikitakls\support\models\Category;
use nikitakls\support\Support;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel \nikitakls\support\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Support::t('base', 'Support Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-category-index">

    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a(Support::t('base', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'icon',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => CategoryHelper::getStatusList(),
                'value' => function (Category $item) {
                    return CategoryHelper::statusLabel($item->status);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
