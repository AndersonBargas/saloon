<?php

namespace app\controllers;

use Yii;
use app\models\Reservas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReservasController implements the CRUD actions for Reservas model.
 */
class ReservasController extends Controller
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
                    'adicionar' => ['POST'],
                    'excluir' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Reservas models.
     * @return mixed
     */
    public function actionIndex($data)
    {
        $session = Yii::$app->session;
        $session->set('data', $data);

        return $this->render('index', [
            'data' => $data,
        ]);
    }

    /**
     * Displays a single Reservas model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionVer($id)
    {
        $model = $this->findModel($id);
        $model->usuario = $model->getUsuario0()->One()->nome;
        $model->sala    = $model->getSala0()->One()->nome;
        $model->hora .= 'h';
    
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Reservas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdicionar()
    {
        $model = new Reservas();

        $model->usuario = Yii::$app->user->identity->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('sucesso','Reserva adicionada com sucesso.');
    
            $session = Yii::$app->session;
            $data = $session->get('data');
            return $this->redirect(['reservas/index', 'data' => $data]);
        }

        $model->sala = Yii::$app->request->post('sala', null);
        $model->data = Yii::$app->request->post('data', null);
        $model->hora = Yii::$app->request->post('hora', null);

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Reservas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditar($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('sucesso','Reserva atualizada com sucesso.');

            return $this->redirect(['ver', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Reservas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionExcluir($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->getSession()->setFlash('sucesso','Reserva excluída com sucesso.');

        $session = Yii::$app->session;
        $data = $session->get('data');
        return $this->redirect(['reservas/index', 'data' => $data]);
    }

    /**
     * Finds the Reservas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Reservas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reservas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
