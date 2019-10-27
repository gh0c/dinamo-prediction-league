<?php

namespace App\Http\Requests\Home;

use App\Http\Requests\BasicPostRequest;
use Auth;

class DeletePredictionRequest extends BasicPostRequest
{
    protected $defaultMessageLangKey = 'requests.home.predictions.delete.default_message';

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

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            /** @var \Illuminate\Validation\Validator $validator */

            if (!Auth::user()->predictions()->find($this->input('prediction_id'))) {
                $validator->errors()->add('field', __('requests.home.predictions.delete.not_owned_by'));
            }

        });
    }
}
