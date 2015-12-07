<?php

namespace Core\Application\Db\Adapter;

abstract class AdapterAbstract
{

    /**
     * Connection to database config
     * @var array 
     */
    protected $_config;

    /**
     * Function getConfig() returns connection config to current database.
     * @return array 
     */
    public function getConfig()
    {
        return $this->_config;
    }

    /**
     * Function connect is purposed to create Adapter object for current database 
     * and get connection for this database
     * @param array $config
     * @return AdapterAbstract
     * @throws \Core\Application\Exception
     */
    abstract function connect($config);

    /**
     * function isConnect() is purposed for check the connection to current database.
     * @return boolean
     */
    abstract function isConnect();

    /**
     * function getConnection() returns object of connection to database
     * @return AdapterAbstract
     */
    abstract function getConnection();

    /**
     * function is purposed for close the connection to current database.
     */
    abstract function closeConnection();

    /**
     * Makes prepared request to current database
     * @param string $sql - sql request
     * @param array $bind - params for bind
     * @return bool
     */
    abstract function query($sql, $bind = array());

    /**
     * Returns last inserted id into database
     * @return int
     */
    abstract function lastInsertId();

    /**
     * Makes prepared request to current database
     * @param string $sql - sql request
     * @param array $bind - params for bind
     * @return \PDOStatement
     */
    abstract function queryString($sql, $bind = array());

    /**
     * Describe table by name
     * @param string $tableName
     * @return array 
     */
    abstract function describe($tableName);

    /**
     * Method fetchPairs() return first one element by the query SELECT
     * @param string $sql - sql request
     * @param array $bind - params for bind
     * @return string 
     */
    abstract function fetchOne($sql, array $bind);

    /**
     * Method fetchPairs () returns the data in an array of key-value pairs, 
     * key associative array is taken from the first column returned by the query SELECT. 
     * The value is taken from the second column returned by the query SELECT.
     * @param string $sql -  sql request
     * @param array $bind -  params for bind
     * @return array 
     */
    abstract function fetchPairs($sql, array $bind);

    /**
     * Method fetchCol() returns only the first column or set by $column
     * @param string $sql - sql request
     * @param array $bind -  params for bind
     * @param int $column number of column
     * @return array
     */
    abstract function fetchCol($sql, $bind = array(), $column = null);

    /**
     * Method fetchAssoc() returns the all data in associative array 
     * @param string $sql - sql request
     * @param array $bind -  params for bind

     * @return array
     */
    abstract function fetchAssoc($sql, array $bind);

    /**
     * Method fetchAssoc() returns one row from database 
     * @param string $sql -  sql request
     * @param array $bind -  params for bind
     * @param int $fetchMode - PDO::option
     * @return array
     */
    abstract function fetchRow($sql, $bind = array(), $fetchMode = null);

    /**
     * Method fetchAssoc() returns all data from database 
     * @param string $sql -  sql request
     * @param array $bind -  params for bind
     * @param int $fetchMode - PDO::option
     * @return array
     */
    abstract function fetchAll($sql, $bind = array(), $fetchMode = null);

    /**
     * Method insert() insert  data in database 
     * @param string $sql -  sql request
     * @param array $bind -  params for bind
     * @return bool
     */
    abstract function insert($sql, $bind = array());

    /**
     * Method insert() delete  data in database 
     * @param string $sql - sql request
     * @param array $bind -  params for bind
     * @return bool 
     */
    abstract function delete($sql, $bind = array());

    /**
     * Method insert() update  data in database 
     * @param string $sql -  sql request
     * @param array $bind -  params for bind
     * @return bool
     */
    abstract function update($sql, $bind = array());

    /**
     * Method beginTransaction() purposed to begin nested transaction
     * @return boolean|int
     */
    abstract function beginTransaction();

    /**
     * Method commit() purposed to commit nested transaction
     * @return boolean|int
     */
    abstract function commit();

    /**
     * Method rollback() purposed to rollback all nested transaction or to savepoint
     * @return boolean
     */
    abstract function rollback();
}