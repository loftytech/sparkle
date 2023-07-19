<?php
namespace App\Framework\Schema;

use App\Framework\Database\Database as DB;
use App\Framework\Utilities\Log;

class Schema {
    protected $tableName;
    protected $useTimestamps = true;
    protected $schema_sql = "";
    protected $primary_key = "";
    protected $current_column = "";
    protected $current_column_index = -1;

    protected $num_primary_keys = 0;


    protected $skippedMigration = false;

    private bool $isTableExist = false;
    private array $newColumnList = [];
    private array $savedColumnList = [];

    private array $modificationList = [];
    private array $columnDropList = [];
    private array $replacedColumnList = [];

    public function __construct(string $tableName, bool $timestamps = true) {
        $this->useTimestamps = $timestamps;
        $this->tableName = $tableName;
        $this->checkTable();
    }

    public function disableTimestamps() {
        $this->useTimestamps = false;
    }

    public function string(string $column, int $length = 64) {
        $this->checkTableExists($column);
        $this->current_column_index = $this->current_column_index + 1;
        array_push($this->newColumnList, [
            "Field" => $column,
            "Type" => "varchar($length)",
            "Null" => "NO",
            "Key" => "",
            "Default" => null,
            "Extra" => "",
        ]);
        $this->current_column = $column;
        $append_comma = "";
        if (strlen($this->schema_sql) > 1) {
            $append_comma = ",";
        }
        $this->schema_sql = $this->schema_sql . $append_comma ." `". $column ."` varchar(".$length.") NOT NULL";
        $this->current_column = $column;
        return $this;
    }


    public function text(string $column) {
        $this->checkTableExists($column);
        $this->current_column_index = $this->current_column_index + 1;
        array_push($this->newColumnList, [
            "Field" => $column,
            "Type" => "text",
            "Null" => "NO",
            "Key" => "",
            "Default" => null,
            "Extra" => "",
        ]);
        $this->current_column = $column;
        $append_comma = "";
        if (strlen($this->schema_sql) > 1) {
            $append_comma = ",";
        }
        $this->schema_sql = $this->schema_sql . $append_comma ." `". $column ."` text NOT NULL";
        $this->current_column = $column;
        return $this;
    }

    
    public function integer(string $column, int $length = 11) {
        $this->checkTableExists($column);
        $this->current_column_index = $this->current_column_index + 1;
        array_push($this->newColumnList, [
            "Field" => $column,
            "Type" => "int($length)",
            "Null" => "NO",
            "Key" => "",
            "Default" => null,
            "Extra" => "",
        ]);
        $this->current_column = $column;
        $append_comma = "";
        if (strlen($this->schema_sql) > 1) {
            $append_comma = ",";
        }
    
        $this->schema_sql = $this->schema_sql . $append_comma ." `". $column ."` int(".$length.") NOT NULL";
        return $this;
    }


    public function double(string $column, int $length = 11) {
        $this->checkTableExists($column);
        $this->current_column_index = $this->current_column_index + 1;
        array_push($this->newColumnList, [
            "Field" => $column,
            "Type" => "double",
            "Null" => "NO",
            "Key" => "",
            "Default" => null,
            "Extra" => "",
        ]);
        $this->current_column = $column;
        $append_comma = "";
        if (strlen($this->schema_sql) > 1) {
            $append_comma = ",";
        }
    
        $this->schema_sql = $this->schema_sql . $append_comma ." `". $column ."` double NOT NULL";
        return $this;
    }



    public function datetime(string $column, int $length = 11) {
        $this->checkTableExists($column);
        $this->current_column_index = $this->current_column_index + 1;
        array_push($this->newColumnList, [
            "Field" => $column,
            "Type" => "datetime",
            "Null" => "NO",
            "Key" => "",
            "Default" => "current_timestamp()",
            "Extra" => "",
        ]);
        $this->current_column = $column;
        $append_comma = "";
        if (strlen($this->schema_sql) > 1) {
            $append_comma = ",";
        }
    
        $this->schema_sql = $this->schema_sql . $append_comma ." `". $column ."` datetime NOT NULL";
        return $this;
    }


