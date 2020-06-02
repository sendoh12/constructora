<?php

namespace App\Http\Controllers;
use Response;
use Illuminate\Http\Request;
// use Request;

class ClienteController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function nosotros(){
        return view('Nosotros');
    }

    public function Servisios()
    {
        return view('Servicio');
    }

    public function Cliente(){
        return view('Cliente');
    }

    public function blog()
    {
        return view('Blog');
    }

    public function Contacto()
    {
        return view('Contacto');
    }
}