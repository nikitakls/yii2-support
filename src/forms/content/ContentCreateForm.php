<?php

namespace nikitakls\support\forms\content;

use nikitakls\support\helpers\ContentHelper;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for active record model "Content".
 * @author nikitakls
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
        return ContentHelper::attributeLabels();
    }

    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            $this->filename = UploadedFile::getInstance($this, 'filename');
            return true;
        }
        return false;
    }


}
