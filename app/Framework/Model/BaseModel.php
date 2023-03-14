<?php
namespace App\Framework\Model;

use App\Framework\Database\Database as DB;

class BaseModel {
    protected static $tableName = "";

    private $db_query = "";
    private $query_params = "";
    private $query_limit = "";
    private $query_offset = "";

    private $where_sub_query = "";

    public function __construct (string $sql_query = "", array $query_params = []) {
        $this->db_query = $sql_query;
        $this->query_params = $query_params;
    }

    public static function find(array $queries = [], int $limit = 0) {
        $query_params = [];
        $search = "";

        foreach ($queries as $key => $query) {
            if (count($query) >= 3) {
                if ($key == 0) {
                    $search = " WHERE ";
                } else {
                    $search = " AND ";
                }
                $search = $search . $query[0] . $query[1].":".$query[0];
                $param = array(
                    ":".$query[0] => $query[2]
                );
                $query_params = array_merge($query_params, $param);
            }
        }

        $query_limit = "";

        if ($limit > 0) {
            $query_limit = " LIMIT " . $limit;
         } else {
            $query_limit = "";
         }

        $sql_query = "SELECT * FROM ".static::$tableName." ".$search .$query_limit;
        $data = DB::query($sql_query, $query_params);

        return (object) $data;
    }

    public static function findById(int | string $id, string $tableId = "id") {
        $sql_query = "SELECT * FROM ".static::$tableName." WHERE ".$tableId." = :row_id";
        $data = DB::query($sql_query, [":row_id"=> (int) $id]);

        if (count($data) > 0) {
            return (object) $data[0];
        } else {
            return null;
        }
    }

    public static function all() {
        $sql_query = "SELECT * FROM ".static::$tableName;
        $data = DB::query($sql_query, []);

        return $data;
    }

    public static function findOne(array $queries = []) {
        $query_params = [];
        $search = "";

        foreach ($queries as $key => $query) {
            if (count($query) >= 3) {
                if ($key == 0) {
                    $search = " WHERE ";
                } else {
                    $search = " AND ";
                }
                $search = $search . $query[0] . $query[1].":".$query[0];
                $param = array(
                    ":".$query[0] => $query[2]
                );
                $query_params = array_merge($query_params, $param);
            }
        }

        $sql_query = "SELECT * FROM ".static::$tableName." ".$search;
        $data = DB::query($sql_query, $query_params);

        if (!$data) {
            return false;
        }
        return $data[0];
    }


    public static function fetch(array $queries = []): self {
        $query_params = [];
        $search = "";

        foreach ($queries as $key => $query) {
            if (count($query) >= 3) {
                if ($key == 0) {
                    $search = " WHERE ";
                } else {
                    $search = " AND ";
                }
                $search = $search . $query[0] . $query[1].":".$query[0];
                $param = array(
                    ":".$query[0] => $query[2]
                );
                $query_params = array_merge($query_params, $param);
            }
        }

        $sql_query = "SELECT * FROM ".static::$tableName." ".$search;

        return new BaseModel($sql_query, $query_params);
    }


    public function where(string $key, string $inputValue, $extra = "none"): self {
        $model = new $this;
        $query_params = [];
        $search = "";

        $value = "";
        $operand = "=";

        if ($extra == "none") {
             $value = $inputValue;
        } else {
            $value = $extra;
            $operand = $inputValue;
        }

        $search = " WHERE ";
    
        $model->where_sub_query = $search . $key . $operand.":where_".$key;
        $param = array(
            ":where_".$key => $value
        );
        
        $model->query_params = array_merge($query_params, $param);

        return $model;
    }


    public function and(string $key, string $inputValue, $extra = "none") {
        $query_params = [];
        $search = "";

        $value = "";
        $operand = "=";

        if ($extra == "none") {
            $value = $inputValue;
       } else {
           $value = $extra;
           $operand = $inputValue;
       }
    
        $this->where_sub_query = $this->where_sub_query . " AND " .$key . $operand.":where_".$key;
        $param = array(
            ":where_".$key => $value
        );
        
        $this->query_params = array_merge($this->query_params, $param);

        return $this;
    }

    protected static function getTableName() {
        return static::$tableName;
    }

