<?php

namespace common\models;

use Yii;
use linslin\yii2\curl;
/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string|null $text
 */
class News extends \yii\db\ActiveRecord
{
    public $date;

    public function generateText()
    {
        $curl = new curl\Curl();
        $words_number = random_int(1,30);
        $text = $curl->get("http://random-word-api.herokuapp.com//word?number=$words_number");
        $text = explode(',',preg_replace('/\[(.*)\]/','$1',$text));
        foreach ($text as $i => $word){
            $text[$i] = preg_replace('/\"(.*)\"/','$1',$text[$i]);
        }
        $this->text = implode(' ', $text);
    }

    public static function getSortedNews()
    {
        $news = News::find()->all();
        //$cookies = Yii::$app->request->cookies;
        //var_dump($_COOKIE);
        foreach($news as $i => $new){
            if(isset($_COOKIE[$new->id]))
                $news[$i]->date = $_COOKIE["{$new->id}"];
            else
                $news[$i]->date = date('Y-m-d H:i:s',strtotime('-2 years'));

        }
        usort($news, function($a, $b) {return strtotime($a->date) < strtotime($b->date) ? -1 : 1;});

        return $news;
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Text',
        ];
    }
}
