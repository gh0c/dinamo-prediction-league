<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\BasicPostRequest;

class DeletePredictionRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.admin.prediction.delete';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'prediction_id' => 'required|exists:predictions,id',
        ];
    }
}
