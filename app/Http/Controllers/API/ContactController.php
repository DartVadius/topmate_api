<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    public function index () {
        return response()->json(Contact::where('is_new', true)->orderBy('created_at', 'desc')->get(), Response::HTTP_OK);
    }

    public function viewed () {
        return response()->json(Contact::where('is_new', false)->orderBy('created_at', 'desc')->paginate(15), Response::HTTP_OK);
    }

    public function store (Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
        $contact = new Contact($validatedData);
        $contact->save();

        return response()->json($contact, Response::HTTP_OK);
    }

    public function update (Request $request, $contactId) {
        $contact = Contact::findOrFail($contactId);
        $contact->is_new = 0;
        $contact->save();

        return response()->json($contact, Response::HTTP_OK);
    }
}
