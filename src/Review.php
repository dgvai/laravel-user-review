<?php
namespace DGvai\Review;

use Config;
use Carbon\Carbon;
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

    public function getReviewTextAttribute()
    {
        return (is_null($this->review)) ? 'User gave '.$this->rating.' star!' : $this->review;
    }

    public function scopeActive($query)
    {
        return $query->where('active',1)->orderBy('id','desc');
    }

    public function scopeInactive($query)
    {
        return $query->where('active',0)->orderBy('id','desc');
    }

    public function scopeDaily($query)
    {
        return $query->whereDate('created_at',Carbon::now()->toDateString())->orderBy('id','desc');
    }

    public function scopeMonthly($query)
    {
        return $query->whereMonth('created_at',Carbon::now()->format('m'))->orderBy('id','desc');
    }

    public function scopeYearly($query)
    {
        return $query->whereYear('created_at',Carbon::now()->format('Y'))->orderBy('id','desc');
    }

    public function scopeFilter($query,$start,$end)
    {
        $st = Carbon::parse($start)->startOfDay();
        $en = Carbon::parse($end)->endOfDay();

        return $query->whereBetween('created_at',[$st,$en])->orderBy('id','desc');
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
        $this->active = false;
        return $this->save();
    }

    public function hasReply()
    {
        return is_null($this->reply) ? false : true;
    }
}