    public function id(string $column = 'id', int $length = 11) {
        $this->checkTableExists($column);
        $this->current_column_index = $this->current_column_index + 1;
        array_push($this->newColumnList, [
            "Field" => $column,
            "Type" => "bigint($length)",
            "Null" => "NO",
            "Key" => "PRI",
            "Default" => null,
            "Extra" => "auto_increment",
        ]);
        $this->current_column = $column;
        $append_comma = "";
        if (strlen($this->schema_sql) > 1) {
            $append_comma = ",";
        }
    
        $this->schema_sql = $this->schema_sql . $append_comma ." `". $column ."` bigint(".$length.") NOT NULL AUTO_INCREMENT";
        $this->primary_key = ", PRIMARY KEY (".$column.")";
    }

    public function autoIncrement() {
        $this->newColumnList[$this->current_column_index]["Extra"] = "auto_increment";
        $this->schema_sql = $this->schema_sql . " AUTO_INCREMENT";
        return $this;
    }

    public function primary() {
        if ($this->num_primary_keys > 0) {
            echo "\e[0;31;40m Aborting migration: Duplicate primary keys detected in ".$this->tableName." table there can only be one auto column and it must be defined as a key \e[0m\n";
            exit(1);
        }
        $this->newColumnList[$this->current_column_index]["Key"] = "PRI";
        $this->primary_key = ", PRIMARY KEY (".$this->current_column.")";
        $this->num_primary_keys = $this->num_primary_keys+1;
    }

    private function checkTableExists ($newColumn) {
        if (strlen(trim($newColumn)) < 1) {
            echo "\e[0;31;40m Aborting migration: Empty column detected in ".$this->tableName." table. Columns can't be empty \e[0m\n";
            exit(1);
        }
        foreach ( $this->newColumnList as $column) {
            if (in_array($newColumn, $column)) {
                echo "\e[0;31;40m Aborting migration: Duplicate colunm `".$newColumn."` detected in ".$this->tableName." table. Columns must be unique \e[0m\n";
                exit(1);
            }
        }
    }

    private function enableTimestamps() {
        $this->checkTableExists("date_created");
        $this->checkTableExists("date_updated");
        $this->current_column_index = $this->current_column_index + 1;
        array_push($this->newColumnList, [
            "Field" => "date_created",
            "Type" => "datetime",
            "Null" => "NO",
            "Key" => "",
            "Default" => "current_timestamp()",
            "Extra" => "",
        ]);
        array_push($this->newColumnList, [
            "Field" => "date_updated",
            "Type" => "datetime",
            "Null" => "NO",
            "Key" => "",
            "Default" => "current_timestamp()",
            "Extra" => "",
        ]);
    }

