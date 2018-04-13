<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tasks;

/**
 * TasksSearch represents the model behind the search form about `app\models\Tasks`.
 */
class TasksSearch extends Tasks {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'integer'],
            [['hostname', 'username', 'name', 'descript', 'command', 'lasttime', 'source', 'type', 'desthost'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Tasks::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'lasttime' => $this->lasttime,
        ]);

        $query->andFilterWhere(['hostname' => $this->hostname])
                ->andFilterWhere(['like', 'username', $this->username])
                ->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'descript', $this->descript])
                ->andFilterWhere(['like', 'command', $this->command])
                ->andFilterWhere(['like', 'type', $this->command])
                ->andFilterWhere(['like', 'desthost', $this->command])
                ->andFilterWhere(['like', 'source', $this->source]);

        return $dataProvider;
    }

}
