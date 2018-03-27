<?php

use nikitakls\support\Support;

/* @var $this yii\web\View */
/* @var $model \nikitakls\support\forms\category\CategoryCreateForm */

$this->title = Support::t('base', 'Create Support Category');
$this->params['breadcrumbs'][] = ['label' => Support::t('base', 'Support Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
