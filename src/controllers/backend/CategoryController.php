<?php

namespace nikitakls\support\controllers\backend;

use nikitakls\support\forms\category\CategoryCreateForm;
use nikitakls\support\forms\category\CategoryEditForm;
use nikitakls\support\models\search\CategorySearch;
use nikitakls\support\repo\CategoryRepo;
use nikitakls\support\services\CategoryService;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * CategoryController implements the CRUD actions for SupportCategory model.
 */
class CategoryController extends Controller
{
    /** @var CategoryService */
    protected $categoryService;
    /** @var CategoryRepo */
    protected $categories;

    public function __construct($id, $module, CategoryRepo $categories, CategoryService $service,
                                array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->categoryService = $service;
        $this->categories = $categories;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SupportCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SupportCategory model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->categories->get($id),
        ]);
    }

    /**
     * Creates a new SupportCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new CategoryCreateForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $model = $this->categoryService->create($form);
                Yii::$app->session->setFlash('success', 'You puzzle saved successfully.');
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('create', [
            'model' => $form,
        ]);

    }

    /**
     * Updates an existing SupportCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->categories->get($id);
        $form = new CategoryEditForm($model);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {

            try {
                $model = $this->categoryService->edit($id, $form);
                Yii::$app->session->setFlash('success', 'SupportCategory updated.');
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
     * Deletes an existing SupportCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try {
            $this->categoryService->remove($id);
        } catch (\DomainException $e) {
            Yii::$app->errorHandler->logException($e);
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['index']);
    }

}
