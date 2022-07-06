<?php

namespace App\Http\Controllers;
use App\Models\Chart;
use App\Http\Resources\Chart as ChartResource;
use App\Http\Resources\ChartCollection;
// use App\Http\Resources\Chart;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        return new ChartCollection(Chart::all());
    }

    public function show($id)
    {
        return new ChartResource(Chart::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $player = Chart::create($request->all());

        return (new ChartResource($player))
                ->response()
                ->setStatusCode(201);
    }

    public function answer($id, Request $request)
    {
        $request->merge(['correct' => (bool) json_decode($request->get('correct'))]);
        $request->validate([
            'correct' => 'required|boolean'
        ]);

        $player = Chart::findOrFail($id);
        $player->answers++;
        $player->points = ($request->get('correct')
                           ? $player->points + 1
                           : $player->points - 1);
        $player->save();

        return new ChartResource($player);
    }

    public function delete($id)
    {
        $player = Chart::findOrFail($id);
        $player->delete();

        return response()->json(null, 204);
    }

    public function resetAnswers($id)
    {
        $player = Chart::findOrFail($id);
        $player->answers = 0;
        $player->points = 0;

        return new ChartResource($player);
    }
}
