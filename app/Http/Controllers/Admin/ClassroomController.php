<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassCategory;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classCategory = ClassCategory::all();
        $classrooms = Classroom::with('classCategory')->paginate(20);
        return view('admin.classroom.index', compact('classrooms', 'classCategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ClassCategory::all();
        return view('admin.classroom.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required',
            'category_id' => 'required'

        ]);
        
        $classroom = $request->all();
        Classroom::create($classroom);
        return redirect()->route('classroom.index')->with('success', 'Classroom created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        return view('admin.classroom.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required'
        ]);

       $classroom->update($request->all());
        return redirect()->route('classroom.index')->with('success', 'Classroom updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return redirect()->route('classroom.index')->with('success', 'Classroom deleted successfully');
        
    }
}
