<?php

namespace App\Http\Controllers;

use App\Models\Page;
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
        $page['blocks'] = $page->blocks()->with('component.galleries')
            ->take(3)
            ->get();

        return inertia('Pages/Show', compact('page'));
    }

    public function showOld(Page $page): Response|ResponseFactory
    {
        $page->load('blocks.component.galleries');
        $page['time'] = tmr(null, 3);

        return inertia('Pages/Show', compact('page'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        //
    }
}
