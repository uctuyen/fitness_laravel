<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\DistrictRepositoriesInterface as DistrictRepositories;
use App\Repositories\Interfaces\ProvinceRepositoriesInterface as ProvinceRepositories;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $districtRepositories;

    protected $provinceRepositories;

    public function __construct(
        DistrictRepositories $districtRepositories,
        ProvinceRepositories $provinceRepositories)
    {
        $this->districtRepositories = $districtRepositories;
        $this->provinceRepositories = $provinceRepositories;
    }

    public function getLocation(Request $request)
    {
        $get = $request->input();

        $html = '';
        if ($get['target'] == 'districts') {
            $province = $this->provinceRepositories->findById($get['data']['location_id'],
                ['code', 'name'], ['districts']);
            $html = $this->renderHtml($province->districts);

        } elseif ($get['target'] == 'wards') {
            $district = $this->districtRepositories->findById($get['data']['location_id'],
                ['code', 'name'], ['wards']);

            $html = $this->renderHtml($district->wards, '[Chọn Phường/Xã]');
        }

        $response = [
            'html' => $html,
        ];

        return response()->json($response);
    }

    public function renderHtml($districts, $root = '[Chọn Quận/Huyện]')
    {
        $html = '<option value="0">'.$root.'</option>';
        foreach ($districts as $district) {
            $html .= '<option value="'.$district->code.'">'.$district->name.'</option>';
        }

        return $html;
    }
}
