<?PHP
# DATABASE SUB-ROUTINE
function connect_db($user, $psw, $db)
{
    $mysqli = new MySQLi('localhost', $user, $psw, $db);
    if ($mysqli->connect_error) {
        die($mysqli->connect_error);
    } else {
        return $mysqli;
    }

}

function disconnect_db($mysqli)
{
    $mysqli->close();
}

function sql_insert($mysqli, $tb, $post_array)
{
    // extract fields
    $keys = array_keys($post_array);
    $field_set = implode(', ', $keys);
    $values = array_values($post_array);

    // extract values
    $record_set = '';
    foreach ($values as $v) {
        $record_set .= '"' . $mysqli->real_escape_string($v) . '", ';
    }

    $record_set = rtrim($record_set, ', ');

    // execute sql command
    $sql_stmt = 'INSERT INTO `' . $tb . '` (' . $field_set . ') VALUES (' . $record_set . ')';
    $result = $mysqli->query($sql_stmt);

    // prepare output
    if ($result === true) {
        return $mysqli->insert_id;
    } else {
        return $mysqli->error ?: null;
    }

}

function sql_select($mysqli, $tb, $field, $value)
{
    $sql_stmt = 'SELECT * FROM `' . $tb . '` WHERE ' . $field . '="' . $mysqli->real_escape_string($value) . '"';
    $result = $mysqli->query($sql_stmt);
    if ($result->num_rows > 0) {
        $new_array = array();
        while ($row = $result->fetch_assoc()) {
            array_push($new_array, $row);
        }
        return $new_array;
    } else {
        return $mysqli->error ?: null;
    }

}

function sql_select_all($mysqli, $tb)
{
    $sql_stmt = 'SELECT * FROM `' . $tb . '` ORDER BY id ASC';
    $result = $mysqli->query($sql_stmt);
    if ($result->num_rows > 0) {
        $new_array = array();
        while ($row = $result->fetch_assoc()) {
            array_push($new_array, $row);
        }

        return $new_array;
    } else {
        return $mysqli->error ?: null;
    }

}

function sql_select_one($mysqli, $tb, $field, $value)
{
    $sql_stmt = 'SELECT * FROM `' . $tb . '` WHERE ' . $field . '="' . $mysqli->real_escape_string($value) . '"';
    $result = $mysqli->query($sql_stmt);
    if ($result->num_rows > 0) {
        $new_array = array();
        while ($row = $result->fetch_assoc()) {
            array_push($new_array, $row);
        }

        return current($new_array);
    } else {
        return $mysqli->error ?: null;
    }

}

function sql_select_id($mysqli, $tb, $id)
{
    $sql_stmt = 'SELECT * FROM `' . $tb . '` WHERE id="' . $mysqli->real_escape_string($id) . '"';
    $result = $mysqli->query($sql_stmt);
    if ($result->num_rows > 0) {
        $new_array = array();
        while ($row = $result->fetch_assoc()) {
            array_push($new_array, $row);
        }

        return current($new_array);
    } else {
        return $mysqli->error ?: null;
    }

}

function sql_select_count($mysqli, $tb, $field, $value)
{
    $sql_stmt = 'SELECT COUNT(id) AS var FROM `' . $tb . '` WHERE ' . $field . '="' . $mysqli->real_escape_string($value) . '"';
    $result = sql_query($mysqli, $sql_stmt);
    return (int) $result[0]['var'];
}

function sql_update($mysqli, $tb, $post_array, $field, $value)
{
    $hash_map = '';
    // extract set clause
    foreach ($post_array as $k => $v) {
        $hash_map .= $k . '="' . $mysqli->real_escape_string($v) . '", ';
    }

    $hash_map = rtrim($hash_map, ', ');

    // execute sql command
    $sql_stmt = 'UPDATE `' . $tb . '` SET ' . $hash_map . ' WHERE ' . $field . '="' . $mysqli->real_escape_string($value) . '"';
    $result = $mysqli->query($sql_stmt);

    // prepare output
    if ($result === true) {
        return $mysqli->affected_rows;
    } else {
        return $mysqli->error ?: null;
    }

}

function sql_delete($mysqli, $tb, $field, $value)
{
    $sql_stmt = 'DELETE FROM `' . $tb . '` WHERE ' . $field . '="' . $mysqli->real_escape_string($value) . '"';
    $result = $mysqli->query($sql_stmt);
    if ($result === true) {
        return $mysqli->affected_rows;
    } else {
        return $mysqli->error ?: null;
    }

}

function sql_query($mysqli, $sql_stmt)
{
    $type = substr($sql_stmt, 0, 6);

    $result = $mysqli->query($sql_stmt);
    if ($type == 'SELECT') {
        if ($result->num_rows > 0) {
            $new_array = array();
            while ($row = $result->fetch_assoc()) {
                array_push($new_array, $row);
            }

            return $new_array;
        } else {
            return $mysqli->error ?: null;
        }

    } else {
        if ($result === true) {
            if ($type == 'INSERT') {
                return $mysqli->insert_id;
            } else {
                return $mysqli->affected_rows;
            }

        } else {
            return $mysqli->error ?: null;
        }

    }
}

function sql_cell($mysqli, $tb, $col, $field, $value)
{
    $sql_stmt = 'SELECT ' . $col . ' FROM `' . $tb . '` WHERE ' . $field . '="' . $mysqli->real_escape_string($value) . '"';
    $result = sql_query($mysqli, $sql_stmt);
    if (is_array($result)) {
        return $result[0][$col];
    }

    return $result;
}

