<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Authentication;
use Config\Services;

class RootController extends BaseController
{
    public function index()
    {
        $auth = new Authentication(Services::request());

        $resultConnectFromCookie = $auth->connectFromCookie();

        if($resultConnectFromCookie) {
            return redirect('home');
        } 
        else if($resultConnectFromCookie === false) {
            return redirect('/');
        }

        if($auth->getAuthPortfolio()) {
            return redirect('home');
        }
        /*
        if($auth->getIsLoggedIn()) {
            return redirect('home');
        }*/

        return view('root/index');
    }
}