    public function create() {
        if (!$this->isTableExist) {

            if ($this->useTimestamps) {
                $this->schema_sql = $this->schema_sql . ", `date_created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, `date_updated` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP";
            }

            // echo "\e[0;35;40m".$this->tableName." doesn't exist \e[0m\n";
            $create_table_query = "CREATE TABLE IF NOT EXISTS ". $this->tableName . " (". $this->schema_sql  . $this->primary_key.") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
            // error_log("\n\n".$create_table_query."\n\n");
            DB::query($create_table_query);
            echo "\033[32m ".$this->tableName." table created successfully \033[0m\n";
        } else {
            if ($this->useTimestamps) {
                $this->enableTimestamps();
            }
            $this->compareColumns();
            foreach ($this->columnDropList as $column_drop_query) {
                // Log::warning($column_drop_query["sql"]);
                DB::query($column_drop_query["sql"]);
            }
            foreach ($this->modificationList as $modification) {
                if ($modification["operation_type"] == "ALTER_CHANGE_COLUMN") {
                    if (in_array($modification["from"], $this->replacedColumnList)) {
                        $checkedColumn = $this->checkColumnExists($modification["to"]);
                        if ($checkedColumn->exists) {
                            if ($modification["from"] != $modification["to"]) {
                                array_push($this->replacedColumnList, $modification["to"]);
                                $column = $this->getColumnType($checkedColumn->data->Type);
                                $this->buildAndRunQuery(queryType: "ALTER_CHANGE_COLUMN", from: $modification["to"], to: $modification["to"]."_ALTERED", type: $column->type, limit: $column->limit, fromType: $modification["from_type"], toType: $modification["to_type"], extras: $checkedColumn->data->Extra);
                            }
                        }

                        $new_sql = str_replace("CHANGE `".$modification["from"]."`", "CHANGE `".$modification["from"]."_ALTERED`", $modification["sql"]);
                        // echo "\033[32m ".$new_sql." \033[0m\n";
                        DB::query($new_sql);
                    } else {
                        $checkedColumn = $this->checkColumnExists($modification["to"]);
                        if ($checkedColumn->exists) {
                            if ($modification["from"] != $modification["to"]) {
                                array_push($this->replacedColumnList, $modification["to"]);
                                $column = $this->getColumnType($checkedColumn->data->Type);

                                $this->buildAndRunQuery(queryType: "ALTER_CHANGE_COLUMN", from: $modification["to"], to: $modification["to"]."_ALTERED", type: $column->type, limit: $column->limit, fromType: $modification["from_type"], toType: $modification["to_type"], extras: $checkedColumn->data->Extra);
                                $this->clearColumn(from: $modification["from"], to: $modification["to"], fromType: $modification["from_type"], toType: $modification["to_type"]);
                                // Log::neutral($modification["sql"]);
                                DB::query($modification["sql"]);
                            } else {
                                $this->clearColumn(from: $modification["from"], to: $modification["to"], fromType: $modification["from_type"], toType: $modification["to_type"]);
                                // Log::neutral($modification["sql"]);
                                DB::query($modification["sql"]);
                            }
                        } else {
                            $this->clearColumn(from: $modification["from"], to: $modification["to"], fromType: $modification["from_type"], toType: $modification["to_type"]);
                            // Log::neutral($modification["sql"]);
                            DB::query($modification["sql"]);
                        }
                    }

                    // Log::neutral($modification["sql"]);
                } else {
                    // Log::neutral($modification["sql"]);
                    DB::query($modification["sql"]);
                }

            }

            if (!$this->skippedMigration) {
                echo "\033[32m ".$this->tableName." table migrated successfully \033[0m\n";
            }
        }
    }

    public function checkTable() {
        $data = DB::checkTable($this->tableName);
        if (count($data) > 0) {
            $this->isTableExist = true;
            $this->describeTable();
        }
        return $data;
    }

    private function checkColumnExists ($column) {
        $query = "DESCRIBE ". $this->tableName;
        $data = DB::query($query, [], true);

        $colunm_data = "";

        $column_exists = false;

        foreach ($data as $savedColumnKey => $savedColumn) {
            if (in_array($column, $savedColumn)) {
                $colunm_data = (object) $data[$savedColumnKey];
                $column_exists = true;
                break;
            }
        }
        // echo "\n\n\ncolumn ".$column." exist: " . $column_exists."\n\n\n";

        $body = (object) ["exists" => $column_exists, "data"=>$colunm_data];

        return $body;
    }

