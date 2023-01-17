<?php

static $db = null;

function getDB(): PDO
{
    global $db;

    if ($db == null) {
        $dsn = 'mysql:host=localhost;dbname=SunshineParksWeb;charset=utf8';
        $db = new PDO($dsn, "root", "");

        // Throw an Exception when an error occurs
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    return $db;
}