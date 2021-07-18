<?php

class Model
{
    function __construct()
    {

    }

    function loadModel($nombre)
    {
        require_once("models/".$nombre."Model.php");
        $nombre = $nombre."Model";
        $model = new $nombre();
        return $model;
    }
}
?>