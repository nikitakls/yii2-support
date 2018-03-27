<?php

namespace nikitakls\support\models;

use nikitakls\support\models\search\CategoryQuery;
use nikitakls\support\Support;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "{{%support_category}}".
 *
 * @property int $id
 * @property string $title
 * @property string $icon
 * @property int $status
 *
 * @property Ticket[] $supportRequests
 */
class Category extends ActiveRecord
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
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
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
            'id' => Support::t('base', 'ID'),
            'title' => Support::t('base', 'Title'),
            'icon' => Support::t('base', 'Icon'),
            'status' => Support::t('base', 'Status'),
            'created_at' => Support::t('base', 'Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupportRequests()
    {
        return $this->hasMany(Ticket::class, ['category_id' => 'id']);
    }

}
