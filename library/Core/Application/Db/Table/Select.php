<?php

namespace Core\Application\Db\Table;

class Select
{

    /**
     *  Constant for arrays keys and SQL request constants
     */
    const DISTINCT = 'distinct';
    const COLUMNS = 'columns';
    const FROM = 'from';
    const WHERE = 'where';
    const GROUP_BY = 'group by';
    const HAVING = 'having';
    const ORDER_BY = 'order by';
    const ON = 'on';
    const LIMIT = 'limit';
    const INNER_JOIN = 'inner join';
    const LEFT_JOIN = 'left join';
    const RIGHT_JOIN = 'right join';
    const SQL_SELECT = 'SELECT';
    const SQL_FROM = 'FROM';
    const SQL_WHERE = 'WHERE';
    const SQL_DISTINCT = 'DISTINCT';
    const SQL_GROUP_BY = 'GROUP BY';
    const SQL_ORDER_BY = 'ORDER BY';
    const SQL_HAVING = 'HAVING';
    const SQL_AND = 'AND';
    const SQL_AS = ' AS ';
    const SQL_OR = 'OR';
    const SQL_IN = ' IN ';
    const SQL_ON = 'ON';
    const SQL_ASC = 'ASC';
    const SQL_DESC = 'DESC';
    const SQL_START = '*';

    /**
     * The initial values for the $_parts array.
     * @var array
     */
    protected static $_partsInit = array(
        self::DISTINCT => false,
        self::COLUMNS => array(),
        self::FROM => array(),
        self::INNER_JOIN => array(),
        self::LEFT_JOIN => array(),
        self::RIGHT_JOIN => array(),
        self::ON => array(),
        self::WHERE => array(),
        self::GROUP_BY => array(),
        self::ORDER_BY => array(),
        self::LIMIT => array(),
    );

    /**
     * The component parts of a SELECT statement.
     * Initialized to the $_partsInit array in the constructor.
     * @var array
     */
    protected $_parts = array();

    /**
     * Init $_parts by $_partsInit array
     *
     */
    public function __construct()
    {
        $this->_parts = self::$_partsInit;
    }

    /**
     * Begin sql request string with SELECT
     * @var string  
     */
    protected $_sql = self::SQL_SELECT;

    /**
     * array of values for bind
     * @var array
     */
    protected $_bindValue = array();

    /**
     * Counter of params for bind
     * @var int 
     */
    protected $_bindCounter = 1;

    /**
     * Params for WHERE part of sql request which unite conditons
     * @var string
     */
    protected $_unite = '';

    /**
     * Get array of table info for creating sql request  
     * @param array|string $table
     * @param array|string $col
     * @return string
     */
    protected function _getFields($table = array(), $col = '')
    {
        $keys = array();
        $values = array();
        $column = array();
        if (is_array($table)) {
            foreach ($table as $key => $value) {
                array_push($keys, $key . '.');
                array_push($values, $value . self::SQL_AS . $key);
            }
            $tableName = implode(", ", $values);
            $alias = implode(". ", $keys);
        } else {
            $tableName = $table;
            $alias = '';
        }
        if (is_string($col) && empty($col)) {
            $columnName = $alias . self::SQL_START;
            array_push($this->_parts[self::COLUMNS], $columnName);
        } elseif ($col && is_array($col)) {
            foreach ($col as $key => $val) {
                $as = '';
                if (!is_integer($key)) {
                    $as = self::SQL_AS . $key;
                }
                array_push($column, $alias . $val . $as);
                $columnName = implode(', ', $column);
            }
            array_push($this->_parts[self::COLUMNS], $columnName);
        }
        return $tableName;
    }

    /**
     * create FROM part of sql request  
     * @param array|string $table
     * @param array|string $col
     * @return Select
     */
    public function from($table = array(), $col = '')
    {
        $tableName = $this->_getFields($table, $col);
        array_push($this->_parts[self::FROM], $tableName);

        return $this;
    }

