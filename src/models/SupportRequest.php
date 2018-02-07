<?php

namespace nikitakls\support\models;

use Yii;

/**
 * This is the model class for table "{{%support_request}}".
 *
 * @property int $id
 * @property int $category_id
 * @property int $parent_id
 * @property int $status
 * @property int $answered
 * @property int $created_at
 * @property int $sending_at
 * @property string $filename
 * @property string $title
 * @property string $message
 * @property int $user_id
 * @property string $email
 * @property string $fio
 *
 * @property SupportCategory $category
 */
class SupportRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%support_request}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'status', 'answered', 'created_at'], 'required'],
            [['category_id', 'parent_id', 'status', 'answered', 'created_at', 'sending_at', 'user_id'], 'integer'],
            [['message'], 'string'],
            [['filename', 'title', 'email', 'fio'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => SupportCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'status' => Yii::t('app', 'Status'),
            'answered' => Yii::t('app', 'Answered'),
            'created_at' => Yii::t('app', 'Created At'),
            'sending_at' => Yii::t('app', 'Sending At'),
            'filename' => Yii::t('app', 'Filename'),
            'title' => Yii::t('app', 'Title'),
            'message' => Yii::t('app', 'Message'),
            'user_id' => Yii::t('app', 'User ID'),
            'email' => Yii::t('app', 'Email'),
            'fio' => Yii::t('app', 'Fio'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(SupportCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     * @return SupportRequestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SupportRequestQuery(get_called_class());
    }
}
