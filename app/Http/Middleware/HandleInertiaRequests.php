<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use App\Models\PengelolaOrder;
use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        if (auth()->check()) {
            $data = [
                Cart::where('user_id', auth()->user()->id)->count(),
                auth()->user()->name,
                auth()->user()->role->name,
                Role::all(),
                auth()->user()->id,
                PengelolaOrder::where('tour_place_id', auth()->user()->tour_place_id)->where('status', 'pending')->count(),
                auth()->user()->image_profil,
            ];
        }

        return array_merge(parent::share($request), [
            'flash' => [
                'success' => fn () => $request->session()->get('success'),
                'error' => fn () => $request->session()->get('error'),
            ],

            // Lazily
            'data_global' => fn () => $data ?? null,
        ]);
    }
}
