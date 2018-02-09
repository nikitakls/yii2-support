<?php

namespace nikitakls\support\repo;

use nikitakls\support\models\Content;
use yii\web\NotFoundHttpException;

class ContentRepo
{
    protected $_cache = [];

    /**
     * Get Content by condition
     *
     * @param integer $pk
     * @throws NotFoundHttpException
     * @return Content
     */
    public function get($pk)
    {
        return $this->getByPk($pk);
    }

    /**
     * get Content by pk
     * @param integer $id task
     * @param bool $canCache can take model from cache
     * @throws NotFoundHttpException
     * @return Content
     */
    protected function getByPk($id, $canCache = true, $pk = 'id')
    {
        if (!isset($this->_cache[$id]) || !$canCache) {
            $this->_cache[$id] = $this->getBy([$pk => $id]);
        }
        return $this->_cache[$id];
    }

    /**
     * Get Content by condition
     *
     * @param array $condition
     * @throws NotFoundHttpException
     * @return Content
     */
    protected function getBy($condition)
    {
        if (!$model = Content::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundHttpException('Content not found.');
        }
        return $model;
    }

    /**
     * Remove the current model in storage.
     *
     * @throws \RuntimeException
     * @param Content $model
     * meaning all attributes that are loaded from DB will be saved.
     */

    public function remove(Content $model)
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
     * @param Content $model
     * @param bool $runValidation whether to perform validation (calling [[validate()]])
     * before saving the record. Defaults to `true`. If the validation fails, the record
     * will not be saved to the database and this method will return `false`.
     * @param array $attributeNames list of attribute names that need to be saved. Defaults to null,
     * meaning all attributes that are loaded from DB will be saved.
     */

    public function save(Content $model,
                         $runValidation = true,
                         array $attributeNames = null)
    {
        if (!$model->save($runValidation, $attributeNames)) {
            throw new \RuntimeException('Saving Content error.');
        }
    }

}