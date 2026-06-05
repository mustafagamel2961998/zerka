<?php

namespace App\Repositories\Eloquent\Country;

use App\Models\Country;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
       use App\Enums\Status;

class CountryEloquentRepository implements CountryRepositoryInterface
{
    public function __construct(){}
    
    public function index() : array{
        $countries =  Country::with([
                'currency.translation',
                'cities',
                'translation'
            ])
            ->latest()
            ->paginate(20);
        $counts = Country::selectRaw("
            count(*) as total,
            sum(case when status = '" . Status::ACTIVE->value . "' then 1 else 0 end) as active_count,
            sum(case when status = '" . Status::INACTIVE->value . "' then 1 else 0 end) as inactive_count
        ")->first();

        return [
            'countries'=>$countries,  
            'counts'=>$counts,
        ];
    }

}