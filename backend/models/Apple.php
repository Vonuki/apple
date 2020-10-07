<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ActionType".
 *
 * @property int $idActionType
 * @property string $Name
 * @property int $idBehavior
 * @property int $idCompany
 * @property int $idGenStatus
 *
 * @property Company $company
 */
class Apple extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Apple';
    } 
  
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Color', 'State', 'Eaten'], 'required'],
            [['CreateDate', 'FallDate'], 'safe'],
            [['State', 'Eaten'], 'integer'],
            [['Color'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idApple' => 'Id Apple',
            'Color' => 'Color',
            'CreateDate' => 'Create Date',
            'FallDate' => 'Fall Date',
            'State' => 'State',
            'Eaten' => 'Eaten',
        ];
    }
  
    // Apple State Constatns
    const STATE_ONTREE = 0;
    const STATE_ONGROUND = 1;
    const STATE_BAD = 2;
    
    // States names array
    static function getStateTexts(){
      return array(
        self::STATE_ONTREE => 'On Tree', 
        self::STATE_ONGROUND => 'On ground', 
        self::STATE_BAD => 'Already Bad', 
      );  
    }
    
    //Get State Name
    function getStateName(){
      return $this->getStateTexts()[$this->State];
    }
  
  
    /**
     * Called automatic 
     * Init method for system fields fulfilment 
     */
    public function init() {
        parent::init();

        $this->State = self::STATE_ONTREE;
        $this->Color = $this->random_color();
        $this->CreateDate = $this->random_date();
        $this->Eaten = 0;
    }
  
     /**
    * Checks before Save (if apple already bad)
    */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) { return false; }
      
        if ($this->State == self::STATE_ONGROUND){
          $FallTime = strtotime($this->FallDate);
          $futureTime = $FallTime+(60*2); // wil lbe Bad in 2 minutes
          if (time()>=$futureTime){
            $this->State = self::STATE_BAD;
            Yii::$app->session->setFlash('error', "Apple #$this->idApple became already Bad (>2 min)");
          }   
        }
        return true;
    }
  
    /**
    * Fall of Apple
    */
    public function Fall()
    {
      if($this->State != self::STATE_ONTREE){
        return false;
      }
      else{
        $this->State = self::STATE_ONGROUND; 
        $this->FallDate = date("Y-m-d H:i:s",time());
        return true;
      }
    }    
  
    /**
    * Eate part of Apple
    */
    public function Eat($percent)
    {
      //Check if Apple is bad
      if ($this->State == self::STATE_ONGROUND){
          $this->Eaten = $this->Eaten + $percent;
        return true;
      }
      else{
        return false;
      }   
    }
  
    /**
    * Current Apple Size
    */
    public function getSize()
    {
      return 100 - $this->Eaten;
    }  
  
    //Random color geneartor:
    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }
    function random_color() {
        return "#".$this->random_color_part() .  $this->random_color_part() .  $this->random_color_part();
    }
    
    //Random Date generator
    function random_date(){
        $int= rand(1262055681,1489686923);
        $date = date("Y-m-d H:i:s",$int);
        return $date;
    }
  
}
