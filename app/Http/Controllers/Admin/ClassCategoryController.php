<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassCategory;
use Illuminate\Http\Request;

class ClassCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classCategories = ClassCategory::all();
        return view('admin.classcategory.index', compact('classCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.classcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'abbreviation' => 'required'
        ]);
        ClassCategory::create($validated);
        return redirect()->route('class-category.index')->with('success', 'Class Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassCategory $classCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassCategory $classCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassCategory $classCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassCategory $classCategory)
    {
        //
    }
}
