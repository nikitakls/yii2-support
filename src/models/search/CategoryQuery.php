<?php

namespace nikitakls\support\models\search;

use nikitakls\support\helpers\CategoryHelper;
use nikitakls\support\models\Category;

/**
 * This is the ActiveQuery class for [[SupportCategory]].
 *
 * @see Category
 */
class CategoryQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => CategoryHelper::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     * @return Category[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Category|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
