<?php

    namespace app\models;

    use yii\db\ActiveRecord;

    class Products extends ActiveRecord{

        private $title , $description , $price;

        public function rules(){
            return[
                [['title' , 'description' , 'price'],'required'],
            ];
        }
        public static function tableName(){
            return "products";
        }
    }
?>