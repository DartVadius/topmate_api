<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Models\CarModels;
use App\Http\Models\CarParts;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CalculatorController extends Controller
{
    public function createModel(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        $carModel = new CarModels($validatedData);
        $carModel->save();

        return response()->json($carModel, Response::HTTP_OK);
    }

    public function createPart(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        $carPart = new CarParts($validatedData);
        $carPart->save();

        return response()->json($carPart, Response::HTTP_OK);
    }

    public function updateModel(Request $request, $carModelId)
    {
        $carModel = CarModels::findOrFail($carModelId);
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);
        $carModel->fill($validatedData);
        $carModel->save();

        return response()->json($carModel, Response::HTTP_OK);
    }

    public function updatePart(Request $request, $carPartId)
    {
        $carPart = CarParts::findOrFail($carPartId);
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);
        $carPart->fill($validatedData);
        $carPart->save();

        return response()->json($carPart, Response::HTTP_OK);
    }

    public function deleteModel(Request $request, $carModelId)
    {
        $carModel = CarModels::findOrFail($carModelId);
        $carModel->parts()->detach();
        $carModel->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function deletePart(Request $request, $carPartId)
    {
        $carPart = CarParts::findOrFail($carPartId);
        $carPart->models()->detach();
        $carPart->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function getModels(Request $request)
    {

        return response()->json(CarModels::all()->load('parts'), Response::HTTP_OK);
    }

    public function getParts(Request $request)
    {

        return response()->json(CarParts::all(), Response::HTTP_OK);
    }

    public function attach(Request $request, $carModelId, $carPartId)
    {
        $carModel = CarModels::findOrFail($carModelId);
        $carPart = CarParts::findOrFail($carPartId);
        $validatedData = $request->validate([
            'sqft' => 'required|numeric',
            'sqm' => 'required|numeric',
        ]);
        $carModel->parts()->attach($carPart->id, $validatedData);

        return response()->json($carModel->parts()->where('car_consumption.part_id', $carPart->id)->first(), Response::HTTP_OK);
    }

    public function detach(Request $request, $carModelId, $carPartId)
    {
        $carModel = CarModels::findOrFail($carModelId);
        $carPart = CarParts::findOrFail($carPartId);
        $carModel->parts()->detach($carPart->id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function calculate(Request $request, CarModels $carModel, CarParts $carPart)
    {

        return response()->json($carModel->parts()->where('car_consumption.part_id', $carPart->id)->first(), Response::HTTP_OK);
    }
}
