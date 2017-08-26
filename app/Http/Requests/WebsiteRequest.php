<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\URL;

class WebsiteRequest extends FormRequest
{
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
        /* Basic rules for all websites' requests */
        $rules = [
                'name' => 'required|min:3|max:150',
                'description' => 'required|min:350|max:1500',
                'subcategory_id' => 'required|exists:subcategories,id',
                'tags' => 'required|array|min:1|max:6|array_unique',
                'tags.*' => 'required|string|min:3|max:15',
        ];

        if (URL::previous() !== route('website.create')) {
            /* Return only basic rules  if updating existing website */
            return $rules;
        } else {
            /* In addition check website's url if stroing new one */
            $rules['url'] = 'required|url|active_url|unique:websites,url|max:100';
            return $rules;
        }
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tags.*.required' => 'Please refresh the website.',
            'tags.*.string' => 'All tags must be strings.',
            'tags.*.min' => 'All tags must contain at least :min characters.',
            'tags.*.max' => 'All tags must contain maximum :max characters.',
            'tags.array_unique' => 'All tags must be different.',
        ];
    }
}
