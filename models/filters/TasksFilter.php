<?php

	namespace app\models\filters;

	use Yii;
	use yii\base\Model;
	use yii\caching\TagDependency;
	use yii\data\ActiveDataProvider;
	use app\models\tables\Tasks;

	/**
	 * TasksFilter represents the model behind the search form of `app\models\tables\Tasks`.
	 */
	class TasksFilter extends Tasks
	{
		/**
		 * {@inheritdoc}
		 */
		public function rules()
		{
			return [
				[['id', 'creator_id', 'responsible_id', 'status_id'], 'integer'],
				[['title', 'description', 'deadline'], 'safe'],
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
			$query = Tasks::find();

			// add conditions that should always apply here

			$dataProvider = new ActiveDataProvider([
				'pagination' => [
					'pageSize' => 4,
				],
				'query'      => $query,
			]);

			$this->load($params);

			if (!$this->validate()) {
				// uncomment the following line if you do not want to return any records when validation fails
				// $query->where('0=1');
				return $dataProvider;
			}

			// grid filtering conditions
			$query->andFilterWhere([
				'id'             => $this->id,
				'creator_id'     => $this->creator_id,
				'responsible_id' => $this->responsible_id,
				'deadline'       => $this->deadline,
				'status_id'      => $this->status_id,
			]);

			$query->andFilterWhere(['like', 'title', $this->title])
				->andFilterWhere(['like', 'description', $this->description]);

			return $dataProvider;
		}

		public function searchByMonth($month): ActiveDataProvider
		{
			$query = Tasks::find();

			if ($month) {
				$query->where("MONTH(created_at) = {$month}");
			}

			$dataProvider = new ActiveDataProvider(
				[
					'query'      => $query,
					'pagination' => [
						'pageSize' => 3,
					],
				]);

			Yii::$app->db->cache(function () use ($dataProvider) {
				$dataProvider->prepare();
			}, 0, new TagDependency(['tags' => 'cache_tasks_month']));

			return $dataProvider;
		}
	}
