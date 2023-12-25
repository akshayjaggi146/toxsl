<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Project;

class ProjectSearch extends Project
{
    public function rules()
    {
        return [
            // Define your search rules here...
        ];
    }

    public function search($params)
    {
        $query = Project::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }


        return $dataProvider;
    }
}
