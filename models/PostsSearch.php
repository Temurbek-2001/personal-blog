<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Posts;

/**
 * PostsSearch represents the model behind the search form of `app\models\Posts`.
 */
class PostsSearch extends Posts
{
    public $categoryName; // Add a public property for category name

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'category_id'], 'integer'],
            [['title', 'content', 'created_at', 'updated_at', 'categoryName'], 'safe'], // Add 'categoryName' to safe attributes
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Posts::find()->joinWith(['category' => function ($query) {
            $query->alias('categories'); // Use the actual table name or desired alias
        }]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['categoryName'] = [
            'asc' => ['categories.name' => SORT_ASC],
            'desc' => ['categories.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'posts.title', $this->title])
            ->andFilterWhere(['like', 'posts.content', $this->content])
            ->andFilterWhere(['like', 'categories.name', $this->categoryName]); // Use correct alias

        return $dataProvider;
    }


}
