<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surprise;
use Carbon\Carbon;
use Illuminate\Http\Response;

class SurpriseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'recipient_name' => 'required|string',
            'recipient_email' => 'required|email',
            'message' => 'required|string',
            'date' => 'required|date',
            'media' => 'nullable|file',
        ]);

        $filePath = $request->file('media')?->store('public/surprises');

        $surprise = Surprise::create([
            'recipient_name' => $validated['recipient_name'],
            'recipient_email' => $validated['recipient_email'],
            'message' => $validated['message'],
            'media_path' => $filePath,
            'send_at' => Carbon::parse($validated['date']),
        ]);

        return response()->json(["message" => "Surprise Scheduled!", "surprise" => $surprise]);
    }

    public function show($id)
    {
        $surprise = Surprise::findOrFail($id);

        // return response()->json( $surprise);
        return view('surprise.show', compact('surprise'));

        // if (!$surprise) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'surprise not found',
        //     ], Response::HTTP_NOT_FOUND);
        // }

        // return response()->json([
        //     'status' => 'success',
        //     'data' => $surprise,
        // ], Response::HTTP_OK);
    }
}

