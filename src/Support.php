<?php

namespace nikitakls\support;

use Yii;
use yii\web\Controller;
use yiidreamteam\upload\FileUploadBehavior;
use yii\base\Module;

/**
 * support module definition class
 */
class Support extends Module
{
    /**
     * @var string
     */
    public $layout;

    /**
     * @var string
     */
    public $guestLayout = null;

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
        } else {
            $this->controllerNamespace .= '';
        }
        \Yii::$container->set('nikitakls\support\Mailer', $this->mailer);
        $this->registerTranslations();

        parent::init();
    }

    public function registerTranslations()
    {
        \Yii::$app->i18n->translations['support.*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => __DIR__ . '/messages',
            'fileMap' => [
                'support.support' => 'support.php',
                'support.base' => 'base.php',
            ],
        ];
    }

    /**
     * @param null|Controller $controller
     * @return array
     */
    public function getAdminMenuItems($controller = null)
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
            'label' => self::t('base', 'Support'),
            'icon' => 'support',
            'active' => $isModule,
            'url' => '/' . $this->urlPrefix . '/ticket',
        ];
    }

    /**
     * @param $category
     * @param $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('support.' . $category, $message, $params, $language);
    }

}
