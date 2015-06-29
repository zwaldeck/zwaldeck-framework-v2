<?php

namespace Zwaldeck\Plugins\ZwaldeckORMPlugin\Adapter;
use Zwaldeck\Plugins\ZwaldeckORMPlugin\Adapter\Helper\Select;

/**
 * Class AbstractAdapter
 * @package Zwaldeck\Plugins\ZwaldeckORMPlugin\Adapter
 */
abstract class AbstractAdapter {

    protected $host;
    protected $user;
    protected $pass;
    protected $dbName;
    protected $port;
    protected $charset;
    protected $connection;

    public function __construct($host, $user, $pass, $dbName, $port = 3306, $charset = 'utf8') {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbName = $dbName;
        $this->port = $port;
        $this->charset = $charset;

        $this->createConnection();
    }

    protected abstract function createConnection();
    public abstract function getConnection();

    public abstract function getLastInsertedId();
    public abstract function rawQuery($query);

    //all fetches are ASSOC
    public abstract function fetchAll($table);
    public abstract function fetch(Select $select);
    public abstract function fetchRow(Select $select);

    public abstract function insert(Insert $insert);
    public abstract function update(Update $update);
    public abstract function delete(Delete $delete);

    //metrics from tables
    //todo metrics functions



}