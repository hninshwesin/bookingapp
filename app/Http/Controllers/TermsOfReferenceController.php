<?php

namespace App\Http\Controllers;

use App\TermsOfReference;
use Illuminate\Http\Request;

class TermsOfReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $termsOfReference = TermsOfReference::all();

        return view('terms_of_reference.index', compact('termsOfReference'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('terms_of_reference.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $heading = $request->input('heading');
        $body = $request->input('body');
        $footer = $request->input('footer');

        TermsOfReference::create([
            'heading' => $heading,
            'body' => $body
        ]);

        return redirect()->route('terms_of_reference.index')->with('success', 'Terms Of Reference created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TermsOfReference  $termsOfReference
     * @return \Illuminate\Http\Response
     */
    public function show(TermsOfReference $termsOfReference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TermsOfReference  $termsOfReference
     * @return \Illuminate\Http\Response
     */
    public function edit(TermsOfReference $termsOfReference)
    {
        return view('terms_of_reference.edit', compact('termsOfReference'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TermsOfReference  $termsOfReference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TermsOfReference $termsOfReference)
    {
        $heading = $request->input('heading');
        $body = $request->input('body');

        $termsOfReference->update([
            'heading' => $heading,
            'body' => $body
        ]);

        return redirect()->route('terms_of_reference.index')->with('success', 'Terms Of Reference updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TermsOfReference  $termsOfReference
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermsOfReference $termsOfReference)
    {
        //
    }
}