    public function update(array $queries = []) {
        $query_params = [];
        $search = "";
        $iteration = 0;

        foreach ($queries as $key => $query) {
            if ($iteration == 0) {
                $search =  $key . "=".":update_".$key;
            } else {
                $search = $search . ", " . $key . "=".":update_".$key;
            }
            $param = array(
                ":update_".$key => $query
            );
            $this->query_params = array_merge($this->query_params, $param);

            $iteration++;
        }

        $search = $search . ", date_updated=now()";

        
        $this->query_params = array_merge($this->query_params, $query_params);
        $sql_query = "UPDATE ". static::$tableName . " SET " . $search . $this->where_sub_query . $this->query_limit . $this->query_offset;

        
        // print_r($this->query_params);
        // echo $sql_query;
        // error_log($sql_query);

        // exit;


        $data = DB::query( $sql_query, $this->query_params);
        return $data;
    }

    public function get() {
        $sql_query = "SELECT * FROM  ". static::$tableName . $this->where_sub_query . $this->query_limit . $this->query_offset;
        $data = DB::query($sql_query, $this->query_params);

        if (count($data) > 0) {
            return (object) $data;
        } else {
            return null;
        }
        
    }

    public function first() {
        $sql_query = "SELECT * FROM  ". static::$tableName . $this->where_sub_query . $this->query_limit . $this->query_offset;
        $data = DB::query($sql_query, $this->query_params);

        if (count($data) > 0) {
            return (object) $data[0];
        } else {
            return null;
        }
    }

    public function limit(string $limit) {
        if ($limit > 0) {
            $this->query_limit = " LIMIT " . $limit;
         } else {
            $this->query_limit = "";
         }
        return $this;
    }

    public function skip(string $offset) {
        if ($offset > 0) {
            $this->query_offset = " OFFSET " . $offset;
         } else {
            $this->query_offset = "";
         }
        return $this;
    }

    public static function create(array $data) {
        $keys = "";
        $columns = "";
        $params= [];

        $iteration = 0;

        foreach ($data as $key => $value) {
            if ($iteration == 0) {
                $keys = $keys .":".$key;
                $columns = $columns ."".$key;
            } else {
                $keys = $keys .  ", :". $key;
                $columns = $columns .", ".$key;
            }

            $params = array_merge($params, [":".$key=>$value]);

            $iteration++;
        }

        $columns = $columns . ", date_created, date_updated";
        $keys =  $keys . ", now(), now()";

        $sql_query = "INSERT INTO ". static::$tableName ." (".$columns.") VALUES (".$keys.")";
    
        // print_r($params);
        // echo $sql_query;
        // error_log($sql_query);
        // exit;

        $data = DB::query( $sql_query, $params);
    }

    public static function insertMany(array $input) {
        $totalKeys = "";
        $columns = "";
        $generatedColumns = false;
        $params= [];
        $inputIteration = 1;

        foreach ($input as $data) {
            $iteration = 0;
            $keys = "";

            foreach ($data as $key => $value) {
                if ($iteration == 0) {
                    if (!$generatedColumns) {
                        $keys = $keys ."(:". $inputIteration ."_".$key;
                        $columns = $columns ."".$key;
                    } else {
                        $keys = $keys.", (:". $inputIteration ."_".$key;
                    }
                } else {
                    $keys = $keys .  ", :". $inputIteration ."_".$key;
                    
                    if (!$generatedColumns) {
                        $columns = $columns .", ".$key;
                    }
                }


                $params = array_merge($params, [":". $inputIteration ."_".$key=>$value]);

                $iteration++;
            }

            $keys = $keys . ", now(), now())";

            $inputIteration++;

            $totalKeys = $totalKeys . " ". $keys;
            $generatedColumns = true;
        }


        $columns = $columns . ", date_created, date_updated";

        $sql_query = "INSERT INTO ". static::$tableName ." (".$columns.") VALUES ".$totalKeys."";
    
        // print_r($params);
        // echo $sql_query;
        // error_log($sql_query);
        // exit;

        $data = DB::query( $sql_query, $params);
    }


    public static function query(string $query, array $params = []) {
        $data = DB::query($query,  $params);
        return $data;
    }

    public static function analizeTable($table) {

        $data = DB::query("DESCRIBE " . $table);
        // if (count($data) > 0) {
        //     $this->isTableExist = true;
        // }

        return $data;
    }
}

?>