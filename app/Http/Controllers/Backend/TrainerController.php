<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function __construct(){

    }

    public function index(){
        $config = $this ->config();
        $template = 'backend.trainer.index';
        return view('backend.dashboard.layout',compact(
            'template',
            'config'
        ));
    }
    private function config(){
        return [
            'js' => [
                'backend/js/plugins/switchery/switchery.js'
            ],
            'css'=>[
                'backend/css/plugins/switchery/switchery.css'
            ],
        ];
    }
}
