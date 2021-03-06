<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeleteCompetitionRequest;
use App\Http\Requests\Admin\StoreCompetitionRequest;
use App\Http\Requests\Admin\UpdateCompetitionRequest;
use App\Models\Games\Competition;
use Cloudder;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $competitions = Competition::orderBy('sport')->orderBy('name')->get();
        return view('admin.competitions.index', compact('competitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.competitions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCompetitionRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompetitionRequest $request)
    {
        $competition = new Competition($request->all());
        $competition->save();
        $this->storeFeaturedImage($request, $competition);

        flash()->success(__('requests.admin.competition.successful_store', ['competition' => $competition->name]));
        return redirect()->route('admin.competitions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Competition $competition
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition)
    {
        return view('admin.competitions.edit', compact('competition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCompetitionRequest $request
     * @param  Competition $competition
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompetitionRequest $request, Competition $competition)
    {
        $competition->update($request->all());
        $this->storeFeaturedImage($request, $competition);

        flash()->success(__('requests.admin.competition.successful_update', ['competition' => $competition->name]));
        return redirect()->route('admin.competitions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteCompetitionRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DeleteCompetitionRequest $request)
    {
        $competition = Competition::find($request->input('competition_id'));
        $competition->delete();
        $this->deleteLogoFolder($competition);

        flash()->success(__('requests.admin.competition.successful_destroy', ['competition' => $competition->name]));
        return redirect()->route('admin.competitions.index');
    }

    /**
     * @param Request $data
     * @param Competition $competition
     */
    public function storeFeaturedImage($data, $competition)
    {
        if ($data->hasFile('featured_image')) {

            $featuredImage = $data->file('featured_image');
            $filenameToStore = time();

            $folder = $competition->getLogoFolderName();

            // resize the image to heights and widths of 250 and 28 and constrain the aspect ratio

            Cloudder::upload($featuredImage->getRealPath(), $filenameToStore, [
                'folder' => $folder,
                'width'  => 250, 'height' => 250, 'crop' => 'fit',
            ]);

            Cloudder::upload($featuredImage->getRealPath(), 'thumb_' . $filenameToStore, [
                'folder' => $folder,
                'width'  => 28, 'height' => 28, 'crop' => 'fit',
            ]);

            $this->deleteOldLogo($competition);

            $competition->featured_image = $filenameToStore;

            $competition->save();
        }
    }

    /**
     * @param Competition $competition
     */
    public function deleteOldLogo($competition)
    {
        if ($competition->featured_image) {
            Cloudder::destroy($competition->getLogoPublicId());
            Cloudder::destroy($competition->getLogoThumbnailPublicId());
        }
    }

    /**
     * @param  Competition $competition
     */
    public function deleteLogoFolder($competition)
    {
        $this->deleteOldLogo($competition);
    }

}
