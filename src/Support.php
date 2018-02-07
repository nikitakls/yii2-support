<?php

namespace api\support;

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
        '<controller:\w+>/<id:\d+>' => '<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
    ];

    /** @var array Mailer configuration */
    public $mailer = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}
