<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setUser(User $user)
    {
        $this->user()->associate($user);
    }
    
    public function getUser()
    {
        return $this->user;
    }

    public function assignedUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'tasks_users',
            'task_id',
            'user_id',
            'id'
        )->withTimestamps();
    }

    public function assignUser(User $user)
    {
        $this->assignedUsers()->attach($user);
    }

    public function assignUsers(array $users)
    {
        foreach ($users as $user) {
            $this->assignedUsers()->attach($user);
        }
    }
}
