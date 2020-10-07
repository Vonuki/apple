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
        self::STATE_ONGROUND => 'Fall on ground', 
        self::STATE_BAD => 'Already Bad', 
      );  
    }
  
  
    /**
     * Called automatic on Event
     * Init method for system fields fulfilment 
     */
    public function init() {
        parent::init();

        $this->State = self::STATE_ONTREE;
    }
  
    
//     /**
//     * Archive General Model
//     */
//     public function archive() {
//         $this->State = self::STATUS_ARCHIVED;
        
//     }
  
//     /**
//     * Activate General Model
//     */
//     public function activate() {
//         $this->idGenStatus = self::STATUS_ACTIVE;

//     }

//     /**
//      * Search models for incoming Phrase. 
//      * @param string $phrase
//      * @return ArrayDataProvider
//      */
//     public function searchModel($phrases, $idCompany)
//     {
//         $models = self::find() -> where(['idCompany'=>$idCompany]) -> andWhere(['or like', 'Name', $phrases]) -> all();
//         return $models;

//     }
  
}
