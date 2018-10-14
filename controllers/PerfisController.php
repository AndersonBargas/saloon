<?php

namespace app\controllers;

use Yii;
use app\models\Perfis;
use app\models\PerfisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PerfisController implements the CRUD actions for Perfis model.
 */
class PerfisController extends Controller
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
     * Lists all Perfis models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PerfisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Perfis model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionVer($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Perfis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdicionar()
    {
        $model = new Perfis();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['ver', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Perfis model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionEditar($id)
    {
        $model = $this->findModel($id);

        if ($post = Yii::$app->request->post()) {

            if (array_key_exists('controladores', $post) === true) {
                $permissoes = [];
                foreach ($post['controladores'] as $info) {
                    if (strpos($info, '*') === false) {
                        continue;
                    }
    
                    list($controlador, $acao) = explode('*', $info);
                    $permissoes[] = [
                        'idPerfil' => $id,
                        'controlador' => $controlador,
                        'acao' => $acao,
                    ];
                }

                $post['Perfis']['permissoes'] = $permissoes;
                unset($post['controladores']);

            }

            foreach ($model->getPermissoes()->all() as $existente) {
                $existente->delete();
            }

            if ($model->loadAll($post) && $model->saveAll()) {
                return $this->redirect(['ver', 'id' => $model->id]);
            }
        }

        $controladores = $this->buscarControladoresComAcoes($model->getPermissoes());

        return $this->render('update', [
            'model' => $model,
            'controladores' => $controladores,
        ]);
    }

    /**
     * Deletes an existing Perfis model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionExcluir($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Perfis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Perfis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Perfis::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function buscarControladoresComAcoes($permissoes)
    {
        $controladores = Yii::$app->metadata->getControllers();

        $items = [];
        foreach (array_values($controladores) as $controlador) {

            $acoes = Yii::$app->metadata->getActions($controlador);
            $filhos = [];

            foreach ($acoes as $acao) {
                $filho = [
                    'title' => $acao,
                    'key' => "{$controlador}*{$acao}",
                ];

                $existePermissao = $permissoes->where([
                    'controlador' => $controlador,
                    'acao' => $acao,
                    ])->exists();

                if ($existePermissao === true) {
                    $filho['selected'] = true;
                }

                $filhos[] = $filho;
            }

            $items[] = ['title'    => mb_substr($controlador, 0, -10),
                        'children' => $filhos,
                        'folder' => true,
            ];
        }
        return $items;
    }
}
