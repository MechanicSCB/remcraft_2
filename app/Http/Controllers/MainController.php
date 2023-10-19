<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Component;
use App\Models\Page;
use Database\Seeders\DatabaseSeeder;
use Inertia\Response;
use Inertia\ResponseFactory;

class MainController extends Controller
{
    // TODO dev!
    public function reverse()
    {
        (new DatabaseSeeder())->reverse();
        echo 'reversed';
    }

    // TODO dev!
    public function test()
    {
        dd(tmr(), 'test');
    }

    public function admin(): Response|ResponseFactory
    {
        $page = Page::query()->with('blocks.component.galleries.images')->first();

        return inertia('Admin/Pages/Edit', compact('page'));
    }

    public function index(): Response|ResponseFactory
    {
        // TODO load galleries only for galleries
        $page = Page::query()->with('blocks.component.galleries.images')->find(1);

        return inertia('Pages/Show', compact('page'));
    }
}
