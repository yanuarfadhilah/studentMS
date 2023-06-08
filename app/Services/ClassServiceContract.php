<?php
namespace App\Services;

interface ClassServiceContract
{
    public function getDataIndex();

    public function deleteClass($id = 0);

    public function getClassList($input = array());

    public function getClassById($id = 0);

    public function createOrUpdateClass($input = array(), $isUpdate = false);
}
