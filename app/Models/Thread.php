<?php

namespace App\Models;

use App\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory,RecordsActivity;

    protected $fillable = ['body','user_id','title','channel_id'];
    protected $with = ['user','channel'];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount',function($builder){
            $builder->withCount('replies');
        });

        static::deleting(function($thread){
            $thread->replies->each->delete();
        });

    }



    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }


    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function scopeFilter($query,$filters)
    {
        return $filters->apply($query);
    }
}
