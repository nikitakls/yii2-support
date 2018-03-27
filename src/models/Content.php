<?php

namespace nikitakls\support\models;

use nikitakls\support\forms\content\ContentCreateForm;
use nikitakls\support\helpers\ContentHelper;
use nikitakls\support\models\search\ContentQuery;
use nikitakls\support\Support;
use nikitakls\support\traits\ModuleTrait;
use yiidreamteam\upload\FileUploadBehavior;
use yii\db\ActiveRecord;
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
class Content extends ActiveRecord
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

    public function pathChunk()
    {
        return substr(md5($this->ticket_id), 0, 2);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::class, ['id' => 'ticket_id']);
    }

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            $this->module->uploadBehavior,
        ];
    }

}
