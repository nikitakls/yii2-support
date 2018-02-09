<?php

use nikitakls\support\helpers\ContentHelper;
use yii\helpers\Html;

/**
 * _item.php
 * User: nikitakls
 * Date: 07.02.18
 * Time: 21:39
 * @var \nikitakls\support\models\Content $model
 */

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <p class="pull-right">
            <?= \Yii::$app->formatter->asDatetime($model->created_at) ?>
        </p>
        <h3 class="panel-title"><?= ContentHelper::typeLabel($model->type) ?></h3>
    </div>
    <div class="panel-body">
        <?= \Yii::$app->formatter->asNtext($model->message) ?>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-1">
                <?php $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-pencil"]) ?>

                <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>',
                    ['content/update', 'id' => $model->id], ['title' => Yii::t('yii', 'Update')]) ?>
                <?= Html::a('<i class="glyphicon glyphicon-trash"></i>',
                    ['content/delete', 'id' => $model->id], [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'data-method' => 'post',
                    ]) ?>

            </div>

            <div class="col-md-5">
                <?php if (!is_null($model->filename) && !empty($model->filename)): ?>
                    <?= Yii::t('support', 'File:') ?>

                    <?= Html::a($model->filename,
                        $model->getUploadedFileUrl('filename'),
                        ['target' => '_blank']
                    ) ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

