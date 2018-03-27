<?php

namespace nikitakls\support\helpers;


use nikitakls\support\Support;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * PuzzleHelper.php
 * @author  nikitakls
 */
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

    /**
     * @param int $status
     * @return string
     */
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

    /**
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_WAIT => Support::t('base', 'Waiting'),
            self::STATUS_ANSWERED => Support::t('base', 'Answered'),
            self::STATUS_CLOSE => Support::t('base', 'Close'),
            self::STATUS_DELETE => Support::t('base', 'Deleted'),
        ];
    }

    /**
     * @param $status
     * @return string
     */
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

    /**
     * @return array
     */
    public static function getLevelList()
    {
        return [
            self::LEVEL_INFO => Support::t('base', 'Info'),
            self::LEVEL_NOTICE => Support::t('base', 'Notice'),
            self::LEVEL_WARNING => Support::t('base', 'Warning'),
            self::LEVEL_ERROR => Support::t('base', 'Error'),
            self::LEVEL_CRITICAL => Support::t('base', 'Critical'),
            self::LEVEL_DANGER => Support::t('base', 'Danger'),
        ];
    }

    /**
     * @return array
     */
    public static function attributeLabels()
    {
        return [
            'id' => Support::t('base', '#'),
            'category_id' => Support::t('base', 'Category'),
            'parent_id' => Support::t('base', 'Parent'),
            'status' => Support::t('base', 'Status'),
            'answered' => Support::t('base', 'Answered'),
            'created_at' => Support::t('base', 'Created'),
            'sending_at' => Support::t('base', 'Sending'),
            'filename' => Support::t('base', 'Filename'),
            'title' => Support::t('base', 'Title'),
            'message' => Support::t('base', 'Message'),
            'user_id' => Support::t('base', 'User'),
            'email' => Support::t('base', 'Email'),
            'fio' => Support::t('base', 'Fio'),
            'level' => Support::t('base', 'Level'),
        ];
    }

}