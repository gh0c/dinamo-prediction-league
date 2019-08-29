<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\DeleteTeamRequest;
use App\Http\Requests\Admin\StoreTeamRequest;
use App\Http\Requests\Admin\UpdateTeamRequest;
use App\Http\Controllers\Controller;
use App\Models\Team;
use File;
use Illuminate\Http\Request;
use Image;
use Storage;

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
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teams.create');
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

        flash()->success(__('requests.admin.team.successful_store', ['team' => $team->name]));
        return redirect()->route('admin.teams.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Team $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
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

        flash()->success(__('requests.admin.team.successful_update', ['team' => $team->name]));
        return redirect()->route('admin.teams.index');
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

        flash()->success(__('requests.admin.team.successful_destroy', ['team' => $team->name]));
        return redirect()->route('admin.teams.index');
    }

    /**
     * @param Request $data
     * @param Team $team
     */
    public function storeFeaturedImage($data, $team)
    {
        if ($data->hasFile('featured_image')) {

            $featuredImage = $data->file('featured_image');
            $filenameToStore = time() . '.' . $featuredImage->getClientOriginalExtension();

            $folder = $team->getLogoFolderName();
            Storage::disk('public')->makeDirectory($folder);

            $image = Image::make($featuredImage);

            // resize the image to heights and widths of 250 and 28 and constrain the aspect ratio
            $image->resize(250, 250, function ($constraint) {
                /** @var \Intervention\Image\Constraint $constraint */
                $constraint->aspectRatio();
            })->save(Storage::disk('public')->path($folder) . '/' . $filenameToStore);

            $image->resize(28, 28, function ($constraint) {
                /** @var \Intervention\Image\Constraint $constraint */
                $constraint->aspectRatio();
            })->save(Storage::disk('public')->path($folder) . '/' . 'thumb_' . $filenameToStore);

            $this->deleteOldLogo($team);

            $team->featured_image = $filenameToStore;

            $team->save();
        }
    }

    /**
     * @param Team $team
     */
    public function deleteOldLogo($team)
    {
        $oldFilename = $team->featured_image;

        if ($oldFilename) {
            $folder = $team->getLogoFolderName();

            File::delete(Storage::disk('public')->path($folder) . '/' . $oldFilename);
            File::delete(Storage::disk('public')->path($folder) . '/' . '/thumb_' . $oldFilename);
        }
    }

    /**
     * @param  Team $team
     */
    public function deleteLogoFolder($team)
    {
        $folder = $team->getLogoFolderName();

        File::deleteDirectory(Storage::disk('public')->path($folder));
    }

}
