<?php

namespace nikitakls\support\controllers\backend;

use nikitakls\support\forms\content\ContentCreateForm;
use nikitakls\support\forms\ticket\TicketAdminCreateForm;
use nikitakls\support\forms\ticket\TicketEditForm;
use nikitakls\support\models\search\TicketSearch;
use nikitakls\support\repo\TicketRepo;
use nikitakls\support\services\SupportService;
use nikitakls\support\Support;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RequestController implements the CRUD actions for SupportRequest model.
 * @author nikitakls
 */
class TicketController extends Controller
{
    /** @var SupportService */
    protected $supportService;
    /** @var TicketRepo */
    protected $requests;

    /**
     * TicketController constructor.
     * @param $id
     * @param $module
     * @param TicketRepo $requests
     * @param SupportService $supportService
     * @param array $config
     */
    public function __construct($id, $module, TicketRepo $requests, SupportService $supportService,
                                array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->supportService = $supportService;
        $this->requests = $requests;
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
     * Lists all SupportRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TicketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['category']);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SupportRequest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $contentForm = new ContentCreateForm();

        if ($contentForm->load(Yii::$app->request->post()) && $contentForm->validate()) {
            try {
                $model = $this->supportService->addSupportContent($id, $contentForm, Yii::$app->user->id);
                Yii::$app->session->setFlash('success', Support::t('base', 'You answer saved successfully.'));
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('view', [
            'model' => $this->requests->get($id),
            'contentForm' => $contentForm,
        ]);
    }

    /**
     * Creates a new SupportRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new TicketAdminCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $model = $this->supportService->createSupport($form, Yii::$app->user->id);
                Yii::$app->session->setFlash('success', Support::t('base','You request saved successfully.'));
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $form,
        ]);

    }

    /**
     * Updates an existing SupportRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->requests->get($id);
        $form = new TicketEditForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            try {
                $model = $this->supportService->edit($id, $form);
                Yii::$app->session->setFlash('success', Support::t('base','You request updated successfully.'));
                return $this->redirect(['view', 'id' => $model->id]);
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
     * Deletes an existing SupportRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try {
            $this->supportService->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['index']);
    }

}
