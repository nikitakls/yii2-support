<?php

namespace nikitakls\support\helpers;

use nikitakls\support\Support;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * PuzzleHelper
 * @author nikitakls
 */
class CategoryHelper
{

    const STATUS_ACTIVE = 10;
    const STATUS_DRAFT = 20;

    public static function statusLabel($status)
    {
        switch ($status) {
            case self::STATUS_DRAFT:
                $class = 'label label-default';
                break;
            case self::STATUS_ACTIVE:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getStatusList(), $status), [
            'class' => $class,
        ]);
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => Support::t('base', 'Active'),
            self::STATUS_DRAFT => Support::t('base', 'Draft'),
        ];
    }

}