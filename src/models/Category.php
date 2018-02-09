<?php

namespace nikitakls\support\models;

use nikitakls\support\models\search\CategoryQuery;
use Yii;

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
class Category extends \yii\db\ActiveRecord
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
        return $this->hasMany(Ticket::className(), ['category_id' => 'id']);
    }

}
