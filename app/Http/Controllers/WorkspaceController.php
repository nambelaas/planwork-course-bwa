<?php

namespace App\Http\Controllers;

use App\Traits\HasFile;
use Inertia\Response;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Enums\WorkspaceVisibility;
use App\Http\Requests\WorkspaceRequest;

class WorkspaceController extends Controller
{
    use HasFile;
    public function create(): Response
    {
        return inertia(component: 'Workspaces/Create', props: [
            'page_settings' => [
                'title' => 'Create Workspace',
                'subtitle' => 'Fill out this form to add a new workspace',
                'method' => 'POST',
                'action' => route('workspaces.store')
            ],
            'visibilities' => WorkspaceVisibility::options()
        ]);
    }

    public function store(WorkspaceRequest $request)
    {
        $request->user()->workspaces()->create([
            'name' => $name = $request->name,
            'slug' => Str::slug($name . Str::uuid()),
            'cover' => $this->uploadFile($request, 'cover', 'workspaces/cover'),
            'logo' => $this->uploadFile($request, 'logo', 'workspaces/logo'),
            'visibility' => $request->visibility
        ]);

        flashMessage("Workspace information saved successfully");

        return back();
    }
}
