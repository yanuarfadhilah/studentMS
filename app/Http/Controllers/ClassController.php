<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClassServiceContract as ClassService;

class ClassController extends Controller
{
    protected $classService;
    public function __construct(ClassService $classService)
    {
        $this->classService = $classService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('class.index', $this->classService->getDataIndex());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:classes,name'
        ]);

        return response()->json(['success' => $this->classService->createOrUpdateClass($request->all())]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->json(['data' => $this->classService->getClassById($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:classes,name,'.$request->id,
            'id'    => 'required'
        ]);

        return response()->json(['success' => $this->classService->createOrUpdateClass($request->all(), true)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json(['success' => $this->classService->deleteClass($id)]);
    }

    public function classList(Request $request){
        return response()->json($this->classService->getClassList($request->all()));
    }
}
