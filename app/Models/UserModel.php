<?php
namespace App\Models;

use App\Framework\Model\BaseModel;
use App\Framework\Schema\Schema;

class UserModel extends BaseModel {
    protected static $tableName = 'users';


    public static function table() {
        $schema = new Schema(self::$tableName);
        $schema->id();
        $schema->string('username');
        $schema->string('password');
        $schema->string('firstname');
        $schema->string('email');
        $schema->string('lastname');
        $schema->create();
    }
}

?>