    /**
     * Add columns to SELECT sql request  
     * @param array|string $table
     * @param array|string $col
     * @return Select
     */
    public function columns($table = array(), $col = '')
    {
        $tableName = $this->_getFields($table, $col);
        array_push($this->_parts[self::FROM], $tableName);

        return $this;
    }

    /**
     * Create JOIN part of sql request  
     * @param array|string $table
     * @param string $on
     * @param array|string $col
     * @return Select
     */
    public function join($table = array(), $on = null, $col = '')
    {
        $tableName = $this->_getFields($table, $col);
        array_push($this->_parts[self::INNER_JOIN], "$tableName " . self::SQL_ON . " $on");

        return $this;
    }

    /**
     * Create JOIN part of sql request  
     * @param array|string $table
     * @param string $on
     * @param array|string $col
     * @return Select
     */
    public function leftJoin($table = array(), $on = null, $col = '')
    {
        $tableName = $this->_getFields($table, $col);
        array_push($this->_parts[self::LEFT_JOIN], "$tableName " . self::SQL_ON . " $on");

        return $this;
    }

    /**
     * Create JOIN part of sql request  
     * @param array|string $table
     * @param string $on
     * @param array|string $col
     * @return Select
     */
    public function rightJoin($table = array(), $on = null, $col = '')
    {
        $tableName = $this->_getFields($table, $col);
        array_push($this->_parts[self::RIGHT_JOIN], "$tableName " . self::SQL_ON . " $on");

        return $this;
    }

    /**
     * Create WHERE part of sql request  
     * @param string|null $sql
     * @param mixed $bindValue
     * @param string $unite Unite where parameters with sql 'OR', 'AND'
     * @return Select
     */
    public function where($sql = null, $bindValue = null, $unite = self::SQL_AND)
    {
        if (isset($sql)) {
            $this->_unite = $unite;
            $this->_bindValue += array($this->_bindCounter => $bindValue);
            array_push($this->_parts[self::WHERE], $sql);
            $this->_bindCounter++;
        }
        return $this;
    }

    /**
     * Create LIMIT part of sql request
     * @param int $limit
     * @return Select
     */
    public function limit($limit = null)
    {
        if (isset($limit)) {
            array_push($this->_parts[self::LIMIT], $limit);
        }

        return $this;
    }

    /**
     * Create ORDER part of sql request  
     * @param string|null $sql
     * @param string $param 'ASC' or 'DESC' string value
     * @return Select
     */
    public function order($sql = null, $param = self::SQL_ASC)
    {
        if (isset($sql)) {
            array_push($this->_parts[self::ORDER_BY], "$sql  $param");
        }
        return $this;
    }

    /**
     * Create GROUP part of sql request  
     * @param string|null $sql
     * @return Select
     */
    public function group($sql = null)
    {
        if (isset($sql)) {
            array_push($this->_parts[self::GROUP_BY], $sql);
        }
        return $this;
    }

    /**
     * Get sql request
     * @return string
     */
    public function getSql()
    {
        foreach ($this->_parts as $key => $val) {
            $keyUp = strtoupper($key);
            if (!$val) {
                continue;
            }
            if ($key == self::COLUMNS) {
                $this->_sql .= ' ' . implode(', ', $val);
            } elseif ($key == self::WHERE) {
                $this->_sql .= " $keyUp " . implode(" $this->_unite ", $val);
            } elseif (($key == self::INNER_JOIN) || ($key == self::LEFT_JOIN) || ($key == self::RIGHT_JOIN) || ($key == self::ON)
            ) {
                $this->_sql .= " $keyUp " . implode(" $keyUp ", $val);
            } else {
                $this->_sql .= " $keyUp " . implode(', ', $val);
            }
        }
        return $this->_sql;
    }

    /**
     * Get values for bind
     * @return array
     */
    public function getBindValue()
    {
        return $this->_bindValue;
    }

}
