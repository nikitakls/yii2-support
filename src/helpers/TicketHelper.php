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

class TicketHelper
{

    const STATUS_WAIT = 10;
    const STATUS_ANSWERED = 20;
    const STATUS_CLOSE = 30;
    const STATUS_DELETE = 40;

    const LEVEL_INFO = 10;
    const LEVEL_NOTICE = 20;
    const LEVEL_WARNING = 30;
    const LEVEL_ERROR = 40;
    const LEVEL_CRITICAL = 50;
    const LEVEL_DANGER = 60;

    public static function statusLabel($status)
    {
        switch ($status) {
            case self::STATUS_WAIT:
                $class = 'label label-warning';
                break;
            case self::STATUS_ANSWERED:
                $class = 'label label-success';
                break;
            case self::STATUS_CLOSE:
                $class = 'label label-default';
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
            self::STATUS_WAIT => \Yii::t('support', 'Waiting'),
            self::STATUS_ANSWERED => \Yii::t('support', 'Answered'),
            self::STATUS_CLOSE => \Yii::t('support', 'Close'),
            self::STATUS_DELETE => \Yii::t('support', 'Deleted'),
        ];
    }

    public static function levelLabel($status)
    {
        switch ($status) {
            case self::LEVEL_INFO:
                $class = 'label label-info';
                break;
            case self::LEVEL_NOTICE:
                $class = 'label label-default';
                break;
            case self::LEVEL_WARNING:
                $class = 'label label-warning';
                break;
            case self::LEVEL_ERROR:
                $class = 'label label-danger';
                break;
            case self::LEVEL_CRITICAL:
                $class = 'label label-danger';
                break;
            case self::LEVEL_DANGER:
                $class = 'label label-danger';
                break;
            default:
                $class = 'label label-default';
        }

        return Html::tag('span', ArrayHelper::getValue(self::getLevelList(), $status), [
            'class' => $class,
        ]);
    }

    public static function getLevelList()
    {
        return [
            self::LEVEL_INFO => \Yii::t('support', 'Info'),
            self::LEVEL_NOTICE => \Yii::t('support', 'Notice'),
            self::LEVEL_WARNING => \Yii::t('support', 'Warning'),
            self::LEVEL_ERROR => \Yii::t('support', 'Error'),
            self::LEVEL_CRITICAL => \Yii::t('support', 'Critical'),
            self::LEVEL_DANGER => \Yii::t('support', 'Danger'),
        ];
    }

    public static function attributeLabels()
    {
        return [
            'ID' => Yii::t('support', 'ID'),
            'Category ID' => Yii::t('support', 'Category'),
            'Parent ID' => Yii::t('support', 'Parent'),
            'Status' => Yii::t('support', 'Status'),
            'Answered' => Yii::t('support', 'Answered'),
            'Created At' => Yii::t('support', 'Created'),
            'Sending At' => Yii::t('support', 'Sending'),
            'Filename' => Yii::t('support', 'Filename'),
            'Title' => Yii::t('support', 'Title'),
            'Message' => Yii::t('support', 'Message'),
            'User ID' => Yii::t('support', 'User'),
            'Email' => Yii::t('support', 'Email'),
            'Fio' => Yii::t('support', 'Fio'),
        ];
    }

}