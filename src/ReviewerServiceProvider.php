<?php
namespace DGvai\Review;

use Illuminate\Support\ServiceProvider;

class ReviewerServiceProvider extends ServiceProvider
{
    public function register()
    {
        
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ .'/../migrations/create_review_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_review_table.php'),
        ], 'migrations');
    }
}