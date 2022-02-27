<?php
    session_start();
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $domain = 'https://'.$_SERVER['SERVER_NAME'].'/';
    class HTML {
        function connect() {
            $connect = mysqli_connect('localhost', 'root', '', 'unknown-social') or die('Đụ má mày lồn Quyết im hộ tau cái');
            $connect->set_charset("utf8");
            return $connect;
        }
        function options($name) {
            $result = mysqli_query($this->connect, "SELECT * FROM `options` WHERE `name` = '$name' ")->fetch_array();
            return $result['value'];
        }
        function name($username) {
            $result = mysqli_query($this->connect, "SELECT * FROM `users` WHERE `username` = '".$_SESSION['username']."' ")->fetch_array();
            return $result[$username];
        }
        function db_row($name) {
            $result = mysqli_query($this->connect(), $name);
            $row = mysqli_fetch_array($result);
            return $row;
        }
        function db_nums($name) {
            $result = mysqli_query($this->connect(), $name);
            $row = mysqli_num_rows($result);
            return $row;
        }
        function db_list($name) {
            $result = mysqli_query($this->connect(), $name);
            while ($row = mysqli_fetch_array($result)) {
                $return[] = $row;
            }
            return $return;
        }
        function insert($table, $values) {
            $f = '';
            $x = '';
            foreach ($values as $key => $value) {
                $f .= ",$key";
                $x .= ",'".mysqli_real_escape_string($this->connect(), $value)."'";
            }
            $row = 'INSERT INTO '.$table. '('.trim($f, ',').') VALUES ('.trim($x, ',').')';
            return mysqli_query($this->connect(), $row);
        }





        function delete($table, $where) {
            $result = "DELETE FROM $table WHERE $where";
            return mysqli_query($this->connect(), $result);
        }
    }
  