<?php

namespace App\Http\Controllers\Mod;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mod\DeleteTeamRequest;
use App\Http\Requests\Mod\StoreTeamRequest;
use App\Http\Requests\Mod\UpdateTeamRequest;
use App\Models\Games\Team;
use Cloudder;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::orderBy('sport')->orderBy('name')->get();
        return view('mod.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mod.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTeamRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeamRequest $request)
    {
        $team = new Team($request->all());
        $team->save();
        $this->storeFeaturedImage($request, $team);

        flash()->success(__('requests.mod.team.successful_store', ['team' => $team->name]));
        return redirect()->route('mod.teams.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Team $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('mod.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTeamRequest $request
     * @param  Team $team
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $team->update($request->all());
        $this->storeFeaturedImage($request, $team);

        flash()->success(__('requests.mod.team.successful_update', ['team' => $team->name]));
        return redirect()->route('mod.teams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteTeamRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DeleteTeamRequest $request)
    {
        $team = Team::find($request->input('team_id'));
        $team->delete();
        $this->deleteLogoFolder($team);

        flash()->success(__('requests.mod.team.successful_destroy', ['team' => $team->name]));
        return redirect()->route('mod.teams.index');
    }

    /**
     * @param  Request $data
     * @param  Team $team
     */
    public function storeFeaturedImage($data, $team)
    {
        if ($data->hasFile('featured_image')) {

            $featuredImage = $data->file('featured_image');
            $filenameToStore = time();

            $folder = $team->getLogoFolderName();

            // resize the image to heights and widths of 250 and 28 and constrain the aspect ratio

            Cloudder::upload($featuredImage->getRealPath(), $filenameToStore, [
                'folder' => $folder,
                'width'  => 250, 'height' => 250, 'crop' => 'fit',
            ]);

            Cloudder::upload($featuredImage->getRealPath(), 'thumb_' . $filenameToStore, [
                'folder' => $folder,
                'width'  => 28, 'height' => 28, 'crop' => 'fit',
            ]);

            $this->deleteOldLogo($team);

            $team->featured_image = $filenameToStore;

            $team->save();
        }
    }

    /**
     * @param  Team $team
     */
    public function deleteOldLogo($team)
    {
        if ($team->featured_image) {
            Cloudder::destroy($team->getLogoPublicId());
            Cloudder::destroy($team->getLogoThumbnailPublicId());
        }
    }

    /**
     * @param  Team $team
     */
    public function deleteLogoFolder($team)
    {
        $this->deleteOldLogo($team);
        // No deleting folders on Cloudinary at this point
    }

}
