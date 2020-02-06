<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Task extends Model
{
    use RecordsActivity;
    protected $guarded = [];

    protected $touches = ['project'];

    protected $casts = [
        'completed' => 'boolean'
    ];

    protected static $recordableEvents = ['created', 'deleted'];


//    protected static function boot()
//    {
//        parent::boot();
//        //ini buat belajaran aja. sebetulnya bisa aja dibuat observer sendiri utk task
//        static::created(function ($task){
//
//            $task->project->recordActivity('created_task');
//        });
//
//        static::deleted(function ($task){
//
//            $task->project->recordActivity('deleted_task');
//        });
//
//    }

    public function complete()
    {
        $this->update(['completed' => true]);

        $this->recordActivity('completed_task');

    }

    public function incomplete()
    {
        $this->update(['completed' => false]);
        $this->recordActivity('incompleted_task');

    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Project()
    {
        return $this->belongsTo(Project::class);
    }

    public function path()
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

//    /**
//     * record activity on project
//     * @param string $description
//     */
//    public function recordActivity($description)
//    {
//        $this->activity()->create([
//            'project_id' => $this->project_id,
//            'description' => $description,
//        ]);
//    }




}
