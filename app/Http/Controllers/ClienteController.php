<?php

namespace App\Http\Controllers;
use Response;
use Illuminate\Http\Request;
use App\cd_proyectos;


class ClienteController extends Controller
{
    public function index()
    {
        $proyect=new cd_proyectos();
        $lista=$proyect->getproyectos();
        return view('index',compact('lista'));
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