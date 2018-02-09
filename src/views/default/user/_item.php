<?php

use nikitakls\support\helpers\ContentHelper;

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
</div>