    public function describeTable() {
        $query = "DESCRIBE ". $this->tableName;
        $data = DB::query($query, [], true);
        $table_columns = count($data);
        if($this->useTimestamps) {
            if ($data[$table_columns-2]["Field"] == "date_created" && $data[$table_columns-1]["Field"] == "date_updated") {
                unset($data[$table_columns-1]);
                unset($data[$table_columns-2]);
            }
        }
        // Log::success("====== saved columns ======");
        // Log::neutral(print_r($data));
        $this->savedColumnList = array_values($data);

    }
    public function removeTimestampsFromNewColumns () {
        $query = "DESCRIBE ". $this->tableName;
        $data = $this->newColumnList;
        $table_columns = count($data);
        if($this->useTimestamps) {
            if ($data[$table_columns-2]["Field"] == "date_created" && $data[$table_columns-1]["Field"] == "date_updated") {
                unset($data[$table_columns-1]);
                unset($data[$table_columns-2]);
            }
        }
        // Log::success("====== new columns ======");
        // Log::neutral(print_r($data));
        $this->newColumnList = array_values($data);
    }

    public function compareColumns() {
        $this->removeTimestampsFromNewColumns();
        if (count($this->newColumnList) == count($this->savedColumnList)) {
            $this->compareAndAlterColumns();
        } else {
            $this->getNewColumns();
        }
    }

