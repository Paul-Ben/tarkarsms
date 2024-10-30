<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('classroom')->paginate(20);
        return view('admin.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::all();
        if ($classrooms->isEmpty()) {
            return redirect()->route('classroom.index')->with('success', "Please add a Classroom");
        }
        return view('admin.student.create', compact('classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'std_number' => 'required',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'date_of_birth' => 'required|date',
            'image' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nationality' => 'string|max:80',
            'stateoforigin' => 'string|max:50',
            'lga' => 'string|max:50',
            'genotype' => 'string|max:10',
            'bgroup' => 'string|max:10',
            'guardian_name' => 'required|string|max:50',
            'guardian_phone' => 'required|string|max:20',
            'guardian_email' => 'nullable|email',
            'address' => 'nullable|string|max:500',
            'class_id' => 'required', 
        ]);
        // dd($request->all());
        $input_data = $request->all();

         // Handle the image upload
         if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time(). '_'. $file->getClientOriginalName();
            $filePath = $file->storeAs('images/passport', $fileName, 'public');
            $input_data['image'] = $filePath;

        }else {
            $filePath = null;
            $input_data['image'] = $filePath;
        }

        Student::create($input_data);

        return redirect()->route('student.index')->with('success', 'Student registered successfully!');

    }


    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return view('admin.student.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $classrooms = Classroom::all();
        return view('admin.student.edit', compact('student', 'classrooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'date_of_birth' => 'required|date',
            'image' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nationality' => 'nullable|string|max:80',
            'stateoforigin' => 'nullable|string|max:80',
            'lga' => 'nullable|string|max:80',
            'genotype' => 'nullable|string|max:10',
            'bgroup' => 'nullable|string|max:10',
            'guardian_name' => 'required|string|max:255',
            'guardian_phone' => 'required|string|max:20',
            'guardian_email' => 'nullable|email',
            'address' => 'nullable|string|max:500',
            'class_id' => 'required', // Assuming you have a classes table
        ]);
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            // Store the image in the 'public/passports' directory and get the path
            $path = $request->file('image')->store('passports', 'public');
            // Delete the old image if it exists
            if ($student->image) {
                Storage::delete('public/' . $student->image);
            }
        } else {
            $path = $student->image; // Keep the old image
        }
    
        // Update the student record
        $student->update([
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'date_of_birth' => $validatedData['date_of_birth'],
            'image' => $path,
            'nationality' => $validatedData['nationality'],
            'stateoforigin' => $validatedData['stateoforigin'],
            'lga' => $validatedData['lga'],
            'genotype' => $validatedData['genotype'],
            'bgroup' => $validatedData['bgroup'],
            'class_id' => $validatedData['class_id'], 
            'guardian_name' => $validatedData['guardian_name'],
            'guardian_phone' => $validatedData['guardian_phone'],
            'guardian_email' => $validatedData['guardian_email'],
            'address' => $validatedData['address'],
        ]);
    
        return redirect()->route('student.index')->with('success', 'Student updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        if ($student->image) {
            Storage::disk('public')->delete($student->image);
        }
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Student deleted successfully!');
    }

    public function searchpage(Request $request)
    {
        $search = $request->input('search');
        $students = Student::where('std_number', 'like', '%' . $search . '%')
            ->orWhere('first_name', 'like', '%' . $search . '%')
            ->orWhere('middle_name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%')
            ->paginate(10);
           
            return view('admin.student.index', compact('students'));
       
    }
    public function searchclassform()
    {
        $classrooms = Classroom::all();
        return view('admin.student.class_search', compact('classrooms'));
    }
    public function searchclassresult(Request $request)
    {
        $searchquery = $request->input(['search']);
        $classrooms = Classroom::all();
        $students = Student::with('classroom')->where('class_id', $searchquery)->paginate(20);
        return view('admin.student.class_search_result', compact('students', 'classrooms'));
    }
}
