<?php

namespace CodeDelivery\Transformers;

use League\Fractal\TransformerAbstract;
use CodeDelivery\Models\Order;

/**
 * Class OrderTransformer
 * @package namespace CodeDelivery\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{

    protected $availableIncludes = [
        'cupom', 'items', 'client', 'deliveryman'
    ];

    /**
     * Transform the \Order entity
     * @param \Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'total' => (float)$model->total,
            'status' => (int)$model->status,
            'qtd_items' => count($model->items),
            'created_at' => $model->created_at,
        ];
    }

    protected function includeCupom(Order $model)
    {
        if (!$model->cupom) {
            return null;
        }
        return $this->item($model->cupom, new CupomTransformer());
    }

    protected function includeItems(Order $model)
    {
        if (!$model->items) {
            return null;
        }
        return $this->collection($model->items, new OrderItemTransformer());
    }

    protected function includeClient(Order $model)
    {
        if (!$model->client) {
            return null;
        }
        return $this->item($model->client, new ClientTransformer());
    }

    protected function includeDeliveryman(Order $model)
    {
        if (!$model->deliveryman) {
            return null;
        }
        return $this->item($model->deliveryman, new DeliverymanTransformer());
    }
}
