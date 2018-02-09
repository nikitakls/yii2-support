<?php

namespace nikitakls\support\controllers\guest;

use nikitakls\support\forms\content\ContentCreateForm;
use nikitakls\support\forms\ticket\TicketGuestCreateForm;
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

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
        ];
    }

    /**
     * Displays a single SupportRequest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException
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
                $model = $this->supportService->addUserContent($id, $contentForm, null);
                Yii::$app->session->setFlash('success', 'You answer saved successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('guest/view', [
            'model' => $this->requests->get($id),
            'contentForm' => $contentForm,
        ]);
    }

    /**
     * Creates a new SupportRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionIndex()
    {
        $form = new TicketGuestCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $model = $this->supportService->createGuest($form);
                Yii::$app->session->setFlash('success', 'You puzzle saved successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('guest/create', [
            'model' => $form,
        ]);

    }
}
