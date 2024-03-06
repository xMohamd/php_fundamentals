<?php
require_once "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as capsule;

class DBHandler implements DBHandlerInterface
{
  private $_capsule;

  public function __construct()
  {
    $this->_capsule = new capsule();
  }

  public function connect()
  {
    try {
      $this->_capsule->addConnection([
        'driver' => __DBDRIVER__,
        'host' => __HOST__,
        'database' => __DB__,
        'username' => __USER__,
        'password' => __PASS__,
      ]);
      $this->_capsule->setAsGlobal();
      $this->_capsule->bootEloquent();
      return true;
    } catch (Exception $err) {
      echo "Error(in connect): " . $err->getMessage();
      return false;
    }
  }

  public function get_data($fields = array(),  $start = 0)
  {
    $items = Items::skip($start)->take(5)->get();
    if (empty($fields)) {
      foreach ($items as $item) {
        echo $item->id . " <br>";
      }
    } else {
      return $items;
    }
  }

  public function disconnect()
  {
    try {
      capsule::disconnect();
      return true;
    } catch (Exception $err) {
      echo "Error(in disconnect): " . $err->getMessage();
      return false;
    }
  }
  public function get_record_by_id($id, $primary_key)
  {
    $item = Items::where($primary_key, "=", $id)->get();
    if (count($item) > 0)
      return $item[0];
  }
  public function search_by_column($name_column, $value)
  {
    $items = Items::where($name_column, "like", "%$value%")->get();
    if (count($items) > 0)
      return $items;
  }
}
