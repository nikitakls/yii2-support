<?php

namespace nikitakls\support;

use yii\web\Controller;
use yiidreamteam\upload\FileUploadBehavior;

/**
 * support module definition class
 */
class Support extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'nikitakls\support\controllers';


    /**
     * @var string The prefix for user module URL.
     *
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'support';

    /** @var array The rules to be used in URL management. */
    public $urlRules = [
        '' => 'default/index',
        'create' => 'default/create',
        //'captcha' => 'default/captcha',
        'view/<id:\d+>' => 'default/view',
        '<controller:\w+>/<id:\d+>' => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    ];

    /** @var array Mailer configuration */
    public $mailer = [];

    /** @var string */
    public $supportEmail = null;

    /** @var bool */
    public $sendEmailToSupport = true;

    /** @var bool */
    public $sendEmailToUser = true;

    public $uploadBehavior = [
        'class' => FileUploadBehavior::class,
        'attribute' => 'filename',
        'filePath' => '@filePath/origin/support/[[attribute_ticket_id]]/[[pk]].[[extension]]',
        'fileUrl' => '@fileUrl/origin/support/[[attribute_ticket_id]]/[[pk]].[[extension]]',
    ];

    public $isBackend = false;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if ($this->isBackend) {
            $this->controllerNamespace .= '\backend';
        } elseif (\Yii::$app->user->identity) {
            $this->controllerNamespace .= '\user';
        } else {
            $this->controllerNamespace .= '\guest';
        }
        parent::init();
    }

    public function getAdminMenuItems($controller = false)
    {
        if ($controller instanceof Controller) {
            $isModule = $controller->module->id == $this->id;
        } else {
            $isModule = false;
        }

        if (!$this->isBackend) {
            return [];
        }
        return [
            'label' => 'Support',
            'icon' => 'support',
            'active' => $isModule,
            'url' => '/' . $this->urlPrefix . '/ticket',
        ];
    }

}
