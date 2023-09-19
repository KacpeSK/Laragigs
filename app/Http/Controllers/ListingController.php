<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
        // Common Resource Routes:
        // index - Show all listings
        // show - Show single listing
        // create - Show form to create listing
        // store - 


        //show all listings
    public function index(Request $request){
       // dd($request->tag);
        
        // you can get request with helper so instead of dependency injection in index(Request $request) and then use $request['tag'] you can leave index() and then use "request()->tag" or "request('tag')" inside of the function for example.

        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }
        //show single listing
    public function show(Listing $listing){
        return view('listings.show', [
            'listing' => $listing
        ]);
    }
        // Show create form
    public function create() {
        return view('listings.create');
    }

        // Store Listing Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        Listing::create($formFields);

        return redirect('/');
    }

}
