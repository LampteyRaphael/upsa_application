<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblCourse;

/**
 * TblCourseSearch represents the model behind the search form of `common\models\TblCourse`.
 */
class TblCourseSearch extends TblCourse
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'level_id', 'semester', 'section_id', 'program_id'], 'integer'],
            [['course_name', 'course_number', 'course_description', 'date', 'required_courses', 'created_at', 'updated_at'], 'safe'],
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
        $query = TblCourse::find();

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
            'level_id' => $this->level_id,
            'semester' => $this->semester,
            'section_id' => $this->section_id,
            'program_id' => $this->program_id,
            'date' => $this->date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'course_name', $this->course_name])
            ->andFilterWhere(['like', 'course_number', $this->course_number])
            ->andFilterWhere(['like', 'course_description', $this->course_description])
            ->andFilterWhere(['like', 'required_courses', $this->required_courses]);

        return $dataProvider;
    }
}