function sql_column_distinct($mysqli, $tb, $col = 'DATE')
{
    $sql_stmt = 'SELECT id, ' . $col . ' FROM `' . $tb . '` GROUP BY ' . $col;
    $result = sql_query($mysqli, $sql_stmt);
    if (is_array($result)) {
        $new_array = array();
        foreach ($result as $assoc) {
            $key = $assoc['id'];
            $new_array[$key] = $assoc[$col];
        }
        return $new_array;
    }
}

function sql_column($mysqli, $tb, $col = 'DATE')
{
    $sql_stmt = 'SELECT id, ' . $col . ' FROM `' . $tb . '`';
    $result = sql_query($mysqli, $sql_stmt);
    if (is_array($result)) {
        $new_array = array();
        foreach ($result as $assoc) {
            $key = $assoc['id'];
            $new_array[$key] = $assoc[$col];
        }
        return $new_array;
    }
}

function sql_columns($mysqli, $tb, $cols)
{
    $sql_stmt = 'SELECT id, ' . $cols . ' FROM `' . $tb . '`';
    $result = sql_query($mysqli, $sql_stmt);
    if (is_array($result)) {
        $new_array = array();
        foreach ($result as $assoc) {
            $key = $assoc['id'];
            $new_array[$key] = array_shift($assoc);
        }
        return $new_array;
    }
}

function sql_count($mysqli, $tb, $col = 'id')
{
    $sql_stmt = 'SELECT COUNT(' . $col . ') AS var FROM `' . $tb . '`';
    $result = sql_query($mysqli, $sql_stmt);
    return (int) $result[0]['var'];
}

function sql_sum($mysqli, $tb, $col = 'id')
{
    $sql_stmt = 'SELECT SUM(' . $col . ') AS var FROM `' . $tb . '`';
    $result = sql_query($mysqli, $sql_stmt);
    return (int) $result[0]['var'];
}

function sql_avg($mysqli, $tb, $col = 'id')
{
    $sql_stmt = 'SELECT AVG(' . $col . ') AS var FROM `' . $tb . '`';
    $result = sql_query($mysqli, $sql_stmt);
    return (int) $result[0]['var'];
}

function sql_min($mysqli, $tb, $col = 'id')
{
    $sql_stmt = 'SELECT MIN(' . $col . ') AS var FROM `' . $tb . '`';
    $result = sql_query($mysqli, $sql_stmt);
    return (int) $result[0]['var'];
}

function sql_max($mysqli, $tb, $col = 'id')
{
    $sql_stmt = 'SELECT MAX(' . $col . ') AS var FROM `' . $tb . '`';
    $result = sql_query($mysqli, $sql_stmt);
    return (int) $result[0]['var'];
}

function sql_first($mysqli, $tb)
{
    $sql_stmt = 'SELECT * FROM `' . $tb . '` ORDER BY id ASC LIMIT 1';
    $result = sql_query($mysqli, $sql_stmt);
    return is_array($result) ? current($result) : $result;
}

function sql_last($mysqli, $tb)
{
    $sql_stmt = 'SELECT * FROM `' . $tb . '` ORDER BY id DESC LIMIT 1';
    $result = sql_query($mysqli, $sql_stmt);
    return is_array($result) ? current($result) : $result;
}

function sql_group_by($mysqli, $tb, $col)
{
    $sql_stmt = 'SELECT * FROM `' . $tb . '` GROUP BY ' . $col . ' ORDER BY id ASC';
    $result = sql_query($mysqli, $sql_stmt);
    return is_array($result) ? array_map(current, $result) : $result;
}

function sql_distinct($mysqli, $tb, $col)
{
    $sql_stmt = 'SELECT DISTINCT ' . $col . ' FROM `' . $tb . '`';
    $result = sql_query($mysqli, $sql_stmt);
    return is_array($result) ? array_map(current, $result) : $result;
}

function sql_distinct_count($mysqli, $tb, $col)
{
    $sql_stmt = 'SELECT COUNT(DISTINCT ' . $col . ') AS var FROM `' . $tb . '`';
    $result = sql_query($mysqli, $sql_stmt);
    if (is_array($result)) {
        return (int) $result[0]['var'];
    }

    return 0;
}

function sql_rand($mysqli, $tb, $lmt = 25)
{
    $sql_stmt = 'SELECT * FROM `' . $tb . '` ORDER BY RAND() LIMIT ' . $lmt;
    $result = sql_query($mysqli, $sql_stmt);
    return $result;
}

function sql_recent($mysqli, $tb)
{
    $row = sql_last($mysqli, $tb);
    $recent = date('Y-m-d', strtotime($row['date']));
    $result = sql_today($mysqli, $tb, 'date', $recent);
    return $result;
}

function sql_fetch_by_date($mysqli, $tb, $where = 'DATE', $is = null)
{
    $date = is_null($is) ? date('Y-m-d') : $is;
    $sql_stmt = 'SELECT * FROM `' . $tb . '` WHERE DATE(' . $where . ')="' . $date . '" ORDER BY id ASC';
    $result = sql_query($mysqli, $sql_stmt);
    return $result;
}

function sql_fetch_by_month($mysqli, $tb, $where = 'DATE', $mo = null, $yr = null)
{
    $mo = is_null($mo) ? date('m') : $mo;
    $yr = is_null($yr) ? date('Y') : $yr;
    $sql_stmt = 'SELECT * FROM `' . $tb . '` WHERE MONTH(' . $where . ')="' . $mo . '" AND YEAR(' . $where . ')="' . $yr . '" ORDER BY id ASC';
    $result = sql_query($mysqli, $sql_stmt);
    return $result;
}