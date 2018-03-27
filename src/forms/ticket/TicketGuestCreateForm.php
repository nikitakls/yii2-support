<?php

namespace nikitakls\support\forms\ticket;

use nikitakls\support\helpers\TicketHelper;

/**
 * This is the model class for active record model "SupportRequest".
 * @author nikitakls
 *
 * @property string $email
 * @property string $fio
 * @property string $verifyCode
 */
class TicketGuestCreateForm extends TicketCreateForm
{
    public $email;
    public $fio;
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'email', 'fio'], 'required'],
            [['category_id'], 'integer'],
            ['verifyCode', 'captcha', 'captchaAction' => '/support/contact/captcha'],
            [['title', 'email', 'fio'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return TicketHelper::attributeLabels();
    }

}
