<?php

namespace App\Http\Controllers\Mod;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mod\DeletePlayerRequest;
use App\Http\Requests\Mod\StorePlayerRequest;
use App\Http\Requests\Mod\UpdatePlayerRequest;
use App\Models\Games\Player;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::realPlayers()->with('team')
            ->leftJoin('teams', 'players.team_id', '=', 'teams.id')
            ->orderBy('teams.sport')->orderBy('teams.name')->orderBy('players.name')
            ->get('players.*');
        return view('mod.players.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mod.players.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePlayerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlayerRequest $request)
    {
        $player = new Player($request->all());
        $player->is_mod_approved = true;
        $player->is_own_goal_scorer = false;
        $player->save();

        flash()->success(__('requests.mod.player.successful_store', ['player' => $player->name]));
        return redirect()->route('mod.players.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Player $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        return view('mod.players.edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePlayerRequest $request
     * @param  Player $player
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlayerRequest $request, Player $player)
    {
        $player->is_mod_approved = true;
        $player->is_own_goal_scorer = false;

        $player->update($request->all());

        flash()->success(__('requests.mod.player.successful_update', ['player' => $player->name]));
        return redirect()->route('mod.players.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeletePlayerRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DeletePlayerRequest $request)
    {
        $player = Player::find($request->input('player_id'));
        $player->delete();

        flash()->success(__('requests.mod.player.successful_destroy', ['player' => $player->name]));
        return redirect()->route('mod.players.index');
    }

}
