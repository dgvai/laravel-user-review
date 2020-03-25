# Review-Ratings: Laravel Package
[![Latest Stable Version](https://poser.pugx.org/dgvai/laravel-user-review/v/stable)](https://packagist.org/packages/dgvai/laravel-user-review)
[![Total Downloads](https://poser.pugx.org/dgvai/laravel-user-review/downloads)](https://packagist.org/packages/dgvai/laravel-user-review)
[![Latest Unstable Version](https://poser.pugx.org/dgvai/laravel-user-review/v/unstable)](https://packagist.org/packages/dgvai/laravel-user-review)
[![License](https://poser.pugx.org/dgvai/laravel-user-review/license)](https://packagist.org/packages/dgvai/laravel-user-review)

This package uses a trait for a model which can be reviewable by users and give starred/point ratings and only one reply can come from admin as a support response. (like Google playstore review system). This package can be used with any projects like Ecommerce, Shop, Store, etc models. 

> Author: **Jalal Uddin** [Github](https://github.com/dgvai-git) | [Linked-in](https://linkedin.com/in/dgvai) | [Facebook](https://facebook.com/dgvai.hridoy)

## Requirements
<ul>
<li>PHP >= 7.1</li>
<li>Laravel >= 5.6</li>
</ul>

## Installation
> using COMPOSER

`` composer require dgvai/laravel-user-review``

## Configurations
> Export the migration

``php artisan vendor:publish --provider="DGvai\Review\ReviewerServiceProvider" --tag=migrations``

> Run the migration

``php artisan migrate``

## Usage
Add ``Reviewable`` trait to the model where you want users to give review and ratings. As example for **Product Model** 

```php
<?php 
namespace App;

use DGvai\Review\Reviewable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Reviewable;
    ...
    ...
}

?>
```

### Creating review for a product:
> Description

``makeReview(object $user, int $rating [, string $review])``

> Returns

``Object instance of the review``

> Example

```php
$product = Product::find($id);
$user = auth()->user();
$product->makeReview($user,3,'Very good product!');
```

### Review attributes
```php
// Get all active reviews of the product
$product->reviews();

// Get neumetic review count (average)
$product->rating;

// Get percentage review count (average)
$product->rating_percent;

/*
    NOTE: THIS PERCENTAGE IS BASED ON 5 STAR RATING, IF YOU WANT CUSTOM STAR, USE BELLOW
*/
$product->averageRating(10);    //percentage for 10 starrted model

// Get rating given to the product by a user:
$product->userRating($user);

// Get all reviews of all products
$reviews = DGvai\Review\Review::all();              \\ all reviews
$reviews = DGvai\Review\Review::active()->get();    \\ all active reviews
$reviews = DGvai\Review\Review::inactive()->get();  \\ all inactive reviews

// this $review has parameters:

$review = $reviews->first();
$review->model;     /* returns the model object of the traited model, in our case it is product, so $review->model->name with return the 
                        name field of the model.
                    */

// reply a review by admin:
$review->reply('Thanks for being with us!');

// making active/inactive
$review->makeActive();
$review->makeInactive();

```

> Till now that's it! Updates will bring new features soon InshaAllah.