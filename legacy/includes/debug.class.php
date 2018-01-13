<?php

class Debug
{
    protected $log = [];
    protected $queryCount = 0;

    public function logQuery(array $queryData)
    {
        ++$this->queryCount;

        $this->log[$this->queryCount] = $queryData;
    }

    public function getLog()
    {
        $render = '<br><table>';

        $render .= '<tr>';
        $render .= '<td class="c">#</td>';
        $render .= '<td class="c">Query</td>';
        $render .= '<td class="c">Called in</td>';
        $render .= '<td class="c">Table</td>';
        $render .= '<td class="c">Fetch</td>';
        $render .= '</tr>';

        foreach ($this->log as $count => $data) {
            $render .= '<tr>';
            $render .= "<th>Query {$count}</th>";
            $render .= "<th>{$data['query']}</th>";
            $render .= "<th>{$data['file']}:{$data['line']}</th>";
            $render .= "<th>{$data['table']}</th>";
            $render .= '<th>' . ($data['fetch'] ? 'yes' : 'no') . '</th>';
            $render .= '</tr>';
        }

        $render .= '</table>';

        return $render;
    }

    public function getQueryCount()
    {
        return $this->queryCount;
    }
    
    public function error($message, $title)
    {
        global $lang, $game_config, $user;

        if ($game_config['debug']) {
            echo "<h2>$title</h2><br><font color=red>$message</font><br><hr>";
            echo $this->getLog();
            die;
        }

        $query = "INSERT INTO {{table}} SET
            `error_sender` = '{$user['id']}' ,
            `error_time` = '".time()."' ,
            `error_type` = '{$title}' ,
            `error_text` = '".mysql_real_escape_string($message)."'";

        doquery($query, 'errors');

        message($lang['sys_database_fail'], $lang['sys_error'], null, 0, false);
    }
}
