<?php

namespace app\controllers;

use app\models\Usuario;
use app\models\UsuarioSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UsuarioController implements the CRUD actions for Usuario model.
 */
class UsuarioController extends Controller
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
     * Lists all Usuario models.
     *
     * @return string
     */
    public function actionListar()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuario model.
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
     * Creates a new Usuario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCrear()
    {
        $model = new Usuario();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // $model->password = md5($model->password);
                if($model->save()){
                    return $this->redirect(['ver', 'id' => $model->id]);
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
     * Updates an existing Usuario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActualizar($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            // $model->password = md5($model->password);
            if($model->save()){
                return $this->redirect(['ver', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Usuario model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEliminar($id)
    {
        $model = $this->findModel($id);

        $model->scenario = Usuario::SCENARIO_UPDATE_DELETED;

        $model->eliminado = date("Y-m-d H:i:s");
        if($model->save()){
            Yii::$app->session->setFlash('success', 'Usuario marcado como eliminado.');
            return $this->redirect(['listar']);
        } else{
            Yii::$app->session->setFlash('error', 'Hubo un error al marcar como eliminado.');
        }
    }

    /**
     * Finds the Usuario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Usuario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuario::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
