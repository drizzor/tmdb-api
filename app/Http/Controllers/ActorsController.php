<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\ActorViewModel;
use App\ViewModels\ActorsViewModel;
use Illuminate\Support\Facades\Http;

class ActorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = 1)
    {
        abort_if($page > 500, 204);

        $popularActors = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/popular?page=' . $page . '&language=fr-FR')
            ->json();

        abort_if(!isset($popularActors['results']), 404);

        $viewModel = new ActorsViewModel($popularActors['results'], $page);

        return view('actors.index', $viewModel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($actorId)
    {
        $actor = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/person/' . $actorId . '?language=fr-FR&append_to_response=images,combined_credits,external_ids')
            ->json();

        $viewModel = new ActorViewModel($actor);

        return view('actors.show', $viewModel);
    }
}
