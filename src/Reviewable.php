<?php 
namespace DGvai\Review;

use DGvai\Review\Review;

trait Reviewable 
{
    public function reviews()
    {
        return $this->morphMany(Review::class,'model');
    }

    public function averageRating($star=null)
    {
        if(!is_null($star))
        {
            $quantity = $this->reviews()->count();
            $total = $this->reviews()->where('active',1)->sum('rating');

            return ($quantity * $star) > 0 ? $total / (($quantity * $star) / 100) : 0;
        }
        else
        {
            return number_format((float)$this->reviews()->where('active',1)->avg('rating'),2);
        }
    }

    public function userRating($user)
    {
        return $this->ratings()->where('active',1)->where('user_id', $user->id)->avg('rating');
    }

    public function makeReview($user, $rating, $review=null)
    {
        return $this->reviews()->create([
            'review' => $review,
            'rating' => $rating,
            'user_id' => $user->id
        ]);
    }

    public function getRatingAttribute()
    {
        return $this->averageRating();
    }

    public function getRatingPercentAttribute()
    {
        return $this->averageRating(5);
    }
}