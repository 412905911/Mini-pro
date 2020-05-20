<?php
    function fetchAll() {
        $DBconnect = @mysql_connect("localhost", "root", "root") or
        die("<p>The database server is not available</p >");
    
        @mysql_select_db("portfolio", $DBconnect) or
        die("<p>Unable to open the database.</p>" .
            "<p>Error code " . mysql_errno($DBconnect) . ": " .
            mysql_error($DBconnect) . "</p>");
    
        $request = "SELECT * FROM blog";
    
        $queryResult = @mysql_query($request, $DBconnect) or
        die("<p>Unable to execute the request.</p>" .
            "<p>Error code " . mysql_errno($DBconnect) . ": " .
            mysql_error($DBconnect) . "</p>");
    
        $data = array();
        $row = array();
        do {
            array_push($data, $row);
        } while ($row = mysql_fetch_row($queryResult));
    
        $retItems = array();
        foreach ($data as $key => $value) {
            if ($value != null) {
                array_push($retItems, array('date'=>$value[0], 'title'=>$value[1], 'content'=>$value[2]));
                // $retItems = array('date'=>$value[0], 'title'=>$value[1], 'content'=>$value[2]);
            }
        }
    
        $json = json_encode($retItems);
    
        echo $json;
    
        mysql_close($DBconnect);
    }

    $action = $_GET['action'];
    if ($action === "fetchAll") {
        fetchAll();
    }
?>
