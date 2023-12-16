<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestContentRequest;
use App\Http\Requests\UpdateTestContentRequest;
use App\Models\TestContent;

class TestContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content =  TestContent::all();

        return $this->successResponse($content, 'all available content', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestContentRequest $request)
    {
        $content = TestContent::create([
            'title'=> $request->title,
            'description'=> $request->description,
        ]);

        return $this->successResponse($content, 'created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TestContent $testContent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TestContent $testContent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestContentRequest $request, TestContent $testContent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestContent $testContent)
    {
        //
    }
}
