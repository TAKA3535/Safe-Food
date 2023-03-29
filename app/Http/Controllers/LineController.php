<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LineController extends Controller
{
    public function create(Request $request)
    {
        $line = new Option;
        $line->line_user_id = $request->input('line_user_id');
        // $line->enable = 'true';
        $line->user_id = Auth::user()->id;
        $line->timestamps = false;
        $line->save();


        // return response()->json(['message' => 'Line user ID has been saved.']);
        return redirect('line');
    }

    // public function destroy(Option $Option)
    // {
    //     $Option->delete();

    //     return response()->json(['message' => 'Line user ID has been deleted.']);
    // }

    public function delete()
    {
        $lines = Option::pluck('line_user_id', 'id');
        return view('line', compact('lines'));
        // 下だとダメだった
        // $lines = Option::all();
        // return view('line', ['lines' => $lines]);

    }

    public function destroy(Request $request)
    {
        Option::where('id', $request->input('line_id'))->delete();
        return redirect()->back()->with('success', 'Line user ID has been deleted.');
    }

    public function update(Request $request)
    {
        $line = Option::find($request->input('line_id'));
        $line->enable = $request->input('enable') === 'true';
        $line->timestamps = false;
        $line->save();
        return redirect()->back()->with('success', 'Line user ID has been updated.');
    }
}
