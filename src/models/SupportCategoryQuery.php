<?php

namespace nikitakls\support\models;

/**
 * This is the ActiveQuery class for [[SupportCategory]].
 *
 * @see SupportCategory
 */
class SupportCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SupportCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SupportCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
