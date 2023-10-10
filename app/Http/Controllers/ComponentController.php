<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComponentRequest;
use App\Models\Component;
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
        $query = Component::query()->with('galleries.images', 'block.component.galleries.images', 'block.page');

        // FILTER
        if (@$request['title']) {
            $query->where('title', 'like', "%$request->title%");
        }
        if (@$request['page_id']) {
            $query->whereRelation('block', 'page_id', '=', $request['page_id']);
        }
        if (@$request['type']) {
            $query->where('type', '=', $request['type']);
        }

        $components = $query->get();

        return inertia('Admin/Components/Index', compact('components'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Components/Edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ComponentRequest $request)
    {
        $validated = $request->validated();

        Component::query()->create($validated);

        return redirect(route('components.index'))->withSuccess('created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Component $component): Response|ResponseFactory
    {
        $component->load('galleries.images');

        return inertia('Admin/Components/Show', compact('component'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Component $component): Response|ResponseFactory
    {
        $component->load('galleries');

        return inertia('Admin/Components/Edit', compact('component'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ComponentRequest $request, Component $component)
    {
        //dd(tmr(), $request->all(), $request->validated(),$component);
        $validated = $request->validated();

        $component->update($validated);

        return redirect(route('components.edit', $component))->withSuccess('updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Component $component)
    {
        $component->delete();

        return redirect(route('components.index'))->withSuccess('deleted!');
    }
}
