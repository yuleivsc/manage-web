<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Taskstatus;

/**
 * TaskstatusSearch represents the model behind the search form about `app\models\Taskstatus`.
 */
class TaskstatusSearch extends Taskstatus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'taskid'], 'integer'],
            [['uuid', 'hostname', 'username', 'starttime', 'endtime', 'status', 'outputtext', 'outputfile'], 'safe'],
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
        $query = Taskstatus::find();

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
            'taskid' => $this->taskid,
            'hostname' => $this->hostname,
            'username' => $this->username,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'uuid', $this->uuid])
//            ->andFilterWhere([ 'hostname'=> $this->hostname])
//            ->andFilterWhere(['username'=> $this->username])
//            ->andFilterWhere(['status'=> $this->status])
            ->andFilterWhere(['like', 'starttime', $this->starttime])
            ->andFilterWhere(['like', 'endtime', $this->endtime])
            ->andFilterWhere(['like', 'outputtext', $this->outputtext])
            ->andFilterWhere(['like', 'outputfile', $this->outputfile]);

        return $dataProvider;
    }
}
