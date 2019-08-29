<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\DeleteSeasonRequest;
use App\Http\Requests\Admin\StoreSeasonRequest;
use App\Http\Requests\Admin\UpdateSeasonRequest;
use App\Models\Games\Season;
use App\Http\Controllers\Controller;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seasons = Season::orderBy('name')->get();
        return view('admin.seasons.index', compact('seasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.seasons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSeasonRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeasonRequest $request)
    {
        $season = new Season($request->all());
        $season->save();

        flash()->success(__('requests.admin.season.successful_store', ['season' => $season->name]));
        return redirect()->route('admin.seasons.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Season $season
     * @return \Illuminate\Http\Response
     */
    public function edit(Season $season)
    {
        return view('admin.seasons.edit', compact('season'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSeasonRequest $request
     * @param  Season $season
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeasonRequest $request, Season $season)
    {
        $season->update($request->all());

        flash()->success(__('requests.admin.season.successful_update', ['season' => $season->name]));
        return redirect()->route('admin.seasons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteSeasonRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DeleteSeasonRequest $request)
    {
        $season = Season::find($request->input('season_id'));
        $season->delete();

        flash()->success(__('requests.admin.season.successful_destroy', ['season' => $season->name]));
        return redirect()->route('admin.seasons.index');
    }
}
