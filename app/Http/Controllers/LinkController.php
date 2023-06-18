<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Exception;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index () {

        $links = Link::latest()->take(10)->get();
        
        return view('welcome',['links' => $links]);
    }

    public function shortenLink (Request $request) {
        
        $formData = $request->validate([
            'inputLink' => 'required|unique:links',
            'counter' => 'required',
            'outputLink' => 'required',
        ]);

       try {
            $links = Link::create($formData);
            return response()->json($links);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        
    }
}
