<?php

namespace nikitakls\support\models;

/**
 * This is the ActiveQuery class for [[SupportRequest]].
 *
 * @see SupportRequest
 */
class SupportRequestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return SupportRequest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SupportRequest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
