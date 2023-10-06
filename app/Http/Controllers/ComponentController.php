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
    public function index(): Response|ResponseFactory
    {
        $components = Component::query()->get();

        return inertia('Admin/Components/Index', compact('components'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Component $component)
    {
        //
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
        //
    }
}
