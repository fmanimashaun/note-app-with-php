<?php

namespace Core;

use Core\Response;
use PDO;	
class Database
{

  public $connection;

  public $statement;

  public function __construct($config, $username = 'root', $password = '')
  {
    // build the DSN string
    $dsn = 'mysql:' . http_build_query($config, '', ';');

    // connect to the MySql database
    $this->connection = new PDO($dsn, $username, $password, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }
  public function query($query, $params = [])
  {
    // prepare a statement and execute it
    $this->statement = $this->connection->prepare($query);

    $this->statement->execute($params);

    return $this;
  }

  public function find()
  {
    return $this->statement->fetch();
  }


  public function get()
  {
    return $this->statement->fetchAll();
  }

  public function findOrFail()
  {
    $result = $this->find();

    if (!$result) {
      abort(Response::HTTP_NOT_FOUND);
    }

    return $result;
  }
}
