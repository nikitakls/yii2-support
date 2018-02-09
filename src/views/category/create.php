<?php


/* @var $this yii\web\View */
/* @var $model \nikitakls\support\forms\category\CategoryCreateForm */

$this->title = Yii::t('support', 'Create Support Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('support', 'Support Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="support-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
