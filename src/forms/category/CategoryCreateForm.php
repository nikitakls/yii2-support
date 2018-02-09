<?php

namespace nikitakls\support\forms\category;

use Yii;
use yii\base\Model;

/**
 * This is the model class for active record model "SupportCategory".
 *
 * @property string $title
 * @property string $icon
 * @property int $status
 */
class CategoryCreateForm extends Model
{
    public $title;
    public $icon;
    public $status;

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
            'ID' => Yii::t('support', 'ID'),
            'Title' => Yii::t('support', 'Title'),
            'Icon' => Yii::t('support', 'Icon'),
            'Status' => Yii::t('support', 'Status'),
        ];
    }

}
