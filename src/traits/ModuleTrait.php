<?php

namespace nikitakls\support\traits;

use nikitakls\support\Support;
use yii\base\Module;

/**
 * Trait ModuleTrait
 *
 * @property-read Support $module
 */
trait ModuleTrait
{
    /**
     * @return Support|Module
     */
    public function getModule()
    {
        return \Yii::$app->getModule('support');
    }

}