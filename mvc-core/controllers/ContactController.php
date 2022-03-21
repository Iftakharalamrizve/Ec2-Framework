<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class ContactController extends Controller
{
    public  function index()
    {
        $data = [
            'name'=>'Iftakhar Alam Rizve',
            'email' => 'iftakharalam32@gmail.com'
        ];
        $this->setLayout('layout');
        return $this->render('contact',$data);
    }

    public function save(Request $request)
    {
        print_r($request->getBody());
        exit;
    }
}