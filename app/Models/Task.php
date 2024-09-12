<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function task_applicants_submit()
    {
        return $this->hasMany(TaskApplicantSubmit::class);
    }

}
