@extends('layout.master')

@push('page-js')
    <script>
        const DELETE_CLASS_URL = "{{ route('class.destroy', ['id' => '_id']) }}";
        const EDIT_CLASS_URL = "{{ route('class.edit', ['id' => '_id']) }}";
        const UPDATE_CLASS_URL = "{{ route('class.update') }}";
        const SEARCH_CLASS_URL = "{{ route('class.list') }}";
        const ADD_CLASS_URL = "{{ route('class.store') }}";
        const CSRF_TOKEN = '{{ csrf_token() }}';
    </script>
    @vite(['resources/js/class.js'])
@endpush


@section('page_title')
    Class
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
                    <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2">Class</a>
                </div>
            </li>
        </ol>
    </nav>
    <div class="sm:w-full w-screen mt-8 px-6">
        <div class="w-full rounded-lg p-4 mb-6 shadow-xl border-black border-2 bg-green-400 text-white">
            <div class="flex flex-row w-full justify-between">
                <h3 class="font-semibold sm:text-2xl text-xl"> List Class </h3>
                <button type="button"
                    class="text-gray-500 border bg-white border-gray-500 hover:bg-green-500 hover:text-white hover:border-2 hover:border-white font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 add-button">
                    <i class="fas fa-person-circle-plus"> </i> Add Class </button>
            </div>
        </div>
        <div
            class="w-full sm:h-[60vh] h-screen sm:max-h-[60vh] overflow-scroll rounded-lg bg-green-400 p-6 text-white shadow-xl border-black border-2">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="pb-4">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fa fa-search text-gray-500"> </i>
                        </div>
                        <input type="text" id="table-search"
                            class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search class by name">
                    </div>
                </div>
                <button type="button" data-modal-target="modalClass" data-modal-toggle="modalClass" id="triggerEditModal" class="hidden"> </button>
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
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="class_search_body">
                        @foreach ($classDatas as $classData)
                            <tr class="bg-white hover:bg-gray-200">
                                <td class="w-4 p-4">
                                    {{ $loop->index + 1 }}
                                </td>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ $classData->name }}
                                </th>
                                <td class="px-6 py-4">
                                    <div class="flex justify-start">
                                        <button type="button"
                                            class="bg-yellow-300 px-2 py-1 rounded-lg text-white hover:bg-white hover:text-black mr-2 edit-button"
                                            data-id="{{ $classData->id }}">
                                            <i class="fas fa-pen"> </i>
                                        </button>

                                            <button type="button"
                                                class="bg-red-500 px-2 py-1 rounded-lg text-white hover:bg-white hover:text-black delete-button"
                                                data-id="{{ $classData->id }}">
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


    <!-- modalClass -->
    <div id="modalClass" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center closeModal"
                    data-modal-hide="modalClass">
                    <i class="fas fa-times"> </i>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 head_text"></h3>
                    <form class="space-y-6" action="#" id="formClass">
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                placeholder="name@company.com" required>
                        </div>

                        <input type="hidden" id="id_class" name="id" value="">
                        <input type="hidden" id="typeProcess" value="">

                        <button type="button"
                            class="w-full text-white bg-green-500 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center button_text save_button"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    </div>
@endsection
