<?php

namespace Core\Application\Db\Adapter;

use PDO;
use Exception;
use PDOException;
use PDOStatement;

class MySql extends AdapterAbstract
{

    /**
     * object of PDO connection
     * @var PDO 
     */
    private $_db;

    /**
     * Transaction counter for nested transactions. 
     * @var int
     */
    private $_transactionCounter = 0;

    /**
     * Prepared request of PDO
     * @var PDOStatement 
     */
    private $_prepare;

    /**
     * @param array $config
     */
    public function __construct($config)
    {
        $this->_config = $config;
    }

    /**
     * Connection to database
     * @param array $config
     * @return PDO
     * @throws Exception
     */
    public function connect($config)
    {
        if (!isset($this->_db)) {
            try {
                $dsn = "mysql:host=" . $config['host'] . ";" . "dbname=" . $config['dbName'];
                $this->_db = new PDO($dsn, $config['login'], $config['password'], $config['options']);
            } catch (PDOException $e) {
                throw new \Core\Application\Db\Exception('Error connecting to database ' . $e->getMessage());
            }
        }
        return $this->_db;
    }

    /**
     * Function isConnect() is purposed for check the connection to current database.
     * @return boolean
     */
    public function isConnect()
    {
        if ($this->_db) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * Function getConnection() returns object of class PDO
     * @return PDO
     */
    public function getConnection()
    {
        return $this->_db;
    }

    /*
     * Function is purposed for close the connection to current database.
     */

    public function closeConnection()
    {
        $this->_db = NULL;
    }

    /**
     * Returns last inserted id into database
     * @return int
     */
    public function lastInsertId()
    {
        return $this->_db->lastInsertId();
    }

    /**
     * Makes prepared request to current database
     * @param string $sql - sql request
     * @param array $bind - params for bind
     * @return bool
     */
    public function query($sql, $bind = array())
    {
        $this->connect($this->_config);
        $result = $this->_db->prepare($sql);
        $data = null;
        if (!empty($bind)) {
            foreach ($bind as $key => &$value) {
                if (is_int($value)) {
                    $data = PDO::PARAM_INT;
                } elseif (is_string($value)) {
                    $data = PDO::PARAM_STR;
                } elseif (!is_int($key)) {
                    $key = ":" . $key;
                }
                $result->bindParam($key, $value, $data);
            }
        }
        $this->_prepare = $result;

        return $result->execute();
    }

    /**
     * Makes prepared request to current database
     * @param string $sql - sql request
     * @param array $bind - params for bind
     * @return PDOStatement
     */
    public function queryString($sql, $bind = array())
    {
        $this->query($sql, $bind);

        return $this->_prepare;
    }

    /**
     * Describe table by name
     * @param string $tableName
     * @return array 
     */
    public function describe($tableName)
    {
        $this->connect($this->_config);
        $result = $this->_db->prepare("DESCRIBE " . $tableName);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Method fetchPairs() return first one element by the query SELECT
     * @param string $sql - sql request
     * @param array $bind - params for bind
     * @return string 
     */
    public function fetchOne($sql, array $bind)
    {
        $result = $this->queryString($sql, $bind)->fetch(PDO::FETCH_NUM);

        return $result[0];
    }

    /**
     * Method fetchPairs () returns the data in an array of key-value pairs, 
     * key associative array is taken from the first column returned by the query SELECT. 
     * The value is taken from the second column returned by the query SELECT.
     * @param string $sql -  sql request
     * @param array $bind -  params for bind
     * @return array 
     */
    public function fetchPairs($sql, array $bind)
    {
        $result = $this->queryString($sql, $bind)->fetchall(PDO::FETCH_KEY_PAIR);

        return $result;
    }

    /**
     * Method fetchCol() returns only the first column or set by $column
     * @param string $sql - sql request
     * @param array $bind -  params for bind
     * @param int $column number of column
     * @return array
     */
    public function fetchCol($sql, $bind = array(), $column = null)
    {
        $res = $this->queryString($sql, $bind)->fetchall(PDO::FETCH_COLUMN, $column);

        return $res;
    }

    /**
     * Method fetchAssoc() returns the all data in associative array 
     * @param string $sql - sql request
     * @param array $bind -  params for bind

     * @return array
     */
    public function fetchAssoc($sql, array $bind)
    {
        $result = $this->queryString($sql, $bind)->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Method fetchAssoc() returns one row from database 
     * @param string $sql -  sql request
     * @param array $bind -  params for bind
     * @param int $fetchMode - PDO::option
     * @return array
     */
    public function fetchRow($sql, $bind = array(), $fetchMode = null)
    {
        $result = $this->queryString($sql, $bind)->fetch($fetchMode);

        return $result;
    }

    /**
     * Method fetchAssoc() returns all data from database 
     * @param string $sql -  sql request
     * @param array $bind -  params for bind
     * @param int $fetchMode - PDO::option
     * @return array
     */
    public function fetchAll($sql, $bind = array(), $fetchMode = null)
    {
        $result = $this->queryString($sql, $bind)->fetchAll($fetchMode);

        return $result;
    }

    /**
     * Method insert() insert  data in database 
     * @param string $sql -  sql request
     * @param array $bind -  params for bind
     * @return bool
     */
    public function insert($sql, $bind = array())
    {
        $result = $this->query($sql, $bind);

        return $result;
    }

    /**
     * Method insert() delete  data in database 
     * @param string $sql - sql request
     * @param array $bind -  params for bind
     * @return bool 
     */
    public function delete($sql, $bind = array())
    {
        $result = $this->query($sql, $bind);

        return $result;
    }

    /**
     * Method insert() update  data in database 
     * @param string $sql -  sql request
     * @param array $bind -  params for bind
     * @return bool
     */
    public function update($sql, $bind = array())
    {
        $result = $this->query($sql, $bind);

        return $result;
    }

    /**
     * Method beginTransaction() purposed to begin nested transaction
     * @return boolean|int
     */
    public function beginTransaction()
    {
        $this->connect($this->_config);
        $result = null;
        if (!$this->_transactionCounter++) {
            $result = $this->_db->beginTransaction();
        } else {
            $this->_db->exec('SAVEPOINT trans' . $this->_transactionCounter);
            $result = $this->_transactionCounter >= 0;
        }
        return $result;
    }

    /**
     * Method commit() purposed to commit nested transaction
     * @return boolean|int
     */
    public function commit()
    {
        $result = null;
        if (!--$this->_transactionCounter) {
            $result = $this->_db->commit();
        } else {
            $result = $this->_transactionCounter >= 0;
        }
        return $result;
    }

    /**
     * Method rollback() purposed to rollback all nested transaction or to savepoint
     * @return boolean
     */
    public function rollback()
    {
        $result = null;
        if (--$this->_transactionCounter) {
            $this->_db->exec('ROLLBACK TO trans' . ($this->_transactionCounter + 1));
            $result = true;
        } else {
            $result = $this->_db->rollback();
        }
        return $result;
    }

}
