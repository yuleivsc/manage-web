<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Articleinfo;

/**
 * ArticleinfoSearch represents the model behind the search form about `app\models\Articleinfo`.
 */
class ArticleinfoSearch extends Articleinfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['gch', 'year', 'yearissue', 'title', 'taskid', 'source', 'lngCollectIDs', 'keyword_e', 'author_e', 'imburse', 'class', 'media_c', 'num', 'lngid', 'pdfurl', 'beginpage', 'showorgan', 'pagecount', 'years', 'title_c', 'endpage', 'remark_c', 'keyword_c', 'title_e', 'media_e', 'showwriter', 'language', 'CoverPic', 'remark_e'], 'safe'],
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
        $query = Articleinfo::find();

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
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'taskid', $this->taskid])
            ->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'lngCollectIDs', $this->lngCollectIDs])
            ->andFilterWhere(['like', 'keyword_e', $this->keyword_e])
            ->andFilterWhere(['like', 'author_e', $this->author_e])
            ->andFilterWhere(['like', 'imburse', $this->imburse])
            ->andFilterWhere(['like', 'class', $this->class])
            ->andFilterWhere(['like', 'media_c', $this->media_c])
            ->andFilterWhere(['like', 'num', $this->num])
            ->andFilterWhere(['like', 'lngid', $this->lngid])
            ->andFilterWhere(['like', 'pdfurl', $this->pdfurl])
            ->andFilterWhere(['like', 'beginpage', $this->beginpage])
            ->andFilterWhere(['like', 'showorgan', $this->showorgan])
            ->andFilterWhere(['like', 'pagecount', $this->pagecount])
            ->andFilterWhere(['like', 'years', $this->years])
            ->andFilterWhere(['like', 'title_c', $this->title_c])
            ->andFilterWhere(['like', 'endpage', $this->endpage])
            ->andFilterWhere(['like', 'remark_c', $this->remark_c])
            ->andFilterWhere(['like', 'keyword_c', $this->keyword_c])
            ->andFilterWhere(['like', 'title_e', $this->title_e])
            ->andFilterWhere(['like', 'media_e', $this->media_e])
            ->andFilterWhere(['like', 'showwriter', $this->showwriter])
            ->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'CoverPic', $this->CoverPic])
            ->andFilterWhere(['like', 'remark_e', $this->remark_e]);

        return $dataProvider;
    }
}
