<?php

namespace nikitakls\support\forms\ticket;

use nikitakls\support\helpers\TicketHelper;
use nikitakls\support\models\Ticket;
use yii\base\Model;

/**
 * This is the model class for active record model "SupportRequest".
 * @author nikitakls
 *
 * @property int $category_id
 * @property int $parent_id
 * @property int $status
 * @property int $level
 * @property int $created_at
 * @property int $sending_at
 * @property string $title
 * @property int $user_id
 * @property string $email
 * @property string $fio
 */
class TicketEditForm extends Model
{
    public $category_id;
    public $parent_id;
    public $status;
    public $level;
    public $created_at;
    public $sending_at;
    public $title;
    public $user_id;
    public $email;
    public $fio;

    /** @var Ticket */
    protected $_model;


    /**
     * TicketEditForm constructor.
     * @param Ticket $model
     * @param array $config
     */
    public function __construct(Ticket $model, $config = [])
    {
        $this->category_id = $model->category_id;
        $this->parent_id = $model->parent_id;
        $this->status = $model->status;
        $this->level = $model->level;
        $this->created_at = $model->created_at;
        $this->title = $model->title;
        $this->user_id = $model->user_id;
        $this->email = $model->email;
        $this->fio = $model->fio;

        $this->_model = $model;

        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'status', 'level', 'created_at'], 'required'],
            [['category_id', 'parent_id', 'status', 'level', 'created_at', 'sending_at', 'user_id'], 'integer'],
            [['title', 'email', 'fio'], 'string', 'max' => 255],
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
     * @return Ticket
     */
    public function getSupportRequest()
    {
        return $this->_model;
    }
}
