<?php

namespace nikitakls\support\controllers\user;

use nikitakls\support\forms\content\ContentCreateForm;
use nikitakls\support\forms\ticket\TicketCreateForm;
use nikitakls\support\models\search\TicketSearch;
use nikitakls\support\repo\TicketRepo;
use nikitakls\support\services\SupportService;
use Yii;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * RequestController implements the CRUD actions for SupportRequest model.
 */
class DefaultController extends Controller
{
    /** @var SupportService */
    protected $supportService;

    /** @var TicketRepo */
    protected $requests;

    public function __construct($id, $module, TicketRepo $requests, SupportService $supportService,
                                array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->supportService = $supportService;
        $this->requests = $requests;
    }

    /**
     * Lists all SupportRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TicketSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, ['category'], Yii::$app->user->id);

        return $this->render('user/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SupportRequest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException if owner not equal current user
     */
    public function actionView($id)
    {
        $contentForm = new ContentCreateForm();
        $model = $this->requests->get($id);
        if ($model->user_id !== Yii::$app->user->id) {
            throw new ForbiddenHttpException('Access denied.');
        }

        if ($contentForm->load(Yii::$app->request->post()) && $contentForm->validate()) {
            try {
                $model = $this->supportService->addUserContent($id, $contentForm, Yii::$app->user->id);
                Yii::$app->session->setFlash('success', 'You answer saved successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('user/view', [
            'model' => $model,
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
        $form = new TicketCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $model = $this->supportService->createUser($form, Yii::$app->user->id);
                Yii::$app->session->setFlash('success', 'You puzzle saved successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('user/create', [
            'model' => $form,
        ]);

    }

}
