<?php

namespace App\Services;

use App\Models\Students;
use App\Models\Classes;

class StudentService implements StudentServiceContract
{
    public function getDataIndex()
    {
        return (['studentDatas' => Students::all(), 'classDatas' => Classes::all(), 'levels' => range(1, 6)]);
    }

    public function deleteStudent($id = 0)
    {
        $student = Students::find($id);
        if ($student) {
            $student->delete();
            return true;
        } else {
            return false;
        }
    }

    public function getStudentList($input = array())
    {
        $keywordText = data_get($input, 'keyword');
        return [
            'data' => Students::when(!empty($keywordText), function ($query) use ($keywordText) {
                    $query->where('name', 'like', '%' . $keywordText . '%');
                })->with('classes')->get()
            ];
    }

    public function getStudentById($id = 0)
    {
        return Students::find($id);
    }

    public function createOrUpdateStudent($input = array(), $isUpdate = false)
    {
        $response = false;
        if ($isUpdate) {
            $student = Students::find($input['id']);
            if ($student) {
                $student->name = $input['name'];
                $student->class_id = $input['class_id'];
                $student->level = $input['level'];
                $student->parent_phone_number = $input['parent_phone_number'];
                $student->save();
                $response = true;
            }
        } else {
            $student = new Students();
            $student->name = $input['name'];
            $student->class_id = $input['class_id'];
            $student->level = $input['level'];
            $student->parent_phone_number = $input['parent_phone_number'];
            $student->save();
            $response = true;
        }

        return $response;
    }
}
