<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Models\Faq;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Faq::all(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'locale' => 'required|in:en',
        ]);

        $faq = new Faq([
            'question_' . $validatedData['locale'] => $validatedData['question'],
            'answer_' . $validatedData['locale'] => $validatedData['answer'],
        ]);
        $faq->save();

        return response()->json($faq, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param Faq $faq
     * @return Response
     */
    public function show(Faq $faq)
    {
        return response()->json($faq, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Faq $faq
     * @return Response
     */
    public function update(Request $request, Faq $faq)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'locale' => 'required|in:en',
        ]);

        $faq->fill([
            'question_' . $validatedData['locale'] => $validatedData['question'],
            'answer_' . $validatedData['locale'] => $validatedData['answer'],
        ])
            ->save();

        return response()->json($faq, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Faq $faq
     * @return Response
     * @throws Exception
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
