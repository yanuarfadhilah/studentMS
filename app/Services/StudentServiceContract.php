<?php
namespace App\Services;

interface StudentServiceContract
{
    public function getDataIndex();

    public function deleteStudent($id = 0);

    public function getStudentList($input = array());

    public function getStudentById($id = 0);

    public function createOrUpdateStudent($input = array(), $isUpdate = false);
}
