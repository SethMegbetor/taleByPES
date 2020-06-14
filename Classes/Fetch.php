<?php
class Fetch
{
    protected $connection;

    protected $result;

    protected $error;

    protected $count = 0;


    function __construct(PDO $connection) {
        $this->connection =  $connection;
    }



    //fetch single item
    public function getSingleItem($action, $table, $field, $field_value) {
        $query = $this->connection->prepare("{$action} FROM {$table} WHERE {$field} = ? LIMIT 1 ");
        $query->bindParam(1, $field_value, PDO::PARAM_INT);

        if ($query->execute()) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return $this;
        }
    }


    //function to fetch single line data for query with where clause
    public function singleDataAction($action, $table, $where = array()) {
        if(count($where) === 3) {
            $operators = array('=', '>', '<', '>=', '<=', '==', '===', '!=', '!==', 'LIKE');
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];
            if(in_array($operator, $operators)) {
                $sql_statement = "{$action} FROM {$table} WHERE {$field} {$operator} ? LIMIT 1";
                if($result = $this->query($sql_statement, array($value))) {
                    return $result;
                } else {
                    $this->error = implode(', ', $this->connection->errorInfo());
                    return $this;
                }
            }
        }

    }


    //function to fetch a single data with or without a where clause
    public function query($sql_statement, $parameters = array()) {
        if($query = $this->connection->prepare($sql_statement)) {
            $parameter_counter = 1;
            if(count($parameters)){
                foreach ($parameters as $parameter) {
                    $query->bindValue($parameter_counter, $parameter);
                    $parameter_counter++;
                }
                if ($query->execute()) {
                    $id = $this->connection->lastInsertId();
                    $result = $query->fetch(PDO::FETCH_OBJ);
                    $this->count = $query->rowCount();
                    return $result;
                } else {
                    $this->error = implode(', ', $this->connection->errorInfo());
                    return $this;
                }
            }
        }
        return $this;
    }

    
    //display single data result
    public function  getSingleData($query, $table, $where) {
        return $this->singleDataAction($query, $table, $where);
    }


    //fetch single item with joins
    public function getSigleJoinItem($action, $table, $join, $field, $field_value) {
        $query = $this->connection->prepare("{$action} FROM {$table} {$join} WHERE {$field} = ? LIMIT 1");
        $query->bindParam(1, $field_value, PDO::PARAM_INT);

        if($query->execute()) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return $this;
        }
    }


    //fetch items with limit and offset
    public function getItemsWithLimitOffset($action, $table, $join, $limit, $offset) {
        $query = $this->connection->prepare("{$action} FROM {$table} {$join} ORDER BY {$table}.id DESC LIMIT $limit OFFSET $offset");

        if($query->execute()) {
            $all_results = array();
            while($result = $query->fetch(PDO::FETCH_OBJ)) {
                $all_results[] = $result;
            }
            return $all_results;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }


    //fetch all items with no comparison
    public function getItemsWithNoComparison($action, $table) {
        $query = $this->connection->prepare("{$action} FROM {$table}");

        if($query->execute()) {
            $all_results = array();
            while($result = $query->fetch(PDO::FETCH_OBJ)) {
                $all_results[] = $result;
            }
            return $all_results;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }

    

    //fetch total for all items
    public function getTotal($table) {
        $query = $this->connection->prepare("SELECT COUNT(id) AS total FROM $table");
        if($query->execute()) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result->total;
        } else {
            $this->error = implode(', ', $this->connection->errorInfo());
            return false;
        }
    }


    //function to search
    public function search($action, $item) {
        $query = $this->connection->prepare("{$action}");

        if ($query->execute()) {
			$all_results = array();
			while ($result = $query->fetch(PDO::FETCH_OBJ)) {
				$all_results[] = $result;
			}
			return $all_results;
		} else {
			$this->error = implode(', ', $this->connection->errorInfo());
			return false;
		}
    }
}