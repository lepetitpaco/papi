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
            'withdrawn' => 'required|boolean',
        ]);

        $spending = new Spending([
            'category' => $request->category,
            'title' => $request->title,
            'date' => $request->date,
            'amount' => $request->amount,
            'withdrawn' => $request->withdrawn,
            'date_inserted' => now(), // Laravel's helper function for the current timestamp
        ]);

        $spending->save();

        return response()->json([
            'message' => 'Spending record created successfully!',
            'data' => $spending
        ], 201);
    }

}
