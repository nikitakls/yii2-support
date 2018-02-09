<?php
/**
 * PuzzleHelper.php
 * User: nikitakls
 * Date: 05.12.17
 * Time: 16:53
 */

namespace nikitakls\support\helpers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


class ContentHelper
{

    const TYPE_USER = 10;
    const TYPE_SUPPORT = 20;

    public static function typeLabel($status)
    {
        switch ($status) {
            case self::TYPE_USER:
                $class = 'label label-default';
                break;
            case self::TYPE_SUPPORT:
                $class = 'label label-success';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getTypeList(), $status), [
            'class' => $class,
        ]);
    }

    public static function getTypeList()
    {
        return [
            self::TYPE_USER => Yii::t('support', 'User'),
            self::TYPE_SUPPORT => Yii::t('support', 'Support'),
        ];
    }

}