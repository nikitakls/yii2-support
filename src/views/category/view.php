<?php

use nikitakls\support\helpers\CategoryHelper;
use nikitakls\support\models\Category;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model nikitakls\support\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('support', 'Support Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-category-view">

    <p>
        <?= Html::a(Yii::t('support', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('support', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('support', 'Are you sure you want to delete this item?'),
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
