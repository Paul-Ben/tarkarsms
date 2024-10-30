@extends('layouts.admin.dashboard')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session()->has('success'))
                        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                            role="alert">
                            <span class="font-medium">Info alert!!</span> {{ session('success') }}
                        </div>
                    @endif
                    <div>
                        <h2 class="text-lg font-bold mb-4">Student Information</h2>
                        {{-- {{$students->count()}}
                        {{$classrooms->count()}} --}}
                        <div class="text-right ">
                            <a href="{{ route('student.create') }}">
                                <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                    <strong>+</strong> Add Student
                                </button>
                            </a>
                        </div>

                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        S/No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Reg. Number
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Class
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $key => $student)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        {{$key + 1}}
                                    </td>
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{$student->std_number}}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{$student->first_name." ".$student->middle_name." ".$student->last_name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{$student->classroom->name}}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('student.destroy', $student) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('student.show', $student) }}"
                                                class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                View
                                            </a>
                                            <a href="{{ route('student.edit', $student) }}"
                                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                                Edit
                                            </a>
                                            <button type="submit"
                                            onclick="return confirm('Do you accept the decision to delete this record?');"
                                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-600">
                                        No student found
                                        </td>
                                        </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $students->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
