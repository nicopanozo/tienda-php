<?php

namespace app\controllers;

use app\models\Venta;
use app\models\VentaSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VentaController implements the CRUD actions for Venta model.
 */
class VentaController extends Controller
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
                        // 'eliminar' => ['POST'],
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
     * Lists all Venta models.
     *
     * @return string
     */
    public function actionListar()
    {
        $searchModel = new VentaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Venta model.
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
     * Creates a new Venta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCrear()
    {
        $model = new Venta();
        $productos = \app\models\Producto::find()->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {


                $model->usuario_id = Yii::$app->user->id;   

                $stock = $model->producto->stock;

                if($model->cantidad > $stock->cantidad){
                    $model->addError('cantidad', 'No hay suficiente stock para realizar la venta');
                    return $this->render('create', [
                        'model' => $model,
                        'productos' => $productos,
                    ]);
                } else {
                    $stock->cantidad = $stock->cantidad - $model->cantidad;
                    if($stock->save()){
                        if ($model->save()) {
                            return $this->redirect(['listar']);
                        }
                    } else {
                        $model->addError('cantidad', 'No se pudo actualizar el stock');
                        return $this->render('create', [
                            'model' => $model,
                            'productos' => $productos,

                        ]);
                    }

                }
            }
        } else {
            $model->loadDefaultValues();
            $model->fecha_venta = date('Y-m-d H:i:s');
            $model->cantidad = 1;
        }

        return $this->render('create', [
            'model' => $model,
            'productos' => $productos,
        ]);
    }

    /**
     * Updates an existing Venta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActualizar($id)
    {
        $model = $this->findModel($id);
        $productos = \app\models\Producto::find()->all();


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['ver', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'productos' => $productos,

        ]);
    }

    /**
     * Deletes an existing Venta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEliminar($id)
    {
        $model = $this->findModel($id);
        $model->eliminado = date("Y-m-d H:i:s");

        $stock = $model->producto->stock;
        $stock->cantidad = $stock->cantidad + $model->cantidad;

        if($stock->save()){
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Venta liminado.');
                return $this->redirect(['listar']);
            } else{
                Yii::$app->session->setFlash('error', 'Hubo un error al marcar como eliminado.');
            }
        }

        return $this->redirect(['listar']);
    }

    /**
     * Finds the Venta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Venta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Venta::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
