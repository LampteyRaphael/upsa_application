<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblRegisCourse;

/**
 * TblRegisCourseSearch represents the model behind the search form of `common\models\TblRegisCourse`.
 */
class TblRegisCourseSearch extends TblRegisCourse
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'semester_id', 'acadamic_year', 'stud_regis_id', 'course_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
        $query = TblRegisCourse::find();

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
            'semester_id' => $this->semester_id,
            'acadamic_year' => $this->acadamic_year,
            'stud_regis_id' => $this->stud_regis_id,
            'course_id' => $this->course_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
