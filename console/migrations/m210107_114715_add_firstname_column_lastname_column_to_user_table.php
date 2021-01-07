<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m210107_114715_add_firstname_column_lastname_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'firstname', $this->string(255)->notNull());
        $this->addColumn('{{%user}}', 'lastname', $this->string(255)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'firstname');
        $this->dropColumn('{{%user}}', 'lastname');
    }
}
