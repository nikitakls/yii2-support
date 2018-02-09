<?php

namespace nikitakls\support;

use Yii;
use yii\base\BootstrapInterface;
use yii\base\Module;
use yii\console\Application as ConsoleApplication;
use yii\i18n\PhpMessageSource;

/**
 * Bootstrap class registers module and support application component. It also creates some url rules which will be applied
 * when UrlManager.enablePrettyUrl is enabled.
 *
 */
class Bootstrap implements BootstrapInterface
{
    /** @inheritdoc */
    public function bootstrap($app)
    {
        /** @var Module $module */
        /** @var \yii\db\ActiveRecord $modelName */
        if ($app->hasModule('support') && ($module = $app->getModule('support')) instanceof Module) {

            Yii::$container->setSingleton('base', function () {
                return null;
            });

            if ($app instanceof ConsoleApplication) {
                $module->controllerNamespace = 'nikitakls\support\commands';
            } else {

                $configUrlRule = [
                    'prefix' => $module->urlPrefix,
                    'rules' => $module->urlRules,
                ];

                $configUrlRule['class'] = 'yii\web\GroupUrlRule';
                $rule = Yii::createObject($configUrlRule);

                $app->urlManager->addRules([$rule], false);

            }

            if (!isset($app->get('i18n')->translations['user*'])) {
                $app->get('i18n')->translations['support*'] = [
                    'class' => PhpMessageSource::className(),
                    'basePath' => __DIR__ . '/messages',
                    'sourceLanguage' => 'en-US'
                ];
            }

            Yii::$container->set('nikitakls\support\Mailer', $module->mailer);
        }
    }

}