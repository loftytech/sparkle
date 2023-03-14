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
			self::$host = getenv("MYSQL_HOST");
			self::$dbName = getenv("MYSQL_DB");
			self::$username = getenv("MYSQL_USERNAME");
			self::$password = getenv("MYSQL_PASSWORD");

			self::$pdoInstance = new \PDO('mysql:host='.self::$host.'; dbname='.self::$dbName.'; charset=utf8', self::$username, self::$password, array(\PDO::ATTR_PERSISTENT => true,  \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ));
			self::$pdoInstance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}

		return self::$pdoInstance;
	}

	public static function query($query, $params = array()) {
		$statement = self::connect()->prepare($query);
		$statement->execute($params);

		$queryType = explode(' ', $query)[0];

		if ($queryType == 'SELECT' || $queryType == 'DESCRIBE') {

			$data = $statement->fetchAll(\PDO::FETCH_OBJ);
			return $data;

		}
	}

	public static function checkTable($table, $params = array()) {
		self::$host = getenv("MYSQL_HOST");
		self::$dbName = getenv("MYSQL_DB");
		self::$username = getenv("MYSQL_USERNAME");
		self::$password = getenv("MYSQL_PASSWORD");

		$query = "SELECT TABLE_SCHEMA,  TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA LIKE '".self::$dbName."' AND TABLE_TYPE LIKE 'BASE TABLE' AND TABLE_NAME = '".$table."'";
		$statement = self::connect()->prepare($query);
		$statement->execute($params);
		$data = $statement->fetchAll(\PDO::FETCH_ASSOC);
		return $data;
	}
}
?>