<?php
namespace App\Framework\Database;

class Database {
	protected static $pdoInstance;

	private static $host;
	private static $dbName;
	private static $username;
	private static $password;

	private static function connect() {
		if(empty(self::$pdoInstance)) {

			self::$host = env("MYSQL_HOST");
			self::$dbName = env("MYSQL_DB");
			self::$username = env("MYSQL_USERNAME");
			self::$password = env("MYSQL_PASSWORD");

			self::$pdoInstance = new \PDO('mysql:host='.self::$host.'; dbname='.self::$dbName.'; charset=utf8', self::$username, self::$password, array(\PDO::ATTR_PERSISTENT => true));
			self::$pdoInstance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}

		return self::$pdoInstance;
	}

	public static function query($query, $params = array(), $returnArray = false) {
		// echo $query . "\n\n";
		$statement = self::connect()->prepare($query);
		$statement->execute($params);

		$queryType = explode(' ', $query)[0];

		if ($queryType == 'SELECT' || $queryType == 'DESCRIBE') {

			$data = $statement->fetchAll($returnArray ==  false ? \PDO::FETCH_OBJ : \PDO::FETCH_ASSOC);
			return $data;

		}
	}

	public static function checkTable($table, $params = array()) {
		self::$host = env("MYSQL_HOST");
		self::$dbName = env("MYSQL_DB");
		self::$username = env("MYSQL_USERNAME");
		self::$password = env("MYSQL_PASSWORD");

		$query = "SELECT TABLE_SCHEMA,  TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA LIKE '".self::$dbName."' AND TABLE_TYPE LIKE 'BASE TABLE' AND TABLE_NAME = '".$table."'";
		$statement = self::connect()->prepare($query);
		$statement->execute($params);
		$data = $statement->fetchAll(\PDO::FETCH_OBJ);
		return $data;
	}
}
?>