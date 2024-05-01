<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EngineerController extends Controller
{
    /**
     * Handle the search request for engineers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $search = $request->get('q');

        // Assuming you have a role or type column to identify engineers
        $engineers = User::where(function($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        })->where('role', 'engineer') // Adjust according to your role system
          ->get(['id', 'name', 'email']);

        return response()->json($engineers);
    }
}