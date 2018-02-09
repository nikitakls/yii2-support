<?php

namespace nikitakls\support\models\search;

use nikitakls\support\helpers\TicketHelper;
use nikitakls\support\models\Ticket;

/**
 * This is the ActiveQuery class for [[SupportRequest]].
 *
 * @see Ticket
 */
class TicketQuery extends \yii\db\ActiveQuery
{
    public function wait()
    {
        return $this->andWhere(['status' => TicketHelper::STATUS_WAIT]);
    }

    public function close()
    {
        return $this->andWhere(['status' => TicketHelper::STATUS_CLOSE]);
    }

    public function answered()
    {
        return $this->andWhere(['status' => TicketHelper::STATUS_ANSWERED]);
    }

    /**
     * @inheritdoc
     * @return Ticket[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Ticket|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
