<?php
error_reporting(0);

class Mysql_Method
{
    /**
     * @return array
     */
    public static function Search($para)
    {
        $server = "localhost";
        $user = "root";
        $password = "root";

        $conn = mysqli_connect($server, $user, $password);

        if (mysqli_connect_error()) {
            die("连接失败: " . mysqli_connect_error());
        }

        $result = mysqli_query($conn, "select * from mydb.myguests where firstname='$para'");

        $guests = array();

        while ($row = mysqli_fetch_array($result)) {
            $guest = array('id' => $row['id'], 'firstname' => $row['firstname'], 'lastname' => $row['lastname']);
            $guests[] = $guest;
        }

        mysqli_close($conn);

        $arr = array("guests" => $guests);

        return $arr;
    }
}

function Post($para)
{
    echo json_encode(Mysql_Method::Search($para));
}

if (!empty($_POST)) {
    $parameter = $_POST['firstname'];
}

Post($parameter);