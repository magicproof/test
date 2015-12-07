<?php

namespace Application\Models\Table;

use Core\Application\Db\Table;
use Core\Application\Registry;
use Core\Application\Db;

class Video extends Table
{

    /**
     * Set Db factory by config from Registry and set dbAdapter object
     */
    function __construct()
    {
        $DbSettings = Registry::get('settings');
        $config = $DbSettings['database'];
        $name = $DbSettings['database']['name'];
        $dbAdapter = Db::factory($name, $config);
        parent::__construct($dbAdapter, 'video');
    }

    /**
     * Get limited video and subtitle list or subtitle by video $name from database
     * @param string|null $name
     * @param int $limit By default $limit = 1
     * @return array
     */
    function getList($name = null, $limit = 1)
    {
        $select = $this->getSelect()
            ->from(array('v' => $this->_name), array('name'))
            ->leftJoin(array('r' => 'relations'), "v.id = r.video_id")
            ->leftJoin(array('i' => 'info'), "i.id = r.info_id", array('subtitle'))
            ->limit($limit);

        if (!empty($name)) {
            $selectRow = $this->getSelect()
                ->from($this->_name, array('id', 'name'))
                ->where("name = ?", $name)
                ->limit($limit);
            $row = $this->fetchOne($selectRow);
            if (isset($row)) {
                $select->where('v.id = ?', $row);
            }
        }
        return $this->fetchAll($select);
    }

    /**
     * Get list of video from database
     * @param int $limit
     * @return array
     */
    public function getVideoList($limit = null)
    {
        $select = $this->getSelect()
            ->from($this->_name)
            ->limit($limit);

        return $this->fetchAll($select);
    }

}
