<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ActividadCritica;

/**
 * ActividadCriticaSearch represents the model behind the search form about `app\models\ActividadCritica`.
 */
class ActividadCriticaSearch extends ActividadCritica
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'redireccion_telefono'], 'integer'],
            [['nombre', 'aplicaciones', 'proveedores', 'otros_activos', 'comentarios', 'create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ActividadCritica::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'redireccion_telefono' => $this->redireccion_telefono,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'aplicaciones', $this->aplicaciones])
            ->andFilterWhere(['like', 'proveedores', $this->proveedores])
            ->andFilterWhere(['like', 'otros_activos', $this->otros_activos])
            ->andFilterWhere(['like', 'comentarios', $this->comentarios]);

        return $dataProvider;
    }
}
