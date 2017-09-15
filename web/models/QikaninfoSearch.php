<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Qikaninfo;

/**
 * QikaninfoSearch represents the model behind the search form about `app\models\Qikaninfo`.
 */
class QikaninfoSearch extends Qikaninfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'deleteflag'], 'integer'],
            [['gch', 'name', 'assoc', 'classname', 'zbdw', 'zgdw', 'zb', 'cbzq', 'cksj', 'dj', 'gntykh', 'gjbzkh', 'address', 'price', 'intro', 'name_e', 'yfdh', 'updatetime'], 'safe'],
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
        $query = Qikaninfo::find();

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
            'updatetime' => $this->updatetime,
            'deleteflag' => $this->deleteflag,
        ]);

        $query->andFilterWhere(['like', 'gch', $this->gch])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'assoc', $this->assoc])
            ->andFilterWhere(['like', 'classname', $this->classname])
            ->andFilterWhere(['like', 'zbdw', $this->zbdw])
            ->andFilterWhere(['like', 'zgdw', $this->zgdw])
            ->andFilterWhere(['like', 'zb', $this->zb])
            ->andFilterWhere(['like', 'cbzq', $this->cbzq])
            ->andFilterWhere(['like', 'cksj', $this->cksj])
            ->andFilterWhere(['like', 'dj', $this->dj])
            ->andFilterWhere(['like', 'gntykh', $this->gntykh])
            ->andFilterWhere(['like', 'gjbzkh', $this->gjbzkh])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'name_e', $this->name_e])
            ->andFilterWhere(['like', 'yfdh', $this->yfdh]);

        return $dataProvider;
    }
}
