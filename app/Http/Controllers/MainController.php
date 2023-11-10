<?php

namespace App\Http\Controllers;

use App\Classes\TreeHandler;
use App\Models\Block;
use App\Models\Component;
use App\Models\Node;
use App\Models\Page;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
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
        $res = [];
        $pagesSlugs = Page::query()->pluck('slug')->toArray();

        $components = Component::query()
            ->get(['id', 'type', 'datum']);

        $links = [];

        foreach ($components as $component) {
            if (str_contains(json_encode($component['datum']), 'href')) {
                // hrefs from html string
                $hrefs = explode('href', json_encode($component['datum'], JSON_UNESCAPED_UNICODE));
                array_shift($hrefs);
                $hrefs = array_map(fn($v) => Str::before(ltrim($v, '=\":'), '"'), $hrefs);

                // dd(tmr(),$hrefs);
                // hrefs from datum array
                // $hrefs = array_filter(flatten($component['datum']), fn($v, $k) => str_ends_with($k, 'href'), ARRAY_FILTER_USE_BOTH);
                $hrefs = array_filter($hrefs, fn($v) => !Str::contains($v, ['youtube', 'remcraft.ru1', 'mail']));
                $hrefs = array_filter($hrefs, fn($v) => !in_array(trim($v, '/\\'), $pagesSlugs));

                if (count($hrefs) === 0) {
                    continue;
                }

                $links[$component['id']] = [
                    'type' => $component['type'],
                    // 'datum' => $component['datum'],
                    'links' => $hrefs,
                ];
            }
        }

        dd(tmr(), $links);

        $old = 'https:\/\/remcraft.ru\/otdelka-fasada';
        $new = '/otdelka-fasada-chastnogo-doma';

        $components = Component::query()
            ->where('datum', 'like', "%$old%")
            ->get(['id', 'datum']);

        $count = $components->count();
        dd(tmr(), $count, @$components->toArray());

        foreach ($components as $component) {
            $tmp = json_encode($component['datum'], JSON_UNESCAPED_UNICODE);
            $tmp = str_replace($old, $new, $tmp);
            $component['datum'] = $tmp;
            // $component->save();
        }

        dd(tmr(), $count, count($links));

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
