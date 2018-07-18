<?php

namespace App\Http\Controllers\Game;

use App\Models\Game;
use App\Models\GameType;
use Chat;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        // fixme Create Request class!!!
        $gameType = GameType::find($request->game_type);
        
        if (isset($gameType)) {
            $game = $gameType->games()->create([
                'game_name' => $request->game_name,
                'game_players' => $request->game_players,
                'game_mafia' => $request->game_mafia,
                'with_don' => $request->don ? true : false,
                'with_sheriff' => $request->sheriff ? true : false,
            ]);
            
            if (isset($game)) {
                $request->user()->searchgame()->create([
                    'game_id' => $game->id,
                    'is_host' => true,
                ]);
                
                Chat::createGroupConversation($request->game_name, [$request->user()->id]);
                
                return redirect()->route('game.new', ['game' => $game]);
            }
        }
        
        return redirect()->route('game.start')->with('error', __('There was an error creating the game'));
    }
    
    protected function delete(Game $game)
    {
        $game->delete();
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
