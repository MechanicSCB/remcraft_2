<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComponentRequest;
use App\Models\Component;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response|ResponseFactory
    {
        $query = Component::query()->with('blocks');

        // FILTER
        if (@$request['title']) {
            $query->where('title', 'like', "%$request->title%");
        }
        if (!is_null($request['page_id'])) {
            if ($request['page_id'] === '0') {
                $query->doesntHave('blocks');
            } else {
                $query->whereRelation('blocks', 'page_id', '=', $request['page_id']);
            }
        }
        if (@$request['type']) {
            $query->where('type', '=', $request['type']);
        }

        $query->latest();

        $components = $query->get(['id', 'slug', 'title', 'type']);

        return inertia('Admin/Components/ComponentsIndex', compact('components'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Components/ComponentCreateEdit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComponentRequest $request): RedirectResponse
    {
        Component::query()->create($request->validated());

        return redirect(route('components.index'))->with('success', 'created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Component $component): Response|ResponseFactory
    {
        $component->load('galleries.images');

        return inertia('Admin/Components/ComponentShow', compact('component'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Component $component): Response|ResponseFactory
    {
        $component->load('galleries');

        return inertia('Admin/Components/ComponentCreateEdit', compact('component'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComponentRequest $request, Component $component)
    {
        $component->update($request->validated());

        return redirect(route('components.edit', $component))->withSuccess('updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Component $component): RedirectResponse
    {
        $component->delete();

        return redirect(route('components.index'))->with('success', 'deleted!');
    }
}
