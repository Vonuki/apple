<?php

use yii\db\Migration;

/**
 * Class m201006_162106_apple
 */
class m201006_162106_apple extends Migration
{
    public function init()
    {
        $this->db = 'db';
        parent::init();
    }
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'ENGINE=InnoDB';

        $this->createTable(
            '{{%apple}}',
            [
                'idApple'=> $this->primaryKey(11)->comment('ID Apple'),
                'Color'=> $this->string(20)->notNull()->comment('Color'),
                'CreateDate' => $this->timestamp()->notNull()->defaultExpression("CURRENT_TIMESTAMP")->comment('Create Date'),
                'FallDate' => $this->timestamp()->null()->defaultValue(null)->comment('Fall Date'),
                'State' => $this->integer(11)->notNull()->comment('State of apple'),
                'Eaten' => $this->integer(11)->notNull()->comment('Percent of eaten'),
            ],$tableOptions
        );
      
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }

}
