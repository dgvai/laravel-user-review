<?php
namespace DGvai\Review;

use Config;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded = [];
    protected $fillable = ['review','rating','user_id'];
    protected $table = 'model_reviews';

    public function model()
    {
        return $this->morphTo();
    }

    public function user()
    {
        $userClassName = Config::get('auth.model');
        if (is_null($userClassName)) 
        {
            $userClassName = Config::get('auth.providers.users.model');
        }

        return $this->belongsTo($userClassName);
    }

    public function scopeActive($query)
    {
        return $query->where('active',1);
    }

    public function scopeInactive($query)
    {
        return $query->where('active',0);
    }

    public function reply($reply)
    {
        $this->reply = $reply;
        return $this->save();
    }

    public function makeActive()
    {
        $this->active = true;
        return $this->save();
    }

    public function makeInactive()
    {
        $this->active = true;
        return $this->save();
    }
}