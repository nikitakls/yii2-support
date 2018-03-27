<?php

namespace nikitakls\support\controllers\backend;

use nikitakls\support\forms\content\ContentEditForm;
use nikitakls\support\repo\ContentRepo;
use nikitakls\support\services\ContentService;
use nikitakls\support\Support;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * ContentController implements the CRUD actions for Content model.
 * @author nikitakls
 */
class ContentController extends Controller
{
    /** @var ContentService */
    protected $service;
    /** @var ContentRepo */
    protected $contents;

    /**
     * ContentController constructor.
     * @param $id
     * @param $module
     * @param ContentRepo $contents
     * @param ContentService $contentService
     * @param array $config
     */
    public function __construct($id, $module, ContentRepo $contents, ContentService $contentService,
                                array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $contentService;
        $this->contents = $contents;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Updates an existing Content model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->contents->get($id);
        $form = new ContentEditForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            try {
                $model = $this->service->edit($id, $form);
                Yii::$app->session->setFlash('success', Support::t('base', 'Content updated.'));
                return $this->redirect(['ticket/view', 'id' => $model->ticket_id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('update', [
            'model' => $model,
            'formModel' => $form,
        ]);
    }

    /**
     * Deletes an existing Content model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try {
            $model = $this->contents->get($id);
            $ticketId = $model->ticket_id;
            $this->service->remove($id);
            return $this->redirect(['ticket/view', 'id' => $ticketId]);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        return '';

    }

}
