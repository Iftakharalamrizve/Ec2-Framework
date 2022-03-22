<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class HomeController extends Controller
{
     public  function index()
     {
         $data = [
             'name'=>'Iftakhar Alam Rizve',
             'email' => 'iftakharalam32@gmail.com'
         ];
        return $this->render('layout','home',$data);
     }
}