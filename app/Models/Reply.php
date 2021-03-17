<?php

namespace App\Models;

use App\RecordsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory,RecordsActivity;

    protected $fillable = ['body', 'user_id'];
    protected $with = ['user','favorites'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite()
    {
        if (!$this->favorites()->where(['user_id' => auth()->id()])->exists()) {
            return $this->favorites()->create(['user_id' => auth()->id()]);
        }
    }

    public function isFavorited()
    {
      return $this->favorites->contains('user_id',auth()->id());

    }

    public function getFavoritesCountAttribute()
    {
      return $this->favorites->count();

    }

    public function path()
    {
        return $this->thread->path().'#reply-'.$this->id;
    }
}
