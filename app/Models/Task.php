<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $id;
	protected $user_id;
	protected $name;
	protected $is_completed;
	protected $completed_at;
	protected $created_at;
	protected $updated_at;

    protected $fillable = [
        'name',
        'user_id',
        'is_completed',
        'completed_at'
    ];

	public static function listItems()
	{
		$items = static::all();
		return $items;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getTask($task_id)
	{
		return self::find($task_id);
	}

	public function getTasksByUser($user_id)
	{
		// SELECT * FROM tasks WHERE user_id=$user_id
		$tasks = self::where('user_id', $user_id)->get();
	}

	public function isCompleted()
	{
		return $this->is_completed;
	}

	public function markComplete()
	{
		$this->is_completed = true;
		return $this->save();
	}

	public function markIncomplete()
	{
		$this->is_completed = false;
		return $this->save();
	}

	public function getCompletedDate()
	{
		return $this->completed_at;
	}

    public static function saveTask($name)
    {
        $task = static::create([
			'name' => $name
		]);
		return $task;
    }
}