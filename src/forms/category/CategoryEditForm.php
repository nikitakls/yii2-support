<?php

namespace nikitakls\support\forms\category;

use nikitakls\support\models\Category;
use Yii;
use yii\base\Model;

/**
 * This is the model class for active record model "SupportCategory".
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


    public function __construct(Category $model, $config = [])
    {
        $this->title = $model->title;
        $this->icon = $model->icon;
        $this->status = $model->status;

        $this->_model = $model;

        parent::__construct($config);
    }

    /*
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

    /**
     * @return Category
     */
    public function getSupportCategory()
    {
        return $this->_model;
    }
}
