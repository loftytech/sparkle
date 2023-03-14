<?php
namespace App\Models;

use App\Framework\Model\BaseModel;
use App\Framework\Schema\Schema;
use App\Utilities\Response;

class Profile extends BaseModel {
    protected static $tableName = 'profile';

    public static function table() {
        $schema = new Schema(self::$tableName);
        $schema->integer('id')->autoIncrement()->primary();
        $schema->string('username');
        $schema->string('email');
        $schema->create();
    }

    public static function checkTable() {
        $data = self::analizeTable(self::$tableName);

        Response::send(
            [
                "data"=>$data
            ]
        );
    }
    
}

?>