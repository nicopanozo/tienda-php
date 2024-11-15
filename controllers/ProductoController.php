<?php

namespace app\controllers;

use app\models\Producto;
use app\models\ProductoSearch;
use app\models\Stock;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'eliminar' => ['POST'],
                    ],
                ],
            ],
            [
                'access' => [
                'class' => AccessControl::class,
                'only' => ['listar', 'ver', 'crear', 'actualizar', 'eliminar', ], // Especifica las acciones que deseas restringir (o quita esta línea para aplicar a todas)
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // '@' significa que solo usuarios autenticados tienen acceso
                    ],
                ],
            ],
            ]
        );
    }

    /**
     * Lists all Producto models.
     *
     * @return string
     */
    public function actionListar()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionVer($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCrear()
    {
        $model = new Producto();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                ///// hayq ue madnar al stock del producto seleccionado

                //// crear un stock en 0
                $stock = new Stock();
                $stock->producto_id = $model->id;
                $stock->cantidad = 0;
                if($stock->save()){
                    return $this->redirect(['stock/actualizar', 'id' => $stock->id]);

                } else {
                    ////mensaje de errro
                }

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActualizar($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['ver', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Producto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEliminar($id)
    {

        $model = $this->findModel($id);

        $model->eliminado = date("Y-m-d H:i:s");
        if($model->save()){
            return $this->redirect(['listar']);
        }

    }

    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
