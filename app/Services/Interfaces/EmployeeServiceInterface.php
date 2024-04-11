<?php

namespace App\Services\Interfaces;
/**
 * Interface EmployeeServiceInterface
 * @package App\Services\Interfaces
 */
interface EmployeeServiceInterface
{
    public function getAllPaginate(Request $request);
}
