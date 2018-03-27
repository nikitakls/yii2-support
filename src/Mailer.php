<?php

namespace nikitakls\support;

use Yii;
use yii\base\Component;

/**
 * Mailer.php
 * @author  nikitakls
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
            $this->setWelcomeSubject(Support::t('base', 'Welcome to {0}', Yii::$app->name));
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
     * @param string $to
     * @param string $subject
     * @param string $view
     * @param array $params
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