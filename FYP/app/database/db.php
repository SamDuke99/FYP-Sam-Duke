<?php
session_start();

require('connection.php');

function displayData($value) {
    //TODO delete this after finished testing DB
    echo "<pre>", print_r($value), "<pre>";
    die();
}

/*
 * This function lets us execute the query we have written
 * $connect is the variable that contains the MySQLi statement connecting the system to the database
 * $statement contains the sql statement that has been parsed and the database and is what actually gets executed
 * We make sure that the statement contains only the correct types
 */
function executeQueries($sql, $data) {
    global $connect;
    $statement= $connect->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $statement -> bind_param($types, ...$values);
    $statement->execute();
    return $statement;
}


function selectAll($table, $conditions = []) {

    global $connect;
    $sql = "SELECT * FROM $table";

    if (empty($conditions)) {
        $statement = $connect->prepare($sql);
        $statement->execute();
        $results = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
        return $results;
    } else {
        $count=0;
        foreach ($conditions as $key=>$value){
            if ($count===0) {
                $sql .= " WHERE $key=?";
            }else {
                $sql .= " AND $key=?";
            }
            $count++;
        }

        $statement = executeQueries($sql, $conditions);
        $results = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

        return $results;
    }
}




function insert($table, $data) {
    global $connect;

    $sql = "INSERT INTO $table SET ";
    $count=0;

    foreach ($data as $key => $value){
        if($count === 0){
            $sql = $sql . " $key=?";
        }else{
            $sql = $sql . ", $key=?";
        }
        $count++;
    }

    $statement = executeQueries($sql, $data);
    $id = $statement->insert_id;
    return $id;
}




function selectOne($table, $conditions) {

    global $connect;
    $sql = "SELECT * FROM $table";
    $count=0;
    foreach ($conditions as $key=>$value){
        if ($count===0) {
            $sql = $sql . " WHERE $key=?";
        }else {
            $sql = $sql . " AND $key=?";
        }
        $count++;
    }

    $sql = $sql . " LIMIT 1";

    $statement = executeQueries($sql, $conditions);
    $results = $statement->get_result()->fetch_assoc();
    return $results;

}

function delete($table, $id) {
    global $connect;

    $sql = "DELETE FROM $table WHERE id=?";

    $statement = executeQueries($sql, ['id' => $id]);
    $id = $statement->affected_rows;

    return $id;
}

function update($table, $id, $data) {
    global $connect;

    $sql = "UPDATE $table SET ";

    $count=0;
    foreach ($data as $key=>$value){
        if ($count===0) {
            $sql = $sql . " $key=?";
        }else {
            $sql = $sql . ", $key=?";
        }
        $count++;
    }
    $sql = $sql . " WHERE id =?";
    $data['id'] = $id;
    $statement = executeQueries($sql, $data);
    $id = $statement->affected_rows;
    return $id;
}



