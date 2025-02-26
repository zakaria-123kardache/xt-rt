<?php

namespace App\Controller;

use App\Controller\Controller;

class IndexController extends Controller {
    

    public function index ()
    {
        return $this->render("pages.home");
    }
    public function produit ()
    {
        return $this->render("pages.produit");
    }
    
}
