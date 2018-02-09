<?php

namespace nikitakls\support\models;

use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use nikitakls\support\forms\ticket\TicketCreateForm;
use nikitakls\support\forms\ticket\TicketEditForm;
use nikitakls\support\helpers\TicketHelper;
use nikitakls\support\models\search\TicketQuery;

/**
 * This is the model class for table "{{%support_request}}".
 *
 * @property int $id
 * @property int $category_id
 * @property int $parent_id
 * @property int $status
 * @property int $level
 * @property int $created_at
 * @property int $updated_at
 * @property string $filename
 * @property string $title
 * @property int $user_id
 * @property string $email
 * @property string $fio
 *
 * @property Category $category
 */
class Ticket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%support_ticket}}';
    }

    /**
     * @inheritdoc
     * @return TicketQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketQuery(get_called_class());
    }

    public static function create(TicketCreateForm $form)
    {
        $model = new static();
        $model->setAttributes($form->getAttributes());
        $model->created_at = time();
        $model->setWait();
        $model->level = TicketHelper::LEVEL_NOTICE;
        return $model;
    }

    public function setWait()
    {
        $this->status = TicketHelper::STATUS_WAIT;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'status', 'level', 'created_at'], 'required'],
            [['category_id', 'parent_id', 'status', 'level', 'created_at', 'user_id'], 'integer'],
            [['filename', 'title', 'email', 'fio'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => SaveRelationsBehavior::className(),
                'relations' => ['contents'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return TicketHelper::attributeLabels();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContents()
    {
        return $this->hasMany(Content::className(), ['ticket_id' => 'id'])->orderBy('created_at');
    }

    public function edit(TicketEditForm $form)
    {
        $this->setAttributes($form->getAttributes());
        $this->updated_at = time();
        return $this;
    }

    public function addContent(Content $content)
    {
        $contents = $this->contents;
        $contents[] = $content;
        $this->contents = $contents;
        $this->updated_at = time();
    }

    public function setAnswered()
    {
        $this->status = TicketHelper::STATUS_ANSWERED;
    }
}
