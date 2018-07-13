<?php

namespace App\Http\Controllers\Game;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
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
     * Show the application game start page.
     *
     * @return \Illuminate\Http\Response
     */
    public function start()
    {
        return view('game.start');
    }
    
    /**
     * Create new game.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Show the application game settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        return view('game.settings');
    }
    
    /**
     * Show the application game statistics.
     *
     * @return \Illuminate\Http\Response
     */
    public function statistics()
    {
        return view('game.statistics');
    }
}
