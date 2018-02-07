<?php

namespace nikitakls\support\models;

use Yii;

/**
 * This is the model class for table "{{%support_category}}".
 *
 * @property int $id
 * @property string $title
 * @property string $icon
 * @property int $status
 *
 * @property SupportRequest[] $supportRequests
 */
class SupportCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%support_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'status'], 'required'],
            [['status'], 'integer'],
            [['title', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'icon' => Yii::t('app', 'Icon'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportRequests()
    {
        return $this->hasMany(SupportRequest::className(), ['category_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SupportCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SupportCategoryQuery(get_called_class());
    }
}
