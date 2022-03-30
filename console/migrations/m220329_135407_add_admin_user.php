<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m220329_135407_add_admin_user
 */
class m220329_135407_add_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@mail.com';
        $user->setPassword('admin');
        $user->generateAuthKey();
        $user->save(false);

        $auth = Yii::$app->authManager;
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->assign($admin, $user->id);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220329_135407_add_admin_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220329_135407_add_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
