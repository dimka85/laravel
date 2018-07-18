<?php

namespace App\Http\Controllers\Game;

use App\Models\Game;
use Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpJunior\LaravelVideoChat\Models\Group\Conversation\GroupConversation;

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
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Game $game
     * @return \Illuminate\View\View
     */
    public function new(Request $request, Game $game)
    {
        $searchgame = $request->user()->searchgame;
        $groupConversationId = GroupConversation::where('name', $game->game_name)->value('id');
        
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
            
            Chat::addMembersToExistingGroupConversation($groupConversationId, [$request->user()->id]);
        }
        
        return view('game.new', [
            'game' => $game->with('searchgames'),
            'conversation' => Chat::getGroupConversationMessageById($groupConversationId)
        ]);
    }
}
