<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\AdminClientRequest;
use CodeDelivery\Http\Requests\CheckoutRequest;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientProductController extends Controller
{

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->skipPresenter(false)->all();
        return $products;
    }

    public function show($id)
    {
        return $this->productRepository->skipPresenter(false)->with($this->with)->find($id);
    }

    public function store(CheckoutRequest $request)
    {
        $data = $request->all();
        $data['client_id'] = $this->userRepository->find(Authorizer::getResourceOwnerId())->client->id;
        $o = $this->orderService->create($data);
        return $this->orderRepository->skipPresenter(false)->with($this->with)->find($o->id);
    }

}
