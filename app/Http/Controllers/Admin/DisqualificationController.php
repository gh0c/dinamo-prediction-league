<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeleteDisqualificationRequest;
use App\Http\Requests\Admin\StoreDisqualificationRequest;
use App\Http\Requests\Admin\UpdateDisqualificationRequest;
use App\Models\Users\Disqualification;

class DisqualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disqualifications = Disqualification::with(['season', 'user'])
            ->leftJoin('seasons', 'seasons.id', '=', 'disqualifications.season_id')
            ->leftJoin('users', 'users.id', '=', 'disqualifications.user_id')
            ->orderBy('seasons.id', 'desc')
            ->orderBy('users.username')
            ->select('disqualifications.*')
            ->get();

        return view('admin.disqualifications.index', compact('disqualifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.disqualifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreDisqualificationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDisqualificationRequest $request)
    {
        $disqualification = new Disqualification($request->all());
        $disqualification->save();

        flash()->success(__('requests.admin.disqualification.successful_store', [
            'season' => $disqualification->season->name,
            'user'   => $disqualification->user->username
        ]));
        return redirect()->route('admin.disqualifications.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Disqualification $disqualification
     * @return \Illuminate\Http\Response
     */
    public function edit(Disqualification $disqualification)
    {
        return view('admin.disqualifications.edit', compact('disqualification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateDisqualificationRequest $request
     * @param  Disqualification $disqualification
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDisqualificationRequest $request, Disqualification $disqualification)
    {
        $disqualification->fill($request->all());
        $disqualification->save();

        flash()->success(__('requests.admin.disqualification.successful_update', [
            'season' => $disqualification->season->name,
            'user'   => $disqualification->user->username
        ]));
        return redirect()->route('admin.disqualifications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  DeleteDisqualificationRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(DeleteDisqualificationRequest $request)
    {
        $disqualification = Disqualification::find($request->input('disqualification_id'));
        $disqualification->delete();

        flash()->success(__('requests.admin.disqualification.successful_destroy', [
            'season' => $disqualification->season->name,
            'user'   => $disqualification->user->username
        ]));
        return redirect()->route('admin.disqualifications.index');
    }
}
