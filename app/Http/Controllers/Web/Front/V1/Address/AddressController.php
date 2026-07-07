<?php

namespace App\Http\Controllers\Web\Front\V1\Address;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\V1\Address\AddressRequest;
use App\Actions\Front\V1\Address\CreateAction;
use App\Actions\Front\V1\Address\UpdateAction;
use App\DTOs\Front\V1\Address\CreateDTO;
use App\DTOs\Front\V1\Address\UpdateDTO;
use App\Repositories\Contracts\Address\AddressRepositoryInterface;
class AddressController extends Controller
{
    public function __construct(private AddressRepositoryInterface $address_repository_interface){}
    public function store(AddressRequest $request,CreateAction $create_action){
         $dto = CreateDTO::fromRequest($request);
         $create_action->execute($dto);
         return redirect()
                ->route('profile.index')
                ->with('success', __('crud.created'));
    }

    public function update(AddressRequest $request,UpdateAction $update_action){
        $dto = UpdateDTO::fromRequest($request);
        $update_action->execute($dto);
        return redirect()
                ->route('profile.index')
                ->with('success', __('crud.updated'));
    }

    public function destroy($id){
        $this->address_repository_interface->destroy($id);
        return redirect()
                ->route('profile.index')
                ->with('success', __('crud.deleted'));
    }
}
