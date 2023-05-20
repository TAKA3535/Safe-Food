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
        if ($request->has('line_user_id')) {
            $line = new Option;
            $line->line_user_id = $request->input('line_user_id');
            $line->line_user_name = $request->input('line_user_name');
            // $line->enable = 'true';
            $line->user_id = Auth::user()->id;
            $line->timestamps = false;
            $line->save();
        } else {
            $email = new Option;
            $email->email = $request->input('email');
            $email->user_id = Auth::user()->id;
            $email->timestamps = false;
            $email->save();
        }


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
        // $lines = Option::pluck('line_user_id', 'id', 'enable');
        // // dd($lines);
        // return view('line', compact('lines'));
        $userId = Auth::id();
        $lines = Option::select('line_user_id', 'line_user_name', 'id', 'enable', 'user_id')->where('user_id', $userId)->whereNotNull('line_user_id')->get();
        $mails = Option::select('email', 'id', 'enable', 'user_id')->where('user_id', $userId)->whereNotNull('email')->get();
        $datas = [
            'lines' => $lines,
            'mails' => $mails,
        ];
        // dd($lines);
        return view('line', $datas);
    }

    public function destroy(Request $request)
    {
        Option::where('id', $request->input('line_id'))->delete();
        return redirect()->back()->with('success', 'Line user ID has been deleted.');
    }

    public function update(Request $request)
    {
        if ($request->has('line_id')) {
            $line = Option::find($request->input('line_id'));
            $line->enable = $request->input('enable') === 'true';
            // $line->line_user_name = $request->input('line_name');
            $line->timestamps = false;
            $line->save();
            return redirect()->back()->with('success', 'Line user ID has been updated.');
        } else {
            $line = Option::find($request->input('mail'));
            $line->enable = $request->input('enable') === 'true';
            // $line->line_user_name = $request->input('line_name');
            $line->timestamps = false;
            $line->save();
        }
        // $line = Option::find($request->input('line_id'));
        // $line->enable = $request->input('enable') === 'true';
        // // $line->line_user_name = $request->input('line_name');
        // $line->timestamps = false;
        // $line->save();
        return redirect()->back()->with('success', 'Line user ID has been updated.');
    }
}
