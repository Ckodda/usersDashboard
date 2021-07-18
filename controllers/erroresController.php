<?php
class ErroresController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function render()
    {
        $this->view->renderView("errores/index");
        
    }
}
?>