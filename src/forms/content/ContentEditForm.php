<?php

namespace nikitakls\support\forms\content;

use nikitakls\support\models\Content;
use Yii;
use yii\base\Model;

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
class ContentEditForm extends Model
{
    public $ticket_id;
    public $message;
    public $filename;
    public $type;
    public $user_id;
    public $created_at;
    public $sending_at;

    /** @var Content */
    protected $_model;


    public function __construct(Content $model, $config = [])
    {
        $this->ticket_id = $model->ticket_id;
        $this->message = $model->message;
        $this->filename = $model->filename;
        $this->type = $model->type;
        $this->user_id = $model->user_id;
        $this->created_at = $model->created_at;
        $this->sending_at = $model->sending_at;

        $this->_model = $model;

        parent::__construct($config);
    }

    /*
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ticket_id', 'message', 'type', 'created_at'], 'required'],
            [['ticket_id', 'type', 'user_id', 'created_at', 'sending_at'], 'integer'],
            [['message'], 'string'],
            [['filename'], 'string', 'max' => 255],
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

    /**
     * @return Content
     */
    public function getContent()
    {
        return $this->_model;
    }
}
