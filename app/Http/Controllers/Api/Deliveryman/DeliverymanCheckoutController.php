<?php

namespace CodeDelivery\Http\Controllers\Api\Deliveryman;

use CodeDelivery\Http\Controllers\Controller;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\OrderService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class DeliverymanCheckoutController extends Controller
{

    private $with = [
        'client', 'cupom', 'items'
    ];

    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        OrderService $orderService
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
    }

    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        return $this->orderRepository->skipPresenter(false)->with($this->with)->scopeQuery(function ($query) use ($id) {
            return $query->where('user_deliveryman_id', '=', $id);
        })->paginate();
    }

    public function show($id)
    {
        return $this->orderRepository->skipPresenter(false)->with($this->with)->getByDeliveryman($id, Authorizer::getResourceOwnerId());
    }

    public function updateStatus(Request $request, $id)
    {
        $order = $this->orderService->updateStatus($id, Authorizer::getResourceOwnerId(), $request->get('status'));
        if (!$order) {
            abort(400, 'Order não encontrado');
        }
        return $order->find($id);
    }

}
