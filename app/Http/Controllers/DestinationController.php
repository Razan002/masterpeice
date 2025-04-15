<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function indexHome()
    {
        $destinations = Destination::orderBy('created_at', 'desc')->take(4)->get();
        return view('home', compact('destinations'));
    }

    public function index()
    {
        $destinations = Destination::all();
        return view('destination', compact('destinations'));
    }

   
    public function show($id)
    {
        $destination = Destination::findOrFail($id);
        return view('destinationdetails', compact('destination')); // تغيير من show إلى destinationdetails
    }
}