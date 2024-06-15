<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spending;

class SpendingController extends Controller
{

    public function index()
    {
        $spendings = Spending::paginate(10);  // Fetch spending records with pagination
        return response()->json($spendings);
    }
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'withdrawn' => 'sometimes|boolean',
        ]);

        $spending = new Spending([
            'category' => $request->category,
            'title' => $request->title,
            'date' => $request->date,
            'amount' => $request->amount,
            'withdrawn' => $request->input('withdrawn', false),  // Default to false if not present
            'date_inserted' => now(),
        ]);

        $spending->save();

        // Check if the request wants JSON response
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Spending record created successfully!',
                'data' => $spending
            ], 201);
        }

        // Redirect for web requests
        return redirect()->route('spendings.display')->with('success', 'Spending record created successfully!');
    }

    public function display()
    {
        $spendings = Spending::paginate(100);
        return view('spendings', compact('spendings'));
    }


}
