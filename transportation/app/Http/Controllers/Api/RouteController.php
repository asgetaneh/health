<?php

namespace App\Http\Controllers\Api;

use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\RouteResource;
use App\Http\Resources\RouteCollection;
use App\Http\Requests\RouteStoreRequest;
use App\Http\Requests\RouteUpdateRequest;

class RouteController extends Controller
{
    public function index(Request $request): RouteCollection
    {
        $this->authorize('view-any', Route::class);

        $search = $request->get('search', '');

        $routes = Route::search($search)
            ->latest()
            ->paginate();

        return new RouteCollection($routes);
    }

    public function store(RouteStoreRequest $request): RouteResource
    {
        $this->authorize('create', Route::class);

        $validated = $request->validated();

        $route = Route::create($validated);

        return new RouteResource($route);
    }

    public function show(Request $request, Route $route): RouteResource
    {
        $this->authorize('view', $route);

        return new RouteResource($route);
    }

    public function update(
        RouteUpdateRequest $request,
        Route $route
    ): RouteResource {
        $this->authorize('update', $route);

        $validated = $request->validated();

        $route->update($validated);

        return new RouteResource($route);
    }

    public function destroy(Request $request, Route $route): Response
    {
        $this->authorize('delete', $route);

        $route->delete();

        return response()->noContent();
    }
}
