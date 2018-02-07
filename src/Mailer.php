<?php
/**
 * Mailer.php
 * User: nikitakls
 * Date: 07.02.18
 * Time: 15:26
 */

namespace nikitakls\support;


use dektrium\user\models\Token;
use dektrium\user\models\User;
use Yii;
use yii\base\Component;

/**
 * Mailer.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class Mailer extends Component
{
    /** @var string */
    public $viewPath = '@nikitakls/support/views/mail';

    /** @var string|array Default: `Yii::$app->params['adminEmail']` OR `no-reply@example.com` */
    public $sender;

    /** @var \yii\mail\BaseMailer Default: `Yii::$app->mailer` */
    public $mailerComponent;

    /** @var string */
    protected $defaultSubject;

    /** @var \nikitakls\support\Support */
    protected $module;

    /**
     * @return string
     */
    public function getDefaultSubject()
    {
        if ($this->defaultSubject == null) {
            $this->setWelcomeSubject(Yii::t('support', 'Welcome to {0}', Yii::$app->name));
        }

        return $this->defaultSubject;
    }

    /**
     * @param string $defaultSubject
     */
    public function setWelcomeSubject($defaultSubject)
    {
        $this->defaultSubject = $defaultSubject;
    }


    /** @inheritdoc */
    public function init()
    {
        $this->module = Yii::$app->getModule('support');
        parent::init();
    }

    /**
     * Sends an email to a user after registration.
     *
     * @param User  $user
     * @param Token $token
     * @param bool  $showPassword
     *
     * @return bool
     */
    public function sendDefaultMessage(User $user)
    {
        return $this->sendMessage(
            $user->email,
            $this->getWelcomeSubject(),
            'default',
            ['user' => $user, 'module' => $this->module]
        );
    }

    /**
     * @param string $to
     * @param string $subject
     * @param string $view
     * @param array  $params
     *
     * @return bool
     */
    protected function sendMessage($to, $subject, $view, $params = [])
    {
        $mailer = $this->mailerComponent === null ? Yii::$app->mailer : Yii::$app->get($this->mailerComponent);
        $mailer->viewPath = $this->viewPath;
        $mailer->getView()->theme = Yii::$app->view->theme;

        if ($this->sender === null) {
            $this->sender = isset(Yii::$app->params['adminEmail']) ?
                Yii::$app->params['adminEmail']
                : 'no-reply@example.com';
        }

        return $mailer->compose(['html' => $view, 'text' => 'text/' . $view], $params)
            ->setTo($to)
            ->setFrom($this->sender)
            ->setSubject($subject)
            ->send();
    }
}