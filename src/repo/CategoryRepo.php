<?php

namespace nikitakls\support\repo;

use nikitakls\support\models\Category;
use yii\web\NotFoundHttpException;

class CategoryRepo
{
    protected $_cache = [];

    /**
     * Get SupportCategory by condition
     *
     * @param integer $pk
     * @throws NotFoundHttpException
     * @return Category
     */
    public function get($pk)
    {
        return $this->getByPk($pk);
    }

    /**
     * get SupportCategory by pk
     * @param integer $id task
     * @param bool $canCache can take model from cache
     * @throws NotFoundHttpException
     * @return Category
     */
    protected function getByPk($id, $canCache = true, $pk = 'id')
    {
        if (!isset($this->_cache[$id]) || !$canCache) {
            $this->_cache[$id] = $this->getBy([$pk => $id]);
        }
        return $this->_cache[$id];
    }

    /**
     * Get SupportCategory by condition
     *
     * @param array $condition
     * @throws NotFoundHttpException
     * @return Category
     */
    protected function getBy($condition)
    {
        if (!$model = Category::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundHttpException('SupportCategory not found.');
        }
        return $model;
    }

    /**
     * Remove the current model in storage.
     *
     * @throws \RuntimeException
     * @param Category $model
     * meaning all attributes that are loaded from DB will be saved.
     */

    public function remove(Category $model)
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
     * @param Category $model
     * @param bool $runValidation whether to perform validation (calling [[validate()]])
     * before saving the record. Defaults to `true`. If the validation fails, the record
     * will not be saved to the database and this method will return `false`.
     * @param array $attributeNames list of attribute names that need to be saved. Defaults to null,
     * meaning all attributes that are loaded from DB will be saved.
     */

    public function save(Category $model,
                         $runValidation = true,
                         array $attributeNames = null)
    {
        if (!$model->save($runValidation, $attributeNames)) {
            throw new \RuntimeException('Saving SupportCategory error.');
        }
    }

}