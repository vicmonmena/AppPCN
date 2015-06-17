<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Notificacion;

/**
 * NotificacionSearch represents the model behind the search form about `app\models\Notificacion`.
 */
class NotificacionSearch extends Notificacion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ubicacion'], 'integer'],
            [['subject', 'create_time', 'update_time'], 'safe'],
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
        $query = Notificacion::find();

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
            'ubicacion' => $this->ubicacion,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject]);

        return $dataProvider;
    }
}
