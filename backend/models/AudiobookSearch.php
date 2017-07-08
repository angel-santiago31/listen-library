<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Audiobook;

/**
 * AudiobookSearch represents the model behind the search form about `backend\models\Audiobook`.
 */
class AudiobookSearch extends Audiobook
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'genre', 'is_fiction', 'author_id', 'narrator_id', 'release_date', 'publisher_id'], 'integer'],
            [['title', 'length'], 'safe'],
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
        $query = Audiobook::find();

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
            'genre' => $this->genre,
            'is_fiction' => $this->is_fiction,
            'author_id' => $this->author_id,
            'narrator_id' => $this->narrator_id,
            'release_date' => $this->release_date,
            'publisher_id' => $this->publisher_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'length', $this->length]);

        return $dataProvider;
    }
}
