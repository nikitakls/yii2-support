<?php

use nikitakls\support\helpers\CategoryHelper;
use nikitakls\support\models\Category;
use nikitakls\support\Support;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model nikitakls\support\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Support::t('base', 'Support Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-category-view">

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
            'title',
            'icon',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function (Category $item) {
                    return CategoryHelper::statusLabel($item->status);
                }
            ],
        ],
    ]) ?>

</div>
