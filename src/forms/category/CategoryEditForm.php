<?php

namespace nikitakls\support\forms\category;

use nikitakls\support\models\Category;
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
class CategoryEditForm extends Model
{
    public $title;
    public $icon;
    public $status;

    /** @var Category */
    protected $_model;


    /**
     * CategoryEditForm constructor.
     * @param Category $model
     * @param array $config
     */
    public function __construct(Category $model, $config = [])
    {
        $this->title = $model->title;
        $this->icon = $model->icon;
        $this->status = $model->status;

        $this->_model = $model;

        parent::__construct($config);
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
            'ID' => Support::t('base', 'ID'),
            'Title' => Support::t('base', 'Title'),
            'Icon' => Support::t('base', 'Icon'),
            'Status' => Support::t('base', 'Status'),
        ];
    }

    /**
     * @return Category
     */
    public function getSupportCategory()
    {
        return $this->_model;
    }
}
