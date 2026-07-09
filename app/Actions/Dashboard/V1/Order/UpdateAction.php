<?php

namespace App\Actions\Dashboard\V1\Order;
use App\DTOs\Dashboard\V1\Order\UpdateDTO;
use App\Repositories\Contracts\Order\OrderRepositoryInterface;
use App\Services\Order\ActivitService;

class UpdateAction
{

    public function __construct(private OrderRepositoryInterface $order_repository_interface)
    {}
    public function execute(UpdateDTO $data)
    {
        $order = $this->order_repository_interface->update($data->toArray());
        ActivitService::store($order,'تعديل حالة الطلب','تم تغير حالة الطلب',null,$order->status);

    }
}