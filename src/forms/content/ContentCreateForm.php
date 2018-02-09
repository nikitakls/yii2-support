<?php

namespace nikitakls\support\forms\content;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for active record model "Content".
 *
 * @property int $ticket_id
 * @property string $message
 * @property string $filename
 * @property int $type
 * @property int $user_id
 * @property int $created_at
 * @property int $sending_at
 */
class ContentCreateForm extends Model
{
    public $ticket_id;
    public $message;
    public $filename;
    public $type;
    public $user_id;
    public $created_at;
    public $sending_at;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'required'],
            [['ticket_id', 'type', 'user_id', 'created_at', 'sending_at'], 'integer'],
            [['message'], 'string'],
            [['filename'], 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => Yii::t('support', 'ID'),
            'Ticket ID' => Yii::t('support', 'Ticket ID'),
            'Message' => Yii::t('support', 'Message'),
            'Filename' => Yii::t('support', 'Filename'),
            'Type' => Yii::t('support', 'Type'),
            'User ID' => Yii::t('support', 'User ID'),
            'Created At' => Yii::t('support', 'Created At'),
            'Sending At' => Yii::t('support', 'Sending At'),
        ];
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->filename = UploadedFile::getInstance($this, 'filename');
            return true;
        }
        return false;
    }


}