    public function compareAndAlterColumns() {
        // echo "\n\n\n\n\e[0;35;35m new:  ". print_r($this->newColumnList) ." in " .$this->tableName." \e[0m\n\n\n\n\n";
        // echo "\n\n\n\n\e[0;35;35m saved:  ". print_r($this->savedColumnList) ." in " .$this->tableName." \e[0m\n\n\n\n\n";

        $is_columns_match = false;
        if (json_encode($this->newColumnList) == json_encode($this->savedColumnList)) {
            $is_columns_match = true;
        }

        if ($is_columns_match) {
            $this->skippedMigration = true;
            echo "\e[0;35;35m Skipping ".$this->tableName." table because no changes was found \e[0m\n";
        } else {
            foreach ($this->newColumnList as $newColumnkey => $column) {
                $new_column = $this->getColumnType($column["Type"]);
    
                $add_primary_key = "";
                $auto_increment_sub_query = "";
    
                $saved_column_to_alter = $this->savedColumnList[$newColumnkey];
    
                
                if ($column["Extra"] == "auto_increment" && $saved_column_to_alter["Extra"] != "auto_increment" && $saved_column_to_alter["Key"] != "PRI" && $column["Key"] == "PRI") {
                    $add_primary_key = ", add PRIMARY KEY (`".$column["Field"]."`)";
                    $auto_increment_sub_query = " AUTO_INCREMENT";
    
                    // echo "lofty yessssss ".$saved_column_to_alter["Field"];
                }
    
                if ($column["Extra"] == "auto_increment" && $saved_column_to_alter["Extra"] != "auto_increment" && $saved_column_to_alter["Key"] == "PRI" && $column["Key"] == "PRI") {
                    $auto_increment_sub_query = " AUTO_INCREMENT";
                }
    
                if ($column["Extra"] == "auto_increment" && $saved_column_to_alter["Extra"] != "auto_increment" && $saved_column_to_alter["Key"] == "PRI") {
                    $auto_increment_sub_query = " AUTO_INCREMENT";
                }
            
                if ($column["Extra"] == "auto_increment" && $saved_column_to_alter["Extra"] == "auto_increment") {
                    $auto_increment_sub_query = " AUTO_INCREMENT";
                }

                $mod_sql = "ALTER TABLE `".$this->tableName."` CHANGE `".$saved_column_to_alter["Field"]."` `".$column["Field"]."` ".$new_column?->type."(".$new_column->limit.") NOT NULL ".$auto_increment_sub_query." ".$add_primary_key."; ";
                
                if ($new_column?->type == "text") {
                    $mod_sql = "ALTER TABLE `".$this->tableName."` CHANGE `".$saved_column_to_alter["Field"]."` `".$column["Field"]."` ".$new_column?->type." NOT NULL ".$auto_increment_sub_query." ".$add_primary_key."; ";
                } else if ($new_column?->type == "double") {
                    $mod_sql = "ALTER TABLE `".$this->tableName."` CHANGE `".$saved_column_to_alter["Field"]."` `".$column["Field"]."` ".$new_column?->type." NOT NULL ".$auto_increment_sub_query." ".$add_primary_key."; ";
                } else if ($new_column?->type == "datetime") {
                    $mod_sql = "ALTER TABLE `".$this->tableName."` CHANGE `".$saved_column_to_alter["Field"]."` `".$column["Field"]."` DATETIME NOT NULL DEFAULT ". $column["Default"]. "; ";
                }
        
                array_push($this->modificationList,
                    [
                        "sql"=>$mod_sql,
                        "from"=>$saved_column_to_alter["Field"],
                        "to"=>$column["Field"],
                        "from_type"=>$saved_column_to_alter["Type"],
                        "to_type"=>$column["Type"],
                        "operation_type"=>"ALTER_CHANGE_COLUMN"
                    ]
                );
    
    
                if ($column["Extra"] != "auto_increment" && $saved_column_to_alter["Extra"] != "auto_increment" && $saved_column_to_alter["Key"] != "PRI" && $column["Key"] == "PRI") {
                    array_push($this->modificationList,
                        [
                            "sql"=>"ALTER TABLE `".$this->tableName."` ADD PRIMARY KEY(`".$column["Field"]."`);",
                            "operation_type"=>"ALTER_ADD_PRIMARY_KEY"
                        ]
                    );
                }

                if ($column["Extra"] != "auto_increment" && $saved_column_to_alter["Extra"] != "auto_increment" && $saved_column_to_alter["Key"] == "PRI" && $column["Key"] != "PRI") {
    
                    array_push($this->columnDropList,
                        [
                            "sql"=>"ALTER TABLE `".$this->tableName."` DROP PRIMARY KEY;",
                            "operation_type"=>"ALTER_DROP_PRIMARY_KEY"
                        ]
                    );
                }

                /*
                *  Check if new column has a primary key
                */
    
                if ($column["Extra"] != "auto_increment" && $saved_column_to_alter["Extra"] == "auto_increment" && $saved_column_to_alter["Key"] == "PRI" && $column["Key"] != "PRI") {
    

                    /*
                    *  Remove auto increment from current column
                    */
                    array_push($this->columnDropList,
                        [
                            "sql"=>"ALTER TABLE `".$this->tableName."` CHANGE `".$saved_column_to_alter["Field"]."` `".$saved_column_to_alter["Field"]."` ".$saved_column_to_alter["Type"]." NOT NULL; ",
                            "from"=>$saved_column_to_alter["Field"],
                            "to"=>$saved_column_to_alter["Field"],
                            "operation_type"=>"ALTER_CHANGE_COLUMN"
                        ]
                    );
                    
                    /*
                    *  Remove primary key from table
                    */
                    array_push($this->columnDropList,
                        [
                            "sql"=>"ALTER TABLE `".$this->tableName."` DROP PRIMARY KEY;",
                            "operation_type"=>"ALTER_DROP_PRIMARY_KEY"
                        ]
                    );
                }
            }
        }

        // echo print_r($this->modificationList);
    }

    public function getColumnType(string $field) {
        $field_arry = explode("(", $field);

        if (str_contains($field, "(")) {
            return (object) ['type'=>$field_arry[0], 'limit'=> str_replace(")", "", $field_arry[1])];
        } else {
            return (object) ['type'=>$field, 'limit'=> 1];
        }

    }

