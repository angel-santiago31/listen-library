<?php

namespace backend\models;

use Yii;
use backend\models\Author;
use backend\models\Genre;
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
 * @property double $price
 * @property double $cost
 * @property string $picture
 * @property string $summary
 * @property integer $active
 *
 * @property Author $author
 * @property Narrator $narrator
 * @property Publisher $publisher
 * @property Contains[] $contains
 */
class Audiobook extends \yii\db\ActiveRecord implements \yz\shoppingcart\CartPositionInterface
{
    use \yz\shoppingcart\CartPositionTrait;

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

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
            [['genre', 'is_fiction', 'author_id', 'narrator_id', 'length', 'release_date', 'publisher_id', 'price', 'cost', 'picture', 'summary'], 'required'],
            [['genre', 'is_fiction', 'author_id', 'narrator_id', 'publisher_id', 'active'], 'integer'],
            [['release_date', 'title'], 'safe'],
            [['price', 'cost'], 'number'],
            [['title'], 'string', 'max' => 64],
            [['length'], 'string', 'max' => 18],
            [['picture', 'summary'], 'string', 'max' => 256],
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
            'id' => 'ID',
            'title' => 'Title',
            'genre' => 'Genre',
            'is_fiction' => 'Is Fiction',
            'author_id' => 'Author ID',
            'narrator_id' => 'Narrator ID',
            'length' => 'Length',
            'release_date' => 'Release Date',
            'publisher_id' => 'Publisher ID',
            'price' => 'Price',
            'cost' => 'Cost',
            'picture' => 'Picture',
            'summary' => 'Summary',
            'active' => 'Active',
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

    public function getAuthorName()
    {
        $author = Author::find()->where(['id' => $this->author_id])->one();

        return $author->name;
    }

    public function getGenreName()
    {
        $genre = Genre::find()->where(['id' => $this->genre])->one();

        return $genre->genre;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }
}
