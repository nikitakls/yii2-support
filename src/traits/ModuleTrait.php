<?php

namespace nikitakls\support\traits;

use nikitakls\support\Support;

/**
 * Trait ModuleTrait
 *
 * @property-read Support $module
 */
trait ModuleTrait
{
    /**
     * @return Support
     */
    public function getModule()
    {
        return \Yii::$app->getModule('support');
    }

}