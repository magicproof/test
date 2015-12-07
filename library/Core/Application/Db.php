<?php

namespace Core\Application;

use Core\Application\Db\Adapter\AdapterAbstract;

class Db
{

    /**
     * Factory of connections to databases
     * @param string $adapter
     * @param array $config
     * @return AdapterAbstract
     * @throws Db\Exception
     */
    public static function factory($adapter, $config = array())
    {
        /*
         * Verify that adapter parameters are in an array.
         */
        if (!is_array($config)) {
            throw new Db\Exception('Adapter parameters must be in an array');
        }

        /*
         * Verify that an adapter name has been specified.
         */
        if (!is_string($adapter) || empty($adapter)) {
            throw new Db\Exception('Adapter name must be specified in a string');
        }

        /*
         * Form full adapter class name
         */
        $adapterNamespace = 'Core\Application\Db\Adapter\\';
        $adapterName = $adapterNamespace . $adapter;

        /*
         * Create an instance of the adapter class.
         * Pass the config to the adapter class constructor.
         */
        $dbAdapter = new $adapterName($config);

        /*
         * Verify that the object created extends from abstract Adapter type.
         */
        if (!$dbAdapter instanceof AdapterAbstract) {
            throw new Db\Exception("Adapter class '$adapterName' does not extend abstract class Adapter");
        }

        return $dbAdapter;
    }

}
