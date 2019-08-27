<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BasicPostRequest extends FormRequest
{
    protected $defaultMessage = '';

    protected $defaultMessageLangKey = 'validation.default_error';

    /**
     * Return validation message to be flashed to the next request
     *
     * @return string
     */
    protected function getDefaultValidationMessage()
    {
        // Use default message if it's set
        // Use localized message based on the message key otherwise
        // Message key should be overwritten in child classes

        $message = empty($this->defaultMessage) ? __($this->defaultMessageLangKey) : $this->defaultMessage;

        return $message;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        flash()->error($this->getDefaultValidationMessage())->important();
        parent::failedValidation($validator);
    }
}
