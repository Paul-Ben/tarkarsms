@extends('layouts.admin.dashboard')
@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('classroom.update', $classroom) }}" method="POST" enctype="multipart/form-data" class="max-w-full mx-auto">
                        @csrf
                        @method('PUT')
                        <!-- Student Data -->
                        <h2 class="text-lg font-bold mb-5">Class Data</h2>
                        <div class="grid grid-cols-3 gap-6">
                            <div class="mb-5">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class Name</label>
                                <input type="text" name="name" value="{{$classroom->name}}" id="name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="First Name" required />
                            </div>
                            <div class="mb-5">
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <select name="category" id="category" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light">
                                    <option value="{{$classroom->category}}">{{$classroom->category}}</option>
                                    <option value="kindergarten">Kindergarten</option>
                                    <option value="primary">Primary</option>
                                    <option value="js">Junior Secondary</option>
                                    <option value="ss">Senior Secondary</option>
                                </select>
                            </div>
                            <div class="mb-5">
                                <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teacher Name</label>
                                <input type="text" name="teacher_name" value="{{$classroom->teacher_name}}" id="last_name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Last Name" required />
                            </div>
                        </div>
                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update Class</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
