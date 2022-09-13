<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index(Request $request) {
        $GM_KEY = config('app.GM_KEY');

        $actual_seconds = config('app.actual_seconds');

        $actual_markers = DB::select('select * from markers WHERE created_at > '.time()-$actual_seconds);
        foreach ($actual_markers as $actual_marker => $value) {
            $actual_markers[$actual_marker]->server_time = time();
            $actual_markers[$actual_marker]->actual_time = $actual_markers[$actual_marker]->created_at+$actual_seconds;
        }

        return view('welcome', ['GM_KEY' => $GM_KEY, 'actual_markers' => $actual_markers]);
    }

    public function updateMarkers(Request $request) {
        
        $last_id_marker = $request->last_id_marker;
        $actual_seconds = config('app.actual_seconds');

        $actual_markers = DB::select('select * from markers WHERE id > '.$last_id_marker.' AND created_at > '.time()-$actual_seconds);
        foreach ($actual_markers as $actual_marker => $value) {
            $actual_markers[$actual_marker]->server_time = time();
            $actual_markers[$actual_marker]->actual_time = $actual_markers[$actual_marker]->created_at+$actual_seconds;
        }
        return response()->json($actual_markers);
        
    }

    public function add(Request $request) {

        $request->validate([
            'lat' => 
            array(
                'required',
                'regex:/(^-?[0-9]{1,3}(?:\.[0-9]{1,10})?$)/u'
            ),
            'lng' => 
            array(
                'required',
                'regex:/(^-?[0-9]{1,3}(?:\.[0-9]{1,10})?$)/u'
            )
        ]);

        DB::table('markers')->insert([
            'lat' => $request->lat,
            'lng' => $request->lng,
            'created_at' => time()
        ]);

        return redirect()->route('MainRoute');
    }
}
