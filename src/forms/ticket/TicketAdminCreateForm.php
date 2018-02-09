<?php

namespace nikitakls\support\forms\ticket;

/**
 * This is the model class for active record model "SupportRequest".
 *
 * @property int $level
 * @property int $user_id
 * @property string $email
 * @property string $fio
 */
class TicketAdminCreateForm extends TicketCreateForm
{
    public $level;
    public $user_id;
    public $email;
    public $fio;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'level'], 'required'],
            [['category_id', 'level', 'user_id'], 'integer'],
            [['title', 'email', 'fio'], 'string', 'max' => 255],
        ];
    }

    public function getViewName()
    {
        return '_admin_form';
    }

}
