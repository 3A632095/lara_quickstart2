<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * 這些屬性能被批量賦值。
     *
     * @var array
     */
    protected $fillable = ['name'];
    /**
     * 取得該使用者的所有任務。
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
