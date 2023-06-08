<?php
namespace App\Services;

interface UserServiceContract
{
    public function getDataIndex();

    public function deleteUser($id = 0);

    public function getUserList($input = array());

    public function getUserById($id = 0);

    public function createOrUpdateUser($input = array(), $isUpdate = false);
}
