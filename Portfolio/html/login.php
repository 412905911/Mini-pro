<?php
    function login() {
        
        $input = file_get_contents('php://input');
        $o = json_decode($input);
        $a = $o->s;
        $email = $a->email;
        $password = $a->password;
    
        $DBconnect = @mysql_connect("localhost", "root", "root") or
        die("<p>The database server is not available</p >");
    
        @mysql_select_db("portfolio", $DBconnect) or
        die("<p>Unable to open the database.</p>" .
            "<p>Error code " . mysql_errno($DBconnect) . ": " .
            mysql_error($DBconnect) . "</p>");
    
        $request = "SELECT IFNULL((SELECT 'Y' from user where Email = '".$email."' AND Password = '".$password."' limit 1),'N')";
    
        $queryResult = @mysql_query($request, $DBconnect) or
        die("<p>Unable to execute the request.</p>".
            "<p>Error code " . mysql_errno($DBconnect) . ": " .
            mysql_error($DBconnect) . "</p>");

        $resultArray = mysql_fetch_row($queryResult);
        if ($resultArray[0] == 'Y') {
            session_start(); 

            $_SESSION[$email] = true; 

            echo 'YES';
        }
        else {
            echo 'NO';
        }
        
        mysql_close($DBconnect);
    }

    $action = $_GET['action'];
    if ($action === "login") {
        login();
    }
?>