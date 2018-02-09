<?php

namespace nikitakls\support\models;

use nikitakls\support\forms\content\ContentCreateForm;
use nikitakls\support\helpers\ContentHelper;
use nikitakls\support\models\search\ContentQuery;
use nikitakls\support\traits\ModuleTrait;
use Yii;
use yiidreamteam\upload\FileUploadBehavior;

/**
 * This is the model class for table "support_content".
 *
 * @property int $id
 * @property int $ticket_id
 * @property string $message
 * @property string $filename
 * @property int $type
 * @property int $user_id
 * @property int $created_at
 * @property int $sending_at
 *
 * @property Ticket $ticket
 * @mixin FileUploadBehavior
 */
class Content extends \yii\db\ActiveRecord
{
    use ModuleTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'support_content';
    }

    /**
     * @inheritdoc
     * @return ContentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContentQuery(get_called_class());
    }

    public static function createSupport(ContentCreateForm $form, $userId = null)
    {
        $model = self::createUser($form, $userId);
        $model->type = ContentHelper::TYPE_SUPPORT;
        return $model;
    }

    public static function createUser(ContentCreateForm $form, $userId = null)
    {
        $model = new static();
        $model->message = $form->message;
        $model->filename = $form->filename;
        $model->user_id = $userId;
        $model->created_at = time();
        $model->type = ContentHelper::TYPE_USER;
        return $model;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message', 'type', 'created_at'], 'required'],
            [['type', 'user_id', 'created_at', 'sending_at'], 'integer'],
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
            'id' => Yii::t('support', 'ID'),
            'ticket_id' => Yii::t('support', 'Ticket ID'),
            'message' => Yii::t('support', 'Message'),
            'filename' => Yii::t('support', 'Filename'),
            'type' => Yii::t('support', 'Type'),
            'user_id' => Yii::t('support', 'User ID'),
            'created_at' => Yii::t('support', 'Created At'),
            'sending_at' => Yii::t('support', 'Sending At'),
        ];
    }

    public function pathChunk()
    {
        return substr(md5($this->ticket_id), 0, 2);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::className(), ['id' => 'ticket_id']);
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            $this->module->uploadBehavior,
        ];
    }

}
