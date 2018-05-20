<?php

namespace app\controllers;

use Yii;
use app\models\Salas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SalasController implements the CRUD actions for Salas model.
 */
class SalasController extends Controller
{
    /**
     * {@inheritdoc}
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
     * Creates a new Salas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdicionar()
    {
        $model = new Salas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('sucesso','Sala adicionada com sucesso.');
    
            $session = Yii::$app->session;
            $data = $session->get('data');
            return $this->redirect(['reservas/index', 'data' => $data]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Salas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditar($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('sucesso','Sala atualizada com sucesso.');
            
            $session = Yii::$app->session;
            $data = $session->get('data');
            return $this->redirect(['reservas/index', 'data' => $data]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Salas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionExcluir($id)
    {
        $this->findModel($id)->delete();

        $session = Yii::$app->session;
        $data = $session->get('data');
        return $this->redirect(['reservas/index', 'data' => $data]);
    }

    /**
     * Finds the Salas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Salas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Salas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
