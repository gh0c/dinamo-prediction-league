<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicPostRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

/**
 * @property \App\Models\Users\Disqualification $disqualification
 **/
class UpdateDisqualificationRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.admin.disqualification.update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id'   => [
                'required',
                'exists:users,id',
                Rule::unique('disqualifications', 'user_id')->where(function ($query) {
                    /** @var $query Builder */
                    $query->where('season_id', $this->input('season_id'));
                })->ignore($this->disqualification->id),
            ],
            'season_id' => [
                'required',
                'exists:seasons,id',
            ],
            'reason'    => [
                'required',
            ],
        ];
    }
}
