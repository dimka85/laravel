<?php

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameSearchController extends Controller
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
     * Show the application game search page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('game.search');
    }
}
