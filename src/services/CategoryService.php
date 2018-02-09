<?php

namespace nikitakls\support\services;

use nikitakls\support\forms\category\CategoryCreateForm;
use nikitakls\support\forms\category\CategoryEditForm;
use nikitakls\support\models\Category;
use nikitakls\support\repo\CategoryRepo;

class CategoryService
{

    /** @var CategoryRepo */
    protected $repo;

    public function __construct(CategoryRepo $repo)
    {
        $this->repo = $repo;
    }

    public function create(CategoryCreateForm $form)
    {
        $model = new Category();
        $model->setAttributes($form->getAttributes());
        $this->repo->save($model);
        return $model;
    }

    public function edit($id, CategoryEditForm $form)
    {
        $model = $this->repo->get($id);
        $model->setAttributes($form->getAttributes());
        $this->repo->save($model);
        return $model;
    }

    public function remove($id)
    {
        $model = $this->repo->get($id);
        $this->repo->remove($model);
    }
}