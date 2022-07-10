<?php 
    function total($table)
    {
        $db = \Config\Database::connect();
        return $db->table($table)->countAllResults();
    }
