<?php

namespace App\Actions\Dashboard\V1\Setting;
use App\Repositories\Contracts\Setting\SettingRepositoryInterface;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use App\DTOs\Dashboard\V1\Setting\UpdateDTO;

class UpdateAction
{
    public function __construct(
        private SettingRepositoryInterface $setting_repository_interface,
        private CountryRepositoryInterface $country_repository_interface
    )
    {
        //
    }

    public function execute(UpdateDTO $data)
    {
        $getCountry = $this->country_repository_interface->findById($data->country_id);
        $data = $data->toArray();
        $data['timezone'] = $getCountry->timezone;
        $setting = $this->setting_repository_interface->update($data);
        return $setting;
    }
}