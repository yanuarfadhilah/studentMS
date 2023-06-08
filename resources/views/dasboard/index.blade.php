@extends('layout.master')

@section('page_title') Dashboard @endsection

@section('content')
    <nav class="flex px-5 py-3 text-gray-700 border border-gray-800 rounded-lg bg-gray-50 mt-12" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{route('dashboard')}}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                <i class="fas fa-home"> </i> &nbsp; Home
            </a>
        </li>
    </nav>
    <div class="grid sm:grid-cols-3 grid-cols-1 gap-4 mt-4">
        <a href="{{route('student.index')}}">
            <div class="rounded-lg shadow-2xl shadow-gray-400 bg-red-500 p-8 h-[15vh] cursor-pointer">
                <div class="flex flex-rows justify-between text-2xl text-white">
                    <span> <i class="fa fa-children fa-2x"></i></span>
                    <div class="flex flex-col">
                        <span class="text-right"> {{$studentCount}} </span>
                        <span> Student </span>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{route('class.index')}}">
            <div class="rounded-lg shadow-2xl shadow-gray-400 bg-green-400 p-8 h-[15vh] cursor-pointer">
                <div class="flex flex-rows justify-between text-2xl text-white">
                    <span> <i class="fa fa-school fa-2x"></i></span>
                    <div class="flex flex-col">
                        <span class="text-right"> {{$classCount}} </span>
                        <span> Class </span>
                    </div>
                </div>
            </div>
        </a>

        <a href="{{route('user.index')}}">
            <div class="rounded-lg shadow-2xl shadow-gray-400 bg-gray-500 p-8 h-[15vh] cursor-pointer">
                <div class="flex flex-rows justify-between text-2xl text-white">
                    <span> <i class="fa fa-user fa-2x"></i></span>
                    <div class="flex flex-col">
                        <span class="text-right"> {{$userCount}} </span>
                        <span> User </span>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endsection
