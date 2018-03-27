<?php

namespace nikitakls\support\forms\ticket;

use elisdn\compositeForm\CompositeForm;
use nikitakls\support\forms\content\ContentCreateForm;
use nikitakls\support\helpers\TicketHelper;

/**
 * This is the model class for active record model "SupportRequest".
 *
 * @property int $category_id
 * @property string $filename
 * @property string $title
 * @property ContentCreateForm $content
 */
class TicketCreateForm extends CompositeForm
{
    public $category_id;
    public $title;

    public function __construct(array $config = [])
    {
        $this->content = new ContentCreateForm();
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'title'], 'required'],
            [['category_id'], 'integer'],
            [['title'], 'string'],
            [['title'], 'string', 'max' => 255],
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
     * @return string
     */
    public function getViewName()
    {
        return '_form';
    }

    /**
     * @return array
     */
    public function internalForms()
    {
        return ['content'];
    }

}
