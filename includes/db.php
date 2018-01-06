<?php

function doquery($query, $table, $fetch = false)
{
    global $numqueries, $link, $debug, $dbsettings;

    if (!$link) {
        $link = mysql_connect($dbsettings["server"], $dbsettings["user"], $dbsettings["pass"]);

        if (!$link) {
            $debug->error(mysql_error()."<br />$query", 'SQL Error');
        }

        mysql_select_db($dbsettings["name"]) or $debug->error(mysql_error()."<br />$query", 'SQL Error');
        mysql_query("SET NAMES latin2");
        echo mysql_error();
    }

    $sql = str_replace("{{table}}", $dbsettings["prefix"].$table, $query);
    $sqlquery = mysql_query($sql) or $debug->error(mysql_error()."<br />$sql<br />", 'SQL Error');

    $numqueries++;

    $arr = debug_backtrace();
    $file = end(explode('/', $arr[1]['file']));
    $line = $arr[1]['line'];
    $debug->add("<tr><th>Query $numqueries: </th><th>$query</th><th>$file($line)</th><th>$table</th><th>$fetch</th></tr>");

    if($fetch) {
        return mysql_fetch_array($sqlquery);
    }

    return $sqlquery;
}
