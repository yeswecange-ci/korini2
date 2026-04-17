<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $already = Lead::where('email', $request->email)->exists();

        if ($already) {
            return response()->json([
                'message' => 'Vous êtes déjà inscrit(e).',
                'already' => true,
            ], 200);
        }

        Lead::create([
            'email'      => $request->email,
            'source'     => $request->input('source', 'newsletter'),
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'message' => 'Inscription réussie.',
            'already' => false,
        ], 201);
    }

    public function index()
    {
        $leads = Lead::orderByDesc('created_at')->get();

        return response()->json($leads);
    }
}
