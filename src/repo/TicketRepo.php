<?php

namespace nikitakls\support\repo;

use nikitakls\support\models\Ticket;
use yii\web\NotFoundHttpException;

class TicketRepo
{
    protected $_cache = [];

    /**
     * Get SupportRequest by condition
     *
     * @param integer $pk
     * @throws NotFoundHttpException
     * @return Ticket
     */
    public function get($pk)
    {
        return $this->getByPk($pk);
    }

    /**
     * get SupportRequest by pk
     * @param integer $id task
     * @param bool $canCache can take model from cache
     * @throws NotFoundHttpException
     * @return Ticket
     */
    protected function getByPk($id, $canCache = true, $pk = 'id')
    {
        if (!isset($this->_cache[$id]) || !$canCache) {
            $this->_cache[$id] = $this->getBy([$pk => $id]);
        }
        return $this->_cache[$id];
    }

    /**
     * Get SupportRequest by condition
     *
     * @param array $condition
     * @throws NotFoundHttpException
     * @return Ticket
     */
    protected function getBy($condition)
    {
        if (!$model = Ticket::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundHttpException('SupportRequest not found.');
        }
        return $model;
    }

    /**
     * Remove the current model in storage.
     *
     * @throws \RuntimeException
     * @param Ticket $model
     * meaning all attributes that are loaded from DB will be saved.
     */

    public function remove(Ticket $model)
    {
        if (!$model->delete()) {
            throw new \RuntimeException('Deleting error.');
        }
    }

    public function clearCache()
    {
        $this->_cache = [];
    }

    /**
     * Saves the current model in storage.
     *
     * @throws \RuntimeException
     * @param Ticket $model
     * @param bool $runValidation whether to perform validation (calling [[validate()]])
     * before saving the record. Defaults to `true`. If the validation fails, the record
     * will not be saved to the database and this method will return `false`.
     * @param array $attributeNames list of attribute names that need to be saved. Defaults to null,
     * meaning all attributes that are loaded from DB will be saved.
     */

    public function save(Ticket $model,
                         $runValidation = true,
                         array $attributeNames = null)
    {
        if (!$model->save($runValidation, $attributeNames)) {
            var_dump($model->getErrors());
            die();
            throw new \RuntimeException('Saving SupportRequest error.');
        }
    }

}