<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class Project extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * Define relation with User model
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'assigned_to']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'status', 'assigned_to'], 'required'],
            [['description'], 'string'],
            [['status', 'assigned_to'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'assigned_to' => 'Assigned To',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
   
}
