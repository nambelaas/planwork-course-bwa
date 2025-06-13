<?php

namespace App\Http\Controllers;

use Inertia\Response;
use App\Traits\HasFile;
use App\Models\Workspace;
use Illuminate\Support\Str;
use App\Enums\WorkspaceVisibility;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WorkspaceRequest;
use App\Http\Resources\WorkspaceResource;

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

    public function store(WorkspaceRequest $request): RedirectResponse
    {
        $workspace = $request->user()->workspaces()->create([
            'name' => $name = $request->name,
            'slug' => Str::slug($name . Str::uuid()),
            'cover' => $this->uploadFile($request, 'cover', 'workspaces/cover'),
            'logo' => $this->uploadFile($request, 'logo', 'workspaces/logo'),
            'visibility' => $request->visibility
        ]);

        flashMessage("Workspace information saved successfully");

        return to_route('workspaces.show', $workspace);
    }

    public function show(Workspace $workspace): Response
    {
        return inertia('Workspaces/Show', [
            'workspace' => fn() => new WorkspaceResource($workspace)
        ]);
    }

    public function edit(Workspace $workspace): Response
    {
        return inertia('Workspaces/Setting', [
            'workspace' => fn() => new WorkspaceResource($workspace),
            'page_settings' => [
                'title' => 'Edit Workspace',
                'subtitle' => 'Fill out this form to edit workspace',
                'method' => 'PUT',
                'action' => route('workspaces.update', $workspace)
            ],
            'visibilities' => WorkspaceVisibility::options()
        ]);
    }

    public function update(Workspace $workspace, WorkspaceRequest $request): RedirectResponse
    {
        $workspace->update([
            'name' => $name = $request->name,
            'slug' => Str::slug($name . Str::uuid()),
            'cover' => $request->hasFile('cover') ? $this->uploadFile($request, 'cover', 'workspaces/cover') : $workspace->cover,
            'logo' => $request->hasFile('logo') ? $this->uploadFile($request, 'logo', 'workspaces/logo') : $workspace->logo,
            'visibility' => $request->visibility
        ]);

        flashMessage("Successfully update workspace");

        return to_route('workspaces.show', $workspace);
    }
}
