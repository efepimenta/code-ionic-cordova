<?php

namespace CodeDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Models\Product;
use CodeDelivery\Validators\ProductValidator;

/**
 * Class ProductRepositoryEloquent
 * @package namespace CodeDelivery\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getList()
    {
        return $this->model->get(['id', 'name','description', 'price']);
    }

    public function presenter()
    {
        return \CodeDelivery\Presenters\ProductPresenter::class;
    }

}
