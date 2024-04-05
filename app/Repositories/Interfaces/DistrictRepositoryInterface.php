<?php
namespace App\Repositories\Interfaces;

interface DistrictRepositoryInterface extends BaseRepositoryInterface
{
    public function all();
    public function findDistrictByProvinceId(int $province_id);
}
