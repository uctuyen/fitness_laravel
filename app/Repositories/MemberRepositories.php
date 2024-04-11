<?php

namespace App\Repositories;

use App\Models\Member;
use App\Repositories\Interfaces\MemberRepositoriesInterface;
use App\Repositories\BaseRepositories;
/**
 * Class MemberService
 * @package App\Services
 */
class MemberRepositories extends BaseRepositories implements MemberRepositoriesInterface
{
    protected $model;
    public function __construct(
        Member $model  
    ){
        $this->model = $model;
    }
   
    
}
