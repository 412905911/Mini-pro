<?php
    function addPost() {
        
        $input = file_get_contents('php://input');
        $o = json_decode($input);
        $a = $o->s;
        $title = $a->title;
        $content = $a->content;
        $date = $a->date;
    
        $DBconnect = @mysql_connect("localhost", "root", "root") or
        die("<p>The database server is not available</p >");
    
        @mysql_select_db("portfolio", $DBconnect) or
        die("<p>Unable to open the database.</p>" .
            "<p>Error code " . mysql_errno($DBconnect) . ": " .
            mysql_error($DBconnect) . "</p>");
    
        $request = "insert into blog ( Date, Title, Content ) values ('".$date."', '".$title."', '".$content."')";
    
        $queryResult = @mysql_query($request, $DBconnect) or
        die("<p>Unable to execute the request.</p>".
            "<p>Error code " . mysql_errno($DBconnect) . ": " .
            mysql_error($DBconnect) . "</p>");

            if ($queryResult) {
                echo "YES";
            }
            else {
                echo "NO";
            }    
        
        mysql_close($DBconnect);
    }

    $action = $_GET['action'];
    if ($action === "addPost") {
        addPost();
    }
?>