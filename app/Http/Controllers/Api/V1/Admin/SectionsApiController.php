<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Section;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Http\Resources\Admin\SectionResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SectionsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('section_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SectionResource(Section::with(['users'])->get());
    }

    public function store(StoreSectionRequest $request)
    {
        $section = Section::create($request->all());
        $section->users()->sync($request->input('users', []));

        if ($request->input('logo', false)) {
            $section->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
        }

        return (new SectionResource($section))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Section $section)
    {
        abort_if(Gate::denies('section_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SectionResource($section->load(['users']));
    }

    public function update(UpdateSectionRequest $request, Section $section)
    {
        $section->update($request->all());
        $section->users()->sync($request->input('users', []));

        if ($request->input('logo', false)) {
            if (!$section->logo || $request->input('logo') !== $section->logo->file_name) {
                $section->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
            }
        } elseif ($section->logo) {
            $section->logo->delete();
        }

        return (new SectionResource($section))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Section $section)
    {
        abort_if(Gate::denies('section_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $section->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
