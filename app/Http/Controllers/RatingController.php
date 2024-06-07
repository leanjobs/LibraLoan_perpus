<?php

namespace App\Http\Controllers;

use App\Models\rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function showRating()
    {

        $ratings = rating::with(['user', 'bukus'])->latest()->get();
        foreach ($ratings as $rating) {
            if (!$rating->bukus) {
                dd($rating->bukus);
                dd('Buku not found for rating ID: ' . $rating->id . ' with bukus_id: ' . $rating->bukus_id);
            }
        }
        // dd($ratings);
        return view('perpus.rating.index', compact('ratings'));
    }

    public function updateRating(Request $request)
    {
        $rating = rating::find($request->rating_id);

        if ($rating) {
            $rating->status = $rating->status == 1 ? 0 : 1;
            $rating->save();

            return redirect()->back()->with('success', 'Rating status updated successfully!');
        }

        return redirect()->back()->with('error', 'Rating not found');
    }
}
