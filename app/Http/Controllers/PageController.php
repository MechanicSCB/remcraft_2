<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Response;
use Inertia\ResponseFactory;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request, Page $page): Response|ResponseFactory|Collection
    {
        $limit = 30;

        // Get only limited number of blocks
        $page->setRelation(
            'blocks',
            $page->blocks()->with('component.galleries.images')->take($limit)->get()
        );

        return inertia('Pages/Show', compact('page'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response|ResponseFactory
    {
        // $pages = Page::query()->with('blocks.component.galleries.images')->get();
        $pages = Page::query()->get();

        return inertia('Admin/Pages/Index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Pages/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $validated = $request->validated();

        Page::query()->create($validated);

        return redirect(route('pages.index'))->withSuccess('created!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page): Response|ResponseFactory
    {
        $page->load('blocks.component.galleries.images');

        return inertia('Admin/Pages/Edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Page $page)
    {
        $validated = $request->validated();

        $page->update($validated);

        return back()->with('success', 'updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return back()->with('success', 'Удалено!');
    }
}
