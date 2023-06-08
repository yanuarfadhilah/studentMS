<?php

namespace App\Services;

use App\Models\Classes;

class ClassService implements ClassServiceContract
{
    public function getDataIndex()
    {
        return (['classDatas' => Classes::all()]);
    }

    public function deleteClass($id = 0)
    {
        $classes = Classes::find($id);
        if ($classes) {
            $classes->delete();
            return true;
        } else {
            return false;
        }
    }

    public function getClassList($input = array())
    {
        $keywordText = data_get($input, 'keyword');
        return [
            'data' => Classes::when(!empty($keywordText), function ($query) use ($keywordText) {
                    $query->where('name', 'like', '%' . $keywordText . '%');
                })->get()
            ];
    }

    public function getClassById($id = 0)
    {
        return Classes::find($id);
    }

    public function createOrUpdateClass($input = array(), $isUpdate = false)
    {
        $response = false;
        if ($isUpdate) {
            $classes = Classes::find($input['id']);
            if ($classes) {
                $classes->name = $input['name'];
                $classes->save();
                $response = true;
            }
        } else {
            $classes = new Classes();
            $classes->name = $input['name'];
            $classes->save();
            $response = true;
        }

        return $response;
    }
}
