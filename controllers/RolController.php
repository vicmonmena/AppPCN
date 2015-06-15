<?php

namespace app\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use app\models\Rol;
use app\models\RolSearch;
use app\models\Operacion;
use app\controllers\BaseController;

/**
 * RolController implements the CRUD actions for Rol model.
 */
class RolController extends BaseController {
	
    /**
     * Lists all Rol models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rol model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Rol model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	public function actionCreate() {
		
		$model = new Rol();
		$tipoOperaciones = Operacion::find()->all();
	 
		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			/*
			 * Pasamos la variable 'tipoOperaciones' a la vista 
			 * donde la utilizaremos para mostrar la lista de checkboxes
			 */
			return $this->render('create', [
				'model' => $model,
				'tipoOperaciones' => $tipoOperaciones
			]);
		}
	}

    /**
     * Updates an existing Rol model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
	public function actionUpdate($id) {
		$model = $this->findModel($id);
		$tipoOperaciones = Operacion::find()->all();
	 
		$model->operaciones = \yii\helpers\ArrayHelper::getColumn(
			$model->getRolOperaciones()->asArray()->all(),
			'operacion_id'
		);
	 
		if ($model->load(Yii::$app->request->post())) {
			if (!isset($_POST['Rol']['operaciones'])) {
				$model->operaciones = [];
			}
			if ($model->save()) {
				return $this->redirect(['view', 'id' => $model->id]);
			}
		} else {
			return $this->render('update', [
				'model' => $model,
				'tipoOperaciones' => $tipoOperaciones
			]);
		}
	}
    /**
     * Deletes an existing Rol model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rol model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rol the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Rol::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
