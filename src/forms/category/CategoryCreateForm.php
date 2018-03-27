<?php

namespace nikitakls\support\forms\category;

use nikitakls\support\Support;
use yii\base\Model;

/**
 * This is the model class for active record model "SupportCategory".
 * @author nikitakls
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
            'ID' => Support::t('base', 'ID'),
            'Title' => Support::t('base', 'Title'),
            'Icon' => Support::t('base', 'Icon'),
            'Status' => Support::t('base', 'Status'),
        ];
    }

}
