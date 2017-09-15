<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Issue;

/**
 * IssueSearch represents the model behind the search form about `app\models\Issue`.
 */
class IssueSearch extends Issue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['gch', 'year', 'yearissue', 'taskid', 'source', 'listscan', 'pdfscan'], 'safe'],
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
        $query = Issue::find();

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
        ]);

        $query->andFilterWhere(['like', 'gch', $this->gch])
            ->andFilterWhere(['like', 'year', $this->year])
            ->andFilterWhere(['like', 'yearissue', $this->yearissue])
            ->andFilterWhere(['like', 'taskid', $this->taskid])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'listscan', $this->listscan])
            ->andFilterWhere(['like', 'pdfscan', $this->pdfscan]);

        return $dataProvider;
    }
}
