<?php

namespace CodeDelivery\Providers;

use CodeDelivery\Repositories\CategoryRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $model = [
            'Category',
            'Product',
            'Client',
            'User',
            'Order',
            'Cupom',
        ];
        foreach ($model as $value){
            $this->app->bind(
                "CodeDelivery\\Repositories\\{$value}Repository",
                "CodeDelivery\\Repositories\\{$value}RepositoryEloquent"
            );
        }
    }
}
