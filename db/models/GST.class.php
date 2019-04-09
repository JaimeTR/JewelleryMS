<?php
/**
 * Created by PhpStorm.
 * User: Tarun
 * Date: 21-03-201 9
 * Time: 04:18 PM
 */
require_once 'Table.class.php';

class GST extends Table
{
    public static $table_name = "gst";
    public static function select($rows="*", $deleted=0, $condition = 1, ...$params)
    {
        return CRUD::select(self::$table_name, $rows, $deleted, $condition, ...$params);
    }
    public static function selectDistinct($column_name = "hsn_code")
    {
        return CRUD::query("SELECT DISTINCT $column_name FROM ".self::$table_name);
    }
    public static function find($condition, ...$params)
    {
        return CRUD::find(self::$table_name, $condition, ...$params);
    }
    public function __construct($result = null)
    {
        parent::__construct($result);
    }

    public function insert()
    {
        if(!$this->exists()){
            parent::addCreated();
            return CRUD::insert(self::$table_name, $this->columns_values);
        }
        return false;
    }

    public function update()
    {
        return CRUD::update(self::$table_name, $this->columns_values, "hsn_code={$this->hsn_code}");
    }

    public function delete()
    {
        return CRUD::delete(self::$table_name, "hsn_code={$this->hsn_code}");
    }

    public function exists()
    {
        $result = CRUD::query("SELECT * FROM gst WHERE hsn_code = ?",$this->hsn_code);
        if($result->rowCount() >= 1)
            return true;
        return false;
    }
}