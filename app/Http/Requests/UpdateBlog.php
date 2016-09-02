<?php

namespace PatrickRose\Http\Requests;

use Illuminate\Contracts\Validation\Validator;

class UpdateBlog extends BaseRequest
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
            'title' => 'required',
            'content' => 'required'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->flash->message('That\'s not a valid blog post');
        
        parent::failedValidation($validator);
    }
}
