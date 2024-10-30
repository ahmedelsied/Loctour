<?php

namespace Loctour\API\V1\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function rules()
    {
        return [
            'place_id'  =>  'sometimes|numeric|exists:places,id',
            'content'   =>  'required|string',
            'media'     =>  'required|image|max:2048'
        ];
    }
}
