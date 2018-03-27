<?php

namespace nikitakls\support\helpers;

use nikitakls\support\Support;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * PuzzleHelper.php
 * @author  nikitakls
 */
class ContentHelper
{

    const TYPE_USER = 10;
    const TYPE_SUPPORT = 20;

    /**
     * @param $status
     * @return string
     */
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

    /**
     * @return array
     */
    public static function getTypeList()
    {
        return [
            self::TYPE_USER => Support::t('base', 'User'),
            self::TYPE_SUPPORT => Support::t('base', 'Support'),
        ];
    }

    /**
     * @return array
     */
    public static function attributeLabels()
    {
        return [
            'id' => Support::t('base', 'ID'),
            'ticket_id' => Support::t('base', 'Ticket ID'),
            'message' => Support::t('base', 'Message'),
            'filename' => Support::t('base', 'Filename'),
            'type' => Support::t('base', 'Type'),
            'user_id' => Support::t('base', 'User ID'),
            'created_at' => Support::t('base', 'Created At'),
            'sending_at' => Support::t('base', 'Sending At'),
        ];
    }

}