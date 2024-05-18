<?php

namespace App\Services\Interfaces;

/**
 * Interface EmployeeServiceInterface
 */
interface EmployeeServiceInterface
{
    public function getAllPaginate(Request $request);
}
