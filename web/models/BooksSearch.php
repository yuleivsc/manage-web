<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;

/**
 * BooksSearch represents the model behind the search form about `app\models\Books`.
 */
class BooksSearch extends Books {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'no', 'noend', 'number'], 'integer'],
            [['title', 'class', 'subclass', 'date', 'comment', 'isbn'], 'safe'],
            [['price'], 'number'],
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
        $query = Books::find();

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
//            'date' => $this->date,
            'price' => $this->price,
            'no' => $this->no,
            'noend' => $this->noend,
            'number' => $this->number,
                //'class'=> $this->class,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
                ->andFilterWhere(['like', 'date', $this->date])
                ->andFilterWhere(['like', 'isbn', $this->isbn])
                ->andFilterWhere(['like', 'comment', $this->comment]);
        if ($this->class == 'null') {
            $query->andWhere(['class' => null]);
        } else {
            $query->andFilterWhere(['class' => $this->class]);
        }
        if ($this->subclass == 'null') {
            $query->andWhere(['subclass' => null]);
        } else {
            $query->andFilterWhere(['subclass' => $this->subclass]);
        }

        return $dataProvider;
    }

}
