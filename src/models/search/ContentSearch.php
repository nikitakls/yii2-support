<?php

namespace nikitakls\support\models\search;

use nikitakls\support\models\Content;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ContentSearch represents the model behind the search form of `nikitakls\support\models\Content`.
 */
class ContentSearch extends Content
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ticket_id', 'type', 'user_id', 'created_at', 'sending_at'], 'integer'],
            [['message', 'filename'], 'safe'],
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
        $query = Content::find();

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
            'ticket_id' => $this->ticket_id,
            'type' => $this->type,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'sending_at' => $this->sending_at,
        ]);

        $query->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'filename', $this->filename]);

        return $dataProvider;
    }

}
