<?php

namespace nikitakls\support\controllers;

use nikitakls\support\forms\content\ContentCreateForm;
use nikitakls\support\forms\ticket\TicketGuestCreateForm;
use nikitakls\support\repo\TicketRepo;
use nikitakls\support\services\SupportService;
use nikitakls\support\Support;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

/**
 * RequestController implements the CRUD actions for SupportRequest model.
 * @author nikitakls
 */
class ContactController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['captcha', 'view', 'index'],
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    /** @var SupportService */
    protected $supportService;

    /** @var TicketRepo */
    protected $requests;

    /**
     * DefaultController constructor.
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
    public function beforeAction($action)
    {
        $this->layout = $this->module->guestLayout;
        return parent::beforeAction($action);
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
     * @param string $hash
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws ForbiddenHttpException if the model cannot be found
     */
    public function actionView($id, $hash = '')
    {
        $contentForm = new ContentCreateForm();
        $model = $this->requests->get($id);
        if(!$model->validateHash($hash)){
            throw new ForbiddenHttpException(Support::t('base', 'You not allowed this action.'));
        }

        return $this->render('view', [
            'model' => $model,
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
                Yii::$app->session->setFlash('success', Support::t('base', 'You request saved successfully.'));
                return $this->redirect(['view', 'id' => $model->id, 'hash' => $model->getHash()]);
            } catch (\DomainException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);
    }
}
