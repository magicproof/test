<?php

namespace Core\Application\Db;

use Core\Application\Db\Adapter\AdapterAbstract;

class Table
{

    /**
     * Extended MySql object of abstract class AdapterAbstract
     * @var AdapterAbstract
     */
    protected $_dbAdapter;

    /**
     * Table name
     * @var string
     */
    protected $_name;

    /**
     * Set dbAdapter and table name
     * @param AdapterAbstract $dbAdapter
     * @param string $name
     */
    public function __construct(AdapterAbstract $dbAdapter, $name)
    {
        $this->_dbAdapter = $dbAdapter;
        $this->_name = $name;
    }

    /**
     * Return object of class AdapterAbstract
     * @return AdapterAbstract
     */
    public function getAdapter()
    {
        return $this->_dbAdapter;
    }

    /**
     * Get list of fields in string for sql request
     * @param array $data
     * @return string
     */
    public function getFields(array $data)
    {
        $fields = array();
        $keys = array_keys($data);
        foreach ($keys as $key) {
            array_push($fields, $key . "=" . ":" . $key);
        }
        $fieldsString = implode(",", $fields);

        return $fieldsString;
    }

    /**
     * Insert data in database
     * @param array $data
     * @return boolean
     */
    public function insert(array $data)
    {
        $fieldsString = $this->getFields($data);
        $sql = "INSERT $this->_name SET $fieldsString";

        return $this->_dbAdapter->query($sql, $data);
    }

    /**
     * Update data in database by condition
     * @param array $data
     * @param string $where 
     * @return boolean 
     */
    public function update(array $data, $where)
    {
        $fieldsString = $this->getFields($data);
        $sql = "UPDATE $this->_name SET $fieldsString WHERE $where";

        return $this->_dbAdapter->query($sql, $data);
    }

    /**
     * Delete data in database by condition
     * @param string $where
     * @return boolean
     */
    public function delete($where)
    {
        $sql = "DELETE FROM $this->_name WHERE $where ";

        return $this->_dbAdapter->delete($sql);
    }

    /**
     * Get all data from database by conditions
     * @param string|Table\Select $where
     * @param string $order
     * @param string $count
     * @param string $offset
     * @return array
     */
    public function fetchAll($where = null, $order = null, $count = null, $offset = null)
    {
        if ($where instanceof Table\Select) {
            $sql = $where->getSql();
            $bind = $where->getBindValue();
            $result = $this->_dbAdapter->fetchAll($sql, $bind);
        } else {
            if (isset($where)) {
                $where = " WHERE" . " " . $where;
            }
            if (isset($order)) {
                $order = "ORDER BY" . " " . $order;
            }
            if (isset($count)) {
                $count = "LIMIT" . " " . $count;
            }
            if (isset($offset)) {
                $offset = "OFFSET" . " " . $offset;
            }
            $sql = ("SELECT * FROM $this->_name $where $order $count $offset");
            $result = $this->_dbAdapter->fetchAll($sql, null, \PDO::FETCH_NUM);
        }
        return $result;
    }

    /**
     * Get row data from database by conditions
     * @param string $where
     * @param string $order
     * @param string $offset
     * @return array
     */
    public function fetchRow($where = null, $order = null, $offset = null)
    {
        $row = $this->fetchAll($where, $order, $count = 1, $offset);
        return $row[0];
    }

    /**
     * Get first one element in row
     * @param string $where
     * @param string $order
     * @param string $offset
     * @return string
     */
    public function fetchOne($where = null, $order = null, $offset = null)
    {
        $row = $this->fetchRow($where, $order, $offset);
        return current($row);
    }

    /**
     * Get new Table\Select object
     * @return Table\Select
     */
    public function getSelect()
    {
        return new Table\Select();
    }

}
