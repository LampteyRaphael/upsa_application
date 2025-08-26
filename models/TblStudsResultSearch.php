<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TblStudsResult;

/**
 * TblStudsResultSearch represents the model behind the search form of `common\models\TblStudsResult`.
 */
class TblStudsResultSearch extends TblStudsResult
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'course_id', 'semester', 'section_id', 'class_marks', 'exams_marks', 'total_marks', 'grade_id', 'status', 'course_lecture_id', 'acadamic_year'], 'integer'],
            [['date_of_entry', 'created_at', 'updated_at'], 'safe'],
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
        $query = TblStudsResult::find();

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
            'student_id' => $this->student_id,
            'course_id' => $this->course_id,
            'semester' => $this->semester,
            'section_id' => $this->section_id,
            'class_marks' => $this->class_marks,
            'exams_marks' => $this->exams_marks,
            'total_marks' => $this->total_marks,
            'grade_id' => $this->grade_id,
            'status' => $this->status,
            'date_of_entry' => $this->date_of_entry,
            'course_lecture_id' => $this->course_lecture_id,
            'acadamic_year' => $this->acadamic_year,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}
