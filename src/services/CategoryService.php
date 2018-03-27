<?php

namespace nikitakls\support\services;

use nikitakls\support\forms\category\CategoryCreateForm;
use nikitakls\support\forms\category\CategoryEditForm;
use nikitakls\support\models\Category;
use nikitakls\support\repo\CategoryRepo;

/**
 * Class CategoryService
 * @package nikitakls\support\services
 * @author nikitakls
 */
class CategoryService
{

    /** @var CategoryRepo */
    protected $repo;

    /**
     * CategoryService constructor.
     * @param CategoryRepo $repo
     */
    public function __construct(CategoryRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param CategoryCreateForm $form
     * @return Category
     */
    public function create(CategoryCreateForm $form)
    {
        $model = new Category();
        $model->setAttributes($form->getAttributes());
        $this->repo->save($model);
        return $model;
    }

    /**
     * @param int $id
     * @param CategoryEditForm $form
     * @return Category
     * @throws \yii\web\NotFoundHttpException
     */
    public function edit($id, CategoryEditForm $form)
    {
        $model = $this->repo->get($id);
        $model->setAttributes($form->getAttributes());
        $this->repo->save($model);
        return $model;
    }

    /**
     * @param int $id
     * @throws \yii\web\NotFoundHttpException
     */
    public function remove($id)
    {
        $model = $this->repo->get($id);
        $this->repo->remove($model);
    }
}