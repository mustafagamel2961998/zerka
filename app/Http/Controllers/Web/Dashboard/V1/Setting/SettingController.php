<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Setting;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Currency\CurrencyRepositoryInterface;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use App\Http\Requests\Dashboard\V1\Setting\SettingRequest;
use App\Actions\Dashboard\V1\Setting\UpdateAction;
use App\DTOs\Dashboard\V1\Setting\UpdateDTO;
class SettingController extends Controller
{
    public function __construct(
        private CurrencyRepositoryInterface $currency_repository_interface,
        private CountryRepositoryInterface $country_repository_interface
    ){}
    public function index(){
        $currencies = $this->currency_repository_interface->index();
        $countries = $this->country_repository_interface->all();
        $setting = config('app_settings');
        return view('dashboard.setting.edit',compact('currencies','countries','setting'));
    }

    public function update(SettingRequest $request,$id,UpdateAction $update_action){
        $dto = UpdateDTO::fromRequest($request);
        $update_action->execute($dto);
        return redirect()->route('dashboard.v1.settings.index')->with('success', __('crud.updated'));
    }
}
