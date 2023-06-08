<?php

namespace App\Imports;

use App\Models\Classes;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Students;
use Illuminate\Support\Facades\Redis;

class StudentImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    protected $classes;
    protected $students;
    protected $studentsCreate;
    protected $redis;

    public function __construct()
    {
        $this->classes = Classes::all()->pluck('id', 'name')->toArray();
        $this->students = Students::all();
        $this->studentsCreate = collect([]);
        $this->redis = Redis::connection();
    }

    public function model(array $row)
    {
        if (isset($this->classes[$row[1]])) {
            $name = $row[0];
            $class = $this->classes[$row[1]];
            $level = $row[2];
            $parentPhone = $row[3];

            $isRedisExists = $this->redis->get($name.'_'.$class.'_'.$level.'_'.$parentPhone);
            if (!$isRedisExists) {
                $existStudent = $this->students->where('name',$name)
                ->where('class_id',$class)
                ->where('level',$level)
                ->where('parent_phone_number',$parentPhone)
                ->first();

                if (!$existStudent) {
                    $this->redis->set($name.'_'.$class.'_'.$level.'_'.$parentPhone, 'exist');
                    return new Students([
                        'name' => $name,
                        'class_id' => $class,
                        'level' => $level,
                        'parent_phone_number' => $parentPhone,
                        'created_at' => now(),
                    ]);
                }
            }
        }
    }

    public function batchSize(): int
    {
        return 50;
    }

    public function chunkSize(): int
    {
        return 50;
    }
}
