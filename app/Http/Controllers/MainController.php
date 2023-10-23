<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Component;
use App\Models\Page;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
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

    // TODO dev!
    public function migrateFreshSeed(): RedirectResponse
    {
        Artisan::call('migrate:fresh --seed');

        return back()->with('success', 'Данные приведены к начальному состоянию');
    }

    public function admin(): Response|ResponseFactory
    {
        $page = Page::query()->with('blocks.component.galleries.images')->first();

        return inertia('Admin/Pages/Edit', compact('page'));
    }

    public function index(): Response|ResponseFactory
    {
        $page = Page::query()->with('blocks.component.galleries.images')->find(1);

        return inertia('Pages/Show', compact('page'));
    }
}
