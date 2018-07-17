<?php

namespace App\Http\Controllers\Game;

use App\Models\Game;
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
    
    /**
     * Show the application new game page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\View\View
     */
    public function new(Request $request, Game $game)
    {
        $searchgame = $request->user()->searchgame;
        
        if (isset($searchgame)) {
            $searchgameGame = $searchgame->game;
            
            if ($searchgameGame->id !== $game->id) {
                return view('game.new', ['game' => $searchgameGame->with('searchgames')])->with(
                    'warning',
                    __('You can not start a new game until you leave the current one')
                );
            }
        } else {
            $request->user()->searchgame()->create([
                'game_id' => $game->id,
                'is_host' => false,
            ]);
        }
        
        return view('game.new', ['game' => $game->with('searchgames')]);
    }
}