    public function compareAndAlterExsitingColumns() {
        // echo "\n\n\n\n\e[0;35;35m new:  ". print_r($this->newColumnList) ." in " .$this->tableName." \e[0m\n\n\n\n\n";
        // echo "\n\n\n\n\e[0;35;35m saved:  ". print_r($this->savedColumnList) ." in " .$this->tableName." \e[0m\n\n\n\n\n";

        $this->filterColumnsToDrop();

        $saved_table_length = count($this->savedColumnList);
        foreach ($this->newColumnList as $newColumnkey => $column) {
            $new_column = $this->getColumnType($column["Type"]);

            $auto_increment_sub_query = "";
            $add_primary_key = "";

            if ($newColumnkey < $saved_table_length) {
                $saved_column_to_alter = $this->savedColumnList[$newColumnkey];

                
                if ($column["Extra"] == "auto_increment" && $saved_column_to_alter["Extra"] != "auto_increment" && $saved_column_to_alter["Key"] != "PRI" && $column["Key"] == "PRI") {
                    $add_primary_key = ", add PRIMARY KEY (`".$column["Field"]."`)";
                    $auto_increment_sub_query = " AUTO_INCREMENT";
                }

                if ($column["Extra"] == "auto_increment" && $saved_column_to_alter["Extra"] != "auto_increment" && $saved_column_to_alter["Key"] == "PRI" && $column["Key"] == "PRI") {
                    $auto_increment_sub_query = " AUTO_INCREMENT";
                }

                if ($column["Extra"] == "auto_increment" && $saved_column_to_alter["Extra"] != "auto_increment" && $saved_column_to_alter["Key"] == "PRI") {
                    $auto_increment_sub_query = " AUTO_INCREMENT";
                }
            
                if ($column["Extra"] == "auto_increment" && $saved_column_to_alter["Extra"] == "auto_increment") {
                    $auto_increment_sub_query = " AUTO_INCREMENT";
                }

                $mod_sql = "ALTER TABLE `".$this->tableName."` CHANGE `".$saved_column_to_alter["Field"]."` `".$column["Field"]."` ".$new_column?->type."(".$new_column->limit.") NOT NULL ".$auto_increment_sub_query." ".$add_primary_key."; ";
                
                if ($new_column?->type == "text") {
                    $mod_sql = "ALTER TABLE `".$this->tableName."` CHANGE `".$saved_column_to_alter["Field"]."` `".$column["Field"]."` ".$new_column?->type." NOT NULL ".$auto_increment_sub_query." ".$add_primary_key."; ";
                } else if ($new_column?->type == "double") {
                    $mod_sql = "ALTER TABLE `".$this->tableName."` CHANGE `".$saved_column_to_alter["Field"]."` `".$column["Field"]."` ".$new_column?->type." NOT NULL ".$auto_increment_sub_query." ".$add_primary_key."; ";
                } else if ($new_column?->type == "datetime") {
                    $mod_sql = "ALTER TABLE `".$this->tableName."` CHANGE `".$saved_column_to_alter["Field"]."` `".$column["Field"]."` DATETIME NOT NULL DEFAULT ". $column["Default"]. "; ";
                }

                array_push($this->modificationList,
                    [
                        "sql"=>$mod_sql,
                        "from"=>$saved_column_to_alter["Field"],
                        "to"=>$column["Field"],
                        "from_type"=>$saved_column_to_alter["Type"],
                        "to_type"=>$column["Type"],
                        "operation_type"=>"ALTER_CHANGE_COLUMN"
                    ]
                );


                if ($column["Extra"] != "auto_increment" && $saved_column_to_alter["Extra"] != "auto_increment" && $saved_column_to_alter["Key"] != "PRI" && $column["Key"] == "PRI") {
                    array_push($this->modificationList,
                        [
                            "sql"=>"ALTER TABLE `".$this->tableName."` ADD PRIMARY KEY(`".$column["Field"]."`);",
                            "operation_type"=>"ADD_PRIMARY_KEY"
                        ]
                    );
                }

                if ($column["Extra"] != "auto_increment" && $saved_column_to_alter["Extra"] != "auto_increment" && $saved_column_to_alter["Key"] == "PRI" && $column["Key"] != "PRI") {

                    array_push($this->modificationList,
                        [
                            "sql"=>"ALTER TABLE `".$this->tableName."` DROP PRIMARY KEY;",
                            "operation_type"=>"DROP_PRIMARY_KEY"
                        ]
                    );
                }

                /*
                *  Check if new column has a primary key
                */
    
                if ($column["Extra"] != "auto_increment" && $saved_column_to_alter["Extra"] == "auto_increment" && $saved_column_to_alter["Key"] == "PRI" && $column["Key"] != "PRI") {
    

                    /*
                    *  Remove auto increment from current column
                    */
                    array_push($this->columnDropList,
                        [
                            "sql"=>"ALTER TABLE `".$this->tableName."` CHANGE `".$saved_column_to_alter["Field"]."` `".$saved_column_to_alter["Field"]."` ".$saved_column_to_alter["Type"]." NOT NULL; ",
                            "from"=>$saved_column_to_alter["Field"],
                            "to"=>$saved_column_to_alter["Field"],
                            "operation_type"=>"ALTER_CHANGE_COLUMN"
                        ]
                    );
                    
                    /*
                    *  Remove primary key from table
                    */
                    array_push($this->columnDropList,
                        [
                            "sql"=>"ALTER TABLE `".$this->tableName."` DROP PRIMARY KEY;",
                            "operation_type"=>"ALTER_DROP_PRIMARY_KEY"
                        ]
                    );
                }
            } else {
                $previous_column_field = end($this->newColumnList)["Field"];
                $alter_after_sub_query = "";
                if ($newColumnkey != 0) {
                    $previous_column_field = $this->getPreviousColumn($this->newColumnList, $newColumnkey)["Field"];
                    $alter_after_sub_query = "AFTER `".$previous_column_field."`";
                } else {
                    $alter_after_sub_query = "FIRST";
                }

                if ($column["Extra"] == "auto_increment") {
                    $auto_increment_sub_query = " AUTO_INCREMENT ";
                    $add_primary_key = " , add PRIMARY KEY (`".$column["Field"]."`)";
                }

                $mod_sql = "ALTER TABLE `".$this->tableName."` ADD `".$column["Field"]."` ".$new_column?->type."(".$new_column->limit.") NOT NULL ".$auto_increment_sub_query." ".$alter_after_sub_query." ". $add_primary_key."; ";
                
                if ($new_column?->type == "text") {
                    $mod_sql = "ALTER TABLE `".$this->tableName."` ADD `".$column["Field"]."` ".$new_column?->type." NOT NULL ".$auto_increment_sub_query." ".$alter_after_sub_query." ". $add_primary_key."; ";
                } else if ($new_column?->type == "double") {
                    $mod_sql = "ALTER TABLE `".$this->tableName."` ADD `".$column["Field"]."` ".$new_column?->type." NOT NULL ".$auto_increment_sub_query." ".$alter_after_sub_query." ". $add_primary_key."; ";
                } else if ($new_column?->type == "datetime") {
                    $mod_sql = "ALTER TABLE `".$this->tableName."` ADD `".$column["Field"]."` ".$new_column?->type." NOT NULL DEFAULT CURRENT_TIMESTAMP ".$alter_after_sub_query.";";
                }

                array_push($this->modificationList,
                    [
                        "sql"=>$mod_sql,
                        "operation_type"=> "ALTER_ADD_COLUMN"
                    ]
                );


                if ($column["Extra"] != "auto_increment" && $column["Key"] == "PRI") {
                    array_push($this->modificationList,
                        [
                            "sql"=> "ALTER TABLE `".$this->tableName."` ADD PRIMARY KEY(`".$column["Field"]."`);",
                            "operation_type"=>"ALTER_ADD_PRIMARY_KEY"
                        ]
                    );
                }
            }
        }

        // echo print_r($this->modificationList);
    }

