<?php

namespace PatrickRose\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class CreateGig extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->auth->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'about' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->flash->message('That\'s not a valid blog post');
        
        parent::failedValidation($validator);
    }
}
