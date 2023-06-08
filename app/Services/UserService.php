<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceContract
{
    public function getDataIndex()
    {
        return (['userDatas' => User::all()]);
    }

    public function deleteUser($id = 0)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return true;
        } else {
            return false;
        }
    }

    public function getUserList($input = array())
    {
        $keywordText = data_get($input, 'keyword');
        return [
            'data' => User::select('id', 'name', 'email')
                ->when(!empty($keywordText), function ($query) use ($keywordText) {
                    $query->where('name', 'like', '%' . $keywordText . '%')
                    ->orWhere('email', 'like', '%' . $keywordText . '%');
                })->get()
            ];
    }

    public function getUserById($id = 0)
    {
        return User::select('id', 'name', 'email')->find($id);
    }

    public function createOrUpdateUser($input = array(), $isUpdate = false)
    {
        $response = false;
        if ($isUpdate) {
            $user = User::find($input['id']);
            if ($user) {
                $user->name = $input['name'];
                $user->email = $input['email'];
                if (!empty($input['password'])) {
                    $user->password = Hash::make($input['password']);
                }
                $user->save();
                $response = true;
            }
        } else {
            $user = new User();
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->password = Hash::make($input['password']);
            $user->save();
            $response = true;
        }

        return $response;
    }
}
