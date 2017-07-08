<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "audiobook".
 *
 * @property integer $id
 * @property string $title
 * @property integer $genre
 * @property integer $is_fiction
 * @property integer $author_id
 * @property integer $narrator_id
 * @property string $length
 * @property integer $release_date
 * @property integer $publisher_id
 *
 * @property Author $author
 * @property Narrator $narrator
 * @property Publisher $publisher
 * @property Contains[] $contains
 */
class Audiobook extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'audiobook';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'genre', 'is_fiction', 'author_id', 'narrator_id', 'length', 'release_date', 'publisher_id'], 'required'],
            [['genre', 'is_fiction', 'author_id', 'narrator_id', 'release_date', 'publisher_id'], 'integer'],
            [['title'], 'string', 'max' => 64],
            [['length'], 'string', 'max' => 18],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Author::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['narrator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Narrator::className(), 'targetAttribute' => ['narrator_id' => 'id']],
            [['publisher_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publisher::className(), 'targetAttribute' => ['publisher_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Audiobook Id',
            'title' => 'Title',
            'genre' => 'Genre',
            'is_fiction' => 'Is Fiction?',
            'author_id' => 'Author Id',
            'narrator_id' => 'Narrator Id',
            'length' => 'Length',
            'release_date' => 'Release Date',
            'publisher_id' => 'Publisher Id',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNarrator()
    {
        return $this->hasOne(Narrator::className(), ['id' => 'narrator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(Publisher::className(), ['id' => 'publisher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContains()
    {
        return $this->hasMany(Contains::className(), ['audiobook_id' => 'id']);
    }
}
