@extends('layout.master')

@push('page-js')
    <script>
        const DELETE_STUDENT_URL = "{{ route('student.destroy', ['id' => '_id']) }}";
        const EDIT_STUDENT_URL = "{{ route('student.edit', ['id' => '_id']) }}";
        const UPDATE_STUDENT_URL = "{{ route('student.update') }}";
        const SEARCH_STUDENT_URL = "{{ route('student.list') }}";
        const ADD_STUDENT_URL = "{{ route('student.store') }}";
        const IMPORT_STUDENT_URL = "{{route('student.import')}}";
        const CSRF_TOKEN = '{{ csrf_token() }}';
    </script>
    @vite(['resources/js/student.js'])
@endpush


@section('page_title')
    Student
@endsection

@section('content')
    <nav class="flex px-5 py-3 text-gray-700 border rounded-lg mt-12" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    <i class="fas fa-home"> </i> &nbsp; Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right"> </i>
                    <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Student</a>
                </div>
            </li>
        </ol>
    </nav>
    <div class="sm:w-full w-screen mt-8 px-6">
        <div class="w-full rounded-lg p-4 mb-6 shadow-xl border-black border-2 bg-red-500 text-white">
            <div class="flex flex-row w-full justify-between">
                <button type="button"
                    class="text-blue-500 border-4 bg-white border-blue-500 hover:bg-gray-500 hover:text-white hover:border-2 hover:border-white font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 add-button">
                    <i class="fas fa-person-circle-plus"> </i> Add Student </button>
                <h3 class="font-semibold sm:text-2xl text-xl"> List Student </h3>
                <button type="button"
                    class="text-green-500 bg-white border-green-500 border-4 hover:bg-gray-500 hover:text-white hover:border-2 hover:border-white font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                    data-modal-target="modalImport" data-modal-toggle="modalImport">
                    <i class="fas fa-file-import"> </i> Import Student </button>
            </div>
        </div>
        <div
            class="w-full sm:h-[60vh] h-screen sm:max-h-[60vh] overflow-scroll rounded-lg bg-red-500 p-6 text-white shadow-xl border-black border-2">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="pb-4">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fa fa-search text-gray-500"> </i>
                        </div>
                        <input type="text" id="table-search"
                            class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search student by name">
                    </div>
                </div>
                <button type="button" data-modal-target="modalStudent" data-modal-toggle="modalStudent"
                    id="triggerEditModal" class="hidden"> </button>
                <table class="w-full overflow-scroll text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="p-4">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Level
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Class
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Phone Number
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="student_search_body">
                        @foreach ($studentDatas as $studentData)
                            <tr class="bg-white hover:bg-gray-200">
                                <td class="w-4 p-4">
                                    {{ $loop->index + 1 }}
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $studentData->name }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $studentData->level }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ optional($studentData->classes)->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $studentData->parent_phone_number }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-start">
                                        <button type="button"
                                            class="bg-yellow-300 px-2 py-1 rounded-lg text-white hover:bg-white hover:text-black mr-2 edit-button"
                                            data-id="{{ $studentData->id }}">
                                            <i class="fas fa-pen"> </i>
                                        </button>

                                        <button type="button"
                                            class="bg-red-500 px-2 py-1 rounded-lg text-white hover:bg-white hover:text-black delete-button"
                                            data-id="{{ $studentData->id }}">
                                            <i class="fas fa-trash-can"> </i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <!-- modalStudent -->
    <div id="modalStudent" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center closeModal"
                    data-modal-hide="modalStudent">
                    <i class="fas fa-times"> </i>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 head_text"></h3>
                    <form class="space-y-6" action="#" id="formStudent">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                placeholder="Name of student" required>
                        </div>
                        <div>
                            <label for="level" class="block mb-2 text-sm font-medium text-gray-900">Level</label>
                            <select id="level" name="level"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 ">
                                <option selected>Choose a level</option>
                                @foreach ($levels as $level)
                                    <option value="{{ $level }}"> {{ $level }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="class_id" class="block mb-2 text-sm font-medium text-gray-900">Class</label>
                            <select id="class_id" name="class_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 ">
                                <option selected>Choose a class</option>
                                @foreach ($classDatas as $classData)
                                    <option value="{{ $classData->id }}"> {{ $classData->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="parent_phone_number" class="block mb-2 text-sm font-medium text-gray-900">Parent
                                Phone Number </label>
                            <input type="text" name="parent_phone_number" id="parent_phone_number" placeholder="+62"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5">
                        </div>
                        <input type="hidden" id="id_student" name="id" value="">
                        <input type="hidden" id="typeProcess" value="">

                        <button type="button"
                            class="w-full text-white bg-green-500 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center button_text save_button"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="modalImport" tabindex="-1"
        class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-hide="modalImport">
                    <i class="fas fa-times"> </i>
                </button>
                <div class="p-6 text-center">
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Import Student Data</h3>
                    <div class="px-2 mb-2">
                        <form method="POST" enctype="multipart/form-data" id="importForm">
                            @csrf
                            @method('POST')
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none"
                                id="file_input" type="file" name="imported_file">
                        </form>
                    </div>
                    <div>
                        <a href ="{{route('student.export_format')}}"
                            class="text-white bg-green-400 hover:bg-black  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Download Format
                        </a>
                        <button data-modal-hide="modalImport" type="button"
                            class="text-white bg-sky-600 hover:bg-purple-400 hover:text-black  font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2 upload_import">
                            Upload
                        </button>
                        <button data-modal-hide="modalImport" type="button"
                            class="text-white bg-red-600 hover:bg-gray-400 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No,
                            cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
