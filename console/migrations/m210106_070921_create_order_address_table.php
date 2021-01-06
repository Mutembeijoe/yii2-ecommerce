<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_address}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%order}}`
 */
class m210106_070921_create_order_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_address}}', [
            'order_id' => $this->integer(11)->notNull(),
            'address' => $this->string(255)->notNull(),
            'city' => $this->string(255)->notNull(),
            'state' => $this->string(255)->notNull(),
            'country' => $this->string(255)->notNull(),
            'postal_code' => $this->string(255),
        ]);

        //  adds order_id as primary_key: THIS IS NECESSARY AS IT IS ALSO USED AS A FOREIGN_KEY
        $this->addPrimaryKey('{{%pk-order_address}}', '{{%order_address}}', 'order_id');


        // creates index for column `order_id`
        $this->createIndex(
            '{{%idx-order_address-order_id}}',
            '{{%order_address}}',
            'order_id'
        );

        // add foreign key for table `{{%order}}`
        $this->addForeignKey(
            '{{%fk-order_address-order_id}}',
            '{{%order_address}}',
            'order_id',
            '{{%order}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%order}}`
        $this->dropForeignKey(
            '{{%fk-order_address-order_id}}',
            '{{%order_address}}'
        );

        // drops index for column `order_id`
        $this->dropIndex(
            '{{%idx-order_address-order_id}}',
            '{{%order_address}}'
        );

        $this->dropTable('{{%order_address}}');
    }
}
