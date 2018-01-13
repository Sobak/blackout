<?php

function mysql_connect($host, $username, $password, $database)
{
    global $link;

    $dsn = "mysql:host=$host;dbname=$database;charset=latin2";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => true,
    ];

    $link = new PDO($dsn, $username, $password, $opt);
}

function mysql_query($query)
{
    global $link;

    return $link->query($query);
}

function mysql_fetch_array(PDOStatement $query)
{
    return $query->fetch(PDO::FETCH_BOTH);
}

function mysql_fetch_assoc(PDOStatement $query)
{
    return $query->fetch(PDO::FETCH_ASSOC);
}

function mysql_escape_string($string)
{
    global $link;

    return substr($link->quote($string), 1, -1);
}

function mysql_real_escape_string($string)
{
    return mysql_escape_string($string);
}

function doquery($query, $table, $fetch = false)
{
    global $link, $debug, $game_config;

    $connection = config('database.default');

    if (!$link) {
        try {
            mysql_connect(
                config("database.connections.$connection.host"),
                config("database.connections.$connection.username"),
                config("database.connections.$connection.password"),
                config("database.connections.$connection.database")
            );
        } catch (\Exception $e) {
            $debug->error($e->getMessage() . "<br />$query", 'SQL Error');
        }
    }

    $sql = str_replace("{{table}}", config("database.connections.$connection.prefix") . $table, $query);

    try {
        $sqlquery = mysql_query($sql);
    } catch (Exception $e) {
        $debug->error($e->getMessage() . "<br>$sql", 'SQL Error');
    }

    if ($game_config['debug']) {
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
    }

    if($fetch) {
        return mysql_fetch_array($sqlquery);
    }

    return $sqlquery;
}