    public function filterColumnsToDrop() {
        // Log::error("Checking for columns to drop");
        $new_table_length = count($this->newColumnList);
        if ($new_table_length < count($this->savedColumnList)) {
            Log::warning("Some columns would be dropped");
            $colums_to_be_dropped = $this->savedColumnList;
            $filtered_column_list = [];

            foreach ($this->savedColumnList as $savedColumnKey => $savedColumn) {
                /*
                *
                *   Check for columns that already exists in the table
                *
                */

                if ($savedColumnKey <  $new_table_length) {
                    // Log::success($savedColumn["Field"] ." will not be droped");
                    array_push($filtered_column_list, $savedColumn);
                    unset($colums_to_be_dropped[$savedColumnKey]);
                } else {
                    // Log::error($savedColumn["Field"] ." will be droped");
                }
            }

            foreach ($colums_to_be_dropped as $colum_to_be_dropped) {
                array_push($this->modificationList,
                    [
                        "sql"=>"ALTER TABLE `".$this->tableName."` DROP `".$colum_to_be_dropped["Field"]."; ",
                        "operation_type"=>"ALTER_DROP"
                    ]
                );
            }

            $this->savedColumnList = $filtered_column_list;

        } else {
            // Log::error("Can not perform dropping operation");
        }


        // Log::error("Found columns ".count($this->columnDropList)." to drop");

        // echo print_r($this->columnDropList);
    }

