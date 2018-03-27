<?php

namespace nikitakls\support\services;

use nikitakls\support\forms\content\ContentEditForm;
use nikitakls\support\repo\ContentRepo;

/**
 * Class ContentService
 * @package nikitakls\support\services
 * @author nikitakls
 */
class ContentService
{

    /**
     * @var ContentRepo
     */
    protected $repo;

    /**
     * ContentService constructor.
     * @param ContentRepo $repo
     */
    public function __construct(ContentRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param int $id
     * @param ContentEditForm $form
     * @return \nikitakls\support\models\Content
     * @throws \yii\web\NotFoundHttpException
     */
    public function edit($id, ContentEditForm $form)
    {
        $model = $this->repo->get($id);
        $model->setAttributes($form->getAttributes());
        $this->repo->save($model);
        return $model;
    }

    /**
     * @param int $id
     * @throws
     */
    public function remove($id)
    {
        $model = $this->repo->get($id);
        $this->repo->remove($model);
    }
}
