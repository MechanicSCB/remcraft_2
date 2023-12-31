<?php

namespace App\Http\Middleware;

use App\Models\Block;
use App\Models\Component;
use App\Models\Image;
use App\Models\Item;
use App\Models\Node;
use App\Models\Page;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $return = [
            ...parent::share($request),
            'ziggy' => fn() => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
                'request_all' => $request->all(),
                'routeName' => $request->route()->getAction('as'),
            ],
            'flash' => [
                'message' => fn() => $request->session()->get('message'),
                'success' => fn() => $request->session()->get('success'),
                'warning' => fn() => $request->session()->get('warning'),
                'error' => fn() => $request->session()->get('error'),
            ],
            'menu' => Node::getMenu(),
            'nodesTitles' => Node::query()->pluck('title','path'),
            'imgFormats' => Image::$formats,
        ];

        // Add shared data to admin pages
        if(in_array('auth',$request->route()->middleware())){
            $return = [
                ...$return,
                'pages' => Page::query()->with('nodes')->get()->keyBy('id'),
                'blocks' => Block::query()->with('page:id,slug')->get(['id','page_id'])->append('url')->keyBy('id'),
                'components' => Component::getComponentsWithPages(),
                'componentTypes' => Component::$types,
            ];
        }

        return $return;
    }
}
