<?php

namespace App\Http\Requests;

use App\Section;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreSectionRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('section_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => [
                'required',
            ],
            'sections.*' => [
                'integer',
            ],
            'sections'   => [
                'array',
            ],
        ];
    }
}
