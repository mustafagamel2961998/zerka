<?php

namespace App\Http\Controllers\Web\Front\V1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Repositories\Contracts\User\UserRepositoryInterface;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use App\Actions\User\UpdateAction;
use App\DTOs\User\UpdateDTO;
class ProfileController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $user_repository_interface,
        private CountryRepositoryInterface $country_repository_interface
    ){}
    public function index()
    {
        $auth_user = $this->user_repository_interface->findById(auth()->user());
        $countries = $this->country_repository_interface->baseQuery()
                          ->active()
                          ->select('id')
                          ->with('currentTranslation:id,country_id,name')
                          ->latest()
                          ->get();
        return view('front.profile.index',compact('auth_user','countries'));
    }
    public function update(UserRequest $request,UpdateAction $update_action)
    {
        $dto = UpdateDTO::fromRequest($request);
        $update_action->execute($dto);
        return redirect()->route('profile.index')->with('success', __('crud.updated'));
    }
}
