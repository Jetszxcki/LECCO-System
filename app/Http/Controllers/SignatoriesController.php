<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Signatory;

class SignatoriesController extends Controller
{
    public function index()
    {   
    	$signatories = Signatory::all();
    	return view('signatories.index', compact('signatories'));
    }

    public function create()
    {	
    	$signatory = new Signatory();
    	return view('signatories.create', compact('signatory'));
    }

    public function store(Request $request)
    {
    	Signatory::create($this->validateRequest($request));

    	return redirect('signatories')->with([
            'message' => "Signatory of {$request->name} successfully added.",
            'styles' => 'alert-success'
        ]);
    }

    public function edit(Signatory $signatory)
    {
        return view('signatories.edit', compact('signatory'));
    }

    public function update(Request $request, Signatory $signatory)
    {   
        $signatory->update($this->validateRequest($request));
        return redirect('signatories')->with([
            'message' => "Signatory of {$signatory->name} successfully updated.",
            'styles' => 'alert-success'
        ]);
    }

    public function destroy(Signatory $signatory)
    {   
        $signatory->delete();
        return redirect('signatories')->with([
            'message' => "Signatory of {$signatory->name} has been deleted.",
            'styles' => 'alert-danger'
        ]);
    }

    // other functions
    private function validateRequest($request)
    {
    	return $request->validate([
    		'name' => 'required|min:2',
    		'designation' => 'required|min:2'
    	]);
    }
}
