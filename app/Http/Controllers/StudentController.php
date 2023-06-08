<?php

namespace App\Http\Controllers;

use App\Exports\MasterData;
use Illuminate\Http\Request;
use App\Services\StudentServiceContract as StudentService;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentImport;

class StudentController extends Controller
{
    protected $studentService;
    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('student.index', $this->studentService->getDataIndex());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'level' => 'required',
            'class_id' => 'required',
            'parent_phone_number' => 'required|numeric'
        ]);

        return response()->json(['success' => $this->studentService->createOrUpdateStudent($request->all())]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->json(['data' => $this->studentService->getStudentById($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'level' => 'required',
            'class_id' => 'required',
            'parent_phone_number' => 'required|numeric',
            'id'    => 'required'
        ]);

        return response()->json(['success' => $this->studentService->createOrUpdateStudent($request->all(), true)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json(['success' => $this->studentService->deleteStudent($id)]);
    }

    public function studentList(Request $request){
        return response()->json($this->studentService->getStudentList($request->all()));
    }

    public function getExportFormat(){
        return Excel::download(new MasterData, 'students.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function importData(Request $request){
        $request->validate([
            'imported_file' => 'required|mimes:xlsx'
        ]);

        if (!request()->hasFile('imported_file')) {
            return response()->json(['success' => false]);
        } else {
            return response()->json(['success' => Excel::import(new StudentImport, request()->file('imported_file'))]);
        }
    }
}
