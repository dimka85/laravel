<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    /**
     * Show the application main page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }
    
    /**
     * Show the application about page.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('info.about');
    }
    
    /**
     * Show the application rules page.
     *
     * @return \Illuminate\Http\Response
     */
    public function rules()
    {
        return view('info.rules');
    }
    
    /**
     * Show the application roles page.
     *
     * @return \Illuminate\Http\Response
     */
    public function roles()
    {
        return view('info.roles');
    }
}
