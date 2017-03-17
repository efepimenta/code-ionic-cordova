<?php

namespace CodeDelivery\Http\Controllers\Api\Client;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Http\Requests\AdminCategoryRequest;
use CodeDelivery\Repositories\CategoryRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClientCheckoutController extends Controller
{

    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        OrderService $orderService
    )
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
        $this->productRepository = $productRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $clientId = $this->userRepository->find(Authorizer::getResourceOwnerId())->client->id;
        $orders = $this->orderRepository->with(['items'])->scopeQuery(function ($query) use ($clientId) {
            return $query->where('client_id', '=', $clientId);
        })->paginate();
        return $orders;
    }

    public function show($id)
    {
        return $this->orderRepository->with(['client', 'items.product', 'cupom', 'deliveryman'])
            ->findWhere(['client_id' => Authorizer::getResourceOwnerId(), 'id' => $id]);
//        $o = $this->repository->with(['client', 'items', 'cupom'])->find($id);
//        return $o->items->each(function ($item) {
//            $item->product;
//        });
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['client_id'] = $this->userRepository->find(Authorizer::getResourceOwnerId())->client->id;
        $o = $this->orderService->create($data);
        return $this->orderRepository->with(['items'])->find($o->id);
    }

}
