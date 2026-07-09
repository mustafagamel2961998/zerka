<?php

namespace App\Actions\Front\V1\Checkout;
use App\Repositories\Contracts\Checkout\CheckoutRepositoryInterface;
use App\DTOs\Front\V1\Checkout\CreateDTO;
use App\Repositories\Contracts\Address\AddressRepositoryInterface;
use App\Repositories\Contracts\Cart\CartRepositoryInterface;
use Illuminate\Validation\ValidationException;
use App\Services\Order\ActivitService;

class CreateAction
{
    public function __construct(
        private CheckoutRepositoryInterface $checkout_repository_interface,
        private AddressRepositoryInterface $address_repository_interface,
        private CartRepositoryInterface $cart_repository_interface
    ){}

    public function execute(CreateDTO $dto)
    {
        
        $getCart =  $this->cart_repository_interface->findUserCart(auth()->user());
        if (!$getCart || $getCart->items->isEmpty()) {
            throw ValidationException::withMessages([
                    'error' => [__('front.cart_is_empty')], 
            ]);

        }
        $data = $dto->toArray();
        $data['user_id'] = auth()->user()->id;
        $data['subtotal'] = $getCart->subtotal;
        $tax = ($getCart->subtotal * config('app_settings.tax_percentage')) / 100;
        $data['tax_total'] = $tax;
        $data['discount_total'] = $getCart->discount_total;
        $data['shipping_total'] = config('app_settings.shipping_amount');  
        $data['grand_total'] = ($getCart->subtotal + $tax + config('app_settings.shipping_amount')) - $getCart->discount_total;
        $data['created_at'] = config('app_settings.timezone');
        $data['updated_at'] = config('app_settings.timezone');
        //--------------------------------------------------------------------------------------------------
        $data['items'] = $getCart->items;
        //--------------------------------------------------------------------------------------------------
        $address = $this->address_repository_interface->findById($data['address_id']);
        $data['shipping_address'] = [
            'name'=>$address->name,
            'country'=>$address->country->translations()->where('locale','ar')->first()->name,
            'city'=>$address->city->translations()->where('locale','ar')->first()->name,
            'phone'=>$address->phone,
            'street_details'=>$address->street_details
        ];
        $checkout = $this->checkout_repository_interface->store($data);
        ActivitService::store($checkout,'انشاء طلب','انشاء طلب جديد',null,'pending');
        return $checkout;
    }
}