    public function getPreviousColumn($arr, $key) {
        return $arr[$key-1];
    }

    public function getNewColumns() {
        $this->compareAndAlterExsitingColumns();
    }

    public function clearColumn(string $from, string $to, string $fromType = "", string $toType = "") {
        $raw_fromType = $this->getColumnType($fromType);
        $raw_toType = $this->getColumnType($toType);
        // echo "to: $to ($raw_toType->type) from: $from ($raw_fromType->type) \n";
        if ($raw_fromType->type != "" && $raw_toType->type != "" && $raw_fromType->type != $raw_toType->type) {
            if (in_array(strtolower($raw_toType->type), ["int", "bigint", "double"]) && in_array(strtolower($raw_fromType->type), ["varchar", "text", "datetime"])) {
                $update_sql = "UPDATE `".$this->tableName."` SET `".$from."`=0";
                // echo "$$update_sql\n";
                // Log::warning($update_sql);
                DB::query($update_sql);
            } else {
                if (in_array(strtolower($raw_toType->type), ["datetime"])) {
                    $update_sql = "UPDATE `".$this->tableName."` SET `".$from."`=now()";
                    // echo "$$update_sql\n";
                    // Log::warning($update_sql);
                    DB::query($update_sql);
                }
            }
        }
    }

    public function buildAndRunQuery(string $queryType, string $from, string $to, string $type, string $limit, string $fromType = "", string $toType = "", string $extras = "", string $key = "") {

        $auto_increment_sub_query = "";
        $add_primary_key = "";

        if ($extras == "auto_increment") {
            $add_primary_key = ", add PRIMARY KEY (`".$to."`)";
            $auto_increment_sub_query = " AUTO_INCREMENT";
        }
        if ($key == "PRI") {
            $add_primary_key = ", add PRIMARY KEY (`".$to."`)";
            $auto_increment_sub_query = " AUTO_INCREMENT";
        }

        if ($queryType == "ALTER_CHANGE_COLUMN") {
            $sql = "ALTER TABLE `".$this->tableName."` CHANGE `".$from."` `".$to."` ".$type."(".$limit.") NOT NULL ".$auto_increment_sub_query." ".$add_primary_key."; ";

            if (in_array($type, ["text", "datetime", "double"])) {
                $sql = "ALTER TABLE `".$this->tableName."` CHANGE `".$from."` `".$to."` ".$type." NOT NULL ".$auto_increment_sub_query." ".$add_primary_key."; ";
            }
        } else {

        }

        // $this->clearColumn(from: $from, to: $to, fromType: $fromType, toType: $toType);

        // echo "$sql \n";
        // Log::neutral($sql);

        DB::query($sql);
    }
}