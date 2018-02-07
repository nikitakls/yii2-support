<?php

namespace nikitakls\support\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use nikitakls\support\models\SupportRequest;

/**
 * SupportRequestSearch represents the model behind the search form of `nikitakls\support\models\SupportRequest`.
 */
class SupportRequestSearch extends SupportRequest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'parent_id', 'status', 'answered', 'created_at', 'sending_at', 'user_id'], 'integer'],
            [['filename', 'title', 'message', 'email', 'fio'], 'safe'],
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
        $query = SupportRequest::find();

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
            'category_id' => $this->category_id,
            'parent_id' => $this->parent_id,
            'status' => $this->status,
            'answered' => $this->answered,
            'created_at' => $this->created_at,
            'sending_at' => $this->sending_at,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'fio', $this->fio]);

        return $dataProvider;
    }

}
