<?php


namespace App;


use Illuminate\Support\Arr;

trait RecordsActivity
{

    /**
     * the project's old attributes
     * @var array
     */
    public $oldAttributes = [];


    /**
     *Boot the trait
     */
    public static function bootRecordsActivity()
    {
        foreach (self::recordableEvents() as $event){
            static::$event(function ($model) use ($event) {

                $model->recordActivity($model->activityDescription($event));
            });

            if ($event === 'updated'){
                /**
                 * Handle the project "updating" event.
                 * @param Project $model
                 */
                static::updating(function ($model) {
                    $model->oldAttributes = $model->getOriginal();
                });
            }
        }
    }

    protected function activityDescription($description)
    {
        return "{$description}_" . strtolower(class_basename($this));
    }

    /**
     * @return array
     */
    protected static function recordableEvents(): array
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        }
        return ['created', 'updated', 'deleted'];

    }


    /**
     * record activity on project
     * @param string $description
     */
    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => class_basename($this) === 'project' ? $this->id : $this->project_id
        ]);
    }

    /**
     * activity feed for the project
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function activity()
    {
        return $this->morphMany(Activity::class,'subject')->latest();
    }


    protected function activityChanges()
    {
        if ($this->wasChanged()){
            return [
                'before' => Arr::except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after' => Arr::except($this->getChanges(), 'updated_at')
            ];
        }
    }
}
