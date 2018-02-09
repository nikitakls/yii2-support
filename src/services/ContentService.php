<?php

namespace nikitakls\support\services;

use nikitakls\support\forms\content\ContentEditForm;
use nikitakls\support\repo\ContentRepo;

class ContentService
{

    protected $repo;

    public function __construct(ContentRepo $repo)
    {
        $this->repo = $repo;
    }

    public function edit($id, ContentEditForm $form)
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
