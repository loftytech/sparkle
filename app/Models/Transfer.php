<?php
namespace App\Models;

use App\Framework\Model\BaseModel;
use App\Framework\Schema\Schema;
use App\Utilities\Response;

class Transfer extends BaseModel {
    protected static $tableName = 'transfer';
    protected $useTimestamps = false;

    public static function table() {
        // echo "\033[32m lofty ".self::$tableName." migrated successfully \033[0m\n";
        $schema = new Schema(self::$tableName, true);
        $schema->integer('id')->autoIncrement()->primary();
        $schema->string('from_user');
        $schema->string('to_user');
        $schema->string('reference');
        $schema->string('gateway_reference');
        $schema->text('meta');
        $schema->string('status', 10);
        $schema->create();
    }
}

?>