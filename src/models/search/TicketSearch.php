<?php

namespace nikitakls\support\models\search;

use nikitakls\support\models\Ticket;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * SupportRequestSearch represents the model behind the search form of `nikitakls\support\models\SupportRequest`.
 */
class TicketSearch extends Ticket
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'parent_id', 'status', 'level', 'created_at', 'user_id'], 'integer'],
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
    public function search($params, $with = [], $userId = null)
    {
        $query = Ticket::find();
        $query->with($with);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'level' => $this->level,
            'created_at' => $this->created_at,
            'user_id' => is_null($userId) ? $this->user_id : $userId,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'fio', $this->fio]);


        return $dataProvider;
    }

}
