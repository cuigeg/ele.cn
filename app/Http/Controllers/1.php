<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getIndex()
    {
         return view('home.index');
    }

     public function getLogin()
    {
         return view('home.Login');
    }

     public function getRegister()
    {
         return view('home.Register');
    }

    public function getPerson()
    {
         return view('home.person');
    }

     public function getOffers()
    {
         return view('home.offers');
    }


    public function getMenu()
    {
         return view('home.menu');
    }

    public function getProducts()
    {
         return view('home.products');
    }


    public function getHelp()
    {
        return view('home.help');
    }


}
