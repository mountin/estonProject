<?php

/**
 * Created by PhpStorm.
 * User: mountin
 */
class Db
{
    private $db;

    public function __construct($db)
    {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db = $db;
    }

    public function insert($table, $fields, $insertParams = null)
    {
        try {
            $result = null;
            $names = '';
            $vals = '';
            foreach ($fields as $name => $val) {
                if (isset($names[0])) {
                    $names .= ', ';
                    $vals .= ', ';
                }
                $names .= $name;
                $vals .= ':' . $name;
            }
            $ignore = isset($insertParams['ignore']) && $insertParams['ignore'] ? 'IGNORE' : '';
            $sql = "INSERT $ignore INTO " . $table . ' (' . $names . ') VALUES (' . $vals . ')';
            //echo $sql; die;
            $rs = $this->db->prepare($sql);
            foreach ($fields as $name => $val) {
                $rs->bindValue(':' . $name, $val);
            }
            if ($rs->execute()) {
                $result = $this->db->lastInsertId(null);
            }
            return $result;
        } catch (Exception $e) {
            $this->report($e);
        }
    }

    // Returns true/false
    public function delete($table, $where, $params = null)
    {
        try {
            $sql = 'DELETE FROM ' . $table . ' ';
            $first = true;
            if (!is_array($params)) {
                $params = array();
            }
            $sql .= ' WHERE ' . $where;
            $rs = $this->db->prepare($sql);
            return $rs->execute($params);

        } catch (Exception $e) {
            $this->report($e);
        }
    }

    public function update($table, $fields, $where, $params = null)
    {
        try {
            $sql = 'UPDATE ' . $table . ' SET ';
            $first = true;
            foreach (array_keys($fields) as $name) {
                if (!$first) {
                    $first = false;
                    $sql .= ', ';
                }
                $first = false;
                $sql .= $name . ' = :_' . $name;
            }
            if (!is_array($params)) {
                $params = array();
            }
            $sql .= ' WHERE ' . $where;
            $rs = $this->db->prepare($sql);
            foreach ($fields as $name => $val) {
                $params[':_' . $name] = $val;
            }
            $result = $rs->execute($params);
            return $result;
        } catch (Exception $e) {
            $this->report($e);
        }
    }

    public function queryRows($query, $params = null, $fetchStyle = PDO::FETCH_ASSOC, $classname = null)
    {
        $rows = $this->queryRowOrRows(false, $query, $params, $fetchStyle, $classname);
        return $rows;
    }

    private function queryRowOrRows($singleRow, $query, $params = null, $fetchStyle = PDO::FETCH_ASSOC, $classname = null)
    {
        try {
            $result = null;
            $stmt = $this->db->prepare($query);
            if ($classname) {
                $stmt->setFetchMode($fetchStyle, $classname);
            } else {
                $stmt->setFetchMode($fetchStyle);
            }
            if ($stmt->execute($params)) {
                $result = $singleRow ? $stmt->fetch() : $stmt->fetchAll();
                $stmt->closeCursor();
            }
            return $result;
        } catch (Exception $e) {
            $this->report($e);
        }
    }


    // returns true/false
    public function sql($query, $params = null)
    {
        try {
            $result = null;
            $stmt = $this->db->prepare($query);
            //echo $query; die;
            return $stmt->execute($params);
        } catch (Exception $e) {
            $this->report($e);
        }
    }

    private function report($e)
    {
        throw $e;
    }

}