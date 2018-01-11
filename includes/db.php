<?php

function doquery($query, $table, $fetch = false)
{
    global $link, $debug, $dbsettings;

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

    $arr = debug_backtrace();
    $file = end(explode('/', $arr[0]['file']));
    $line = $arr[0]['line'];

    $debug->logQuery([
        'query' => $query,
        'file' => $file,
        'line' => $line,
        'table' => $table,
        'fetch' => $fetch,
    ]);

    if($fetch) {
        return mysql_fetch_array($sqlquery);
    }

    return $sqlquery;
}
