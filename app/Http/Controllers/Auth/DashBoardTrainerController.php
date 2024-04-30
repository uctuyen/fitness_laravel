<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashBoardTrainerController extends Controller
{
    public function __construct(){

    }

    public function dashboardTrainer(){

        $config = $this->config();
        $template = 'backendTrainer.dashboard.home.dashboardTrainer';
        return view('backendTrainer.dashboard.layout', compact(
            'template',
            'config'
        ));
    }
    private function config (){
        return [
            'js' => [
                asset("/backend/js/plugins/flot/jquery.flot.js"),
                asset("/backend/js/plugins/flot/jquery.flot.tooltip.min.js"),
                asset("/backend/js/plugins/flot/jquery.flot.spline.js"),
                asset("/backend/js/plugins/flot/jquery.flot.resize.js"),
                asset("/backend/js/plugins/flot/jquery.flot.pie.js"),
                asset("/backend/js/plugins/flot/jquery.flot.symbol.js"),
                asset("/backend/js/plugins/flot/jquery.flot.time.js"),
                asset("/backend/js/plugins/peity/jquery.peity.min.js"),
                asset("/backend/js/demo/peity-demo.js"),
                asset("/backend/js/inspinia.js"),
                asset("/backend/js/plugins/pace/pace.min.js"),
                asset("/backend/js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"),
                asset("/backend/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"),
                asset("/backend/js/plugins/easypiechart/jquery.easypiechart.js"),
                asset("/backend/js/plugins/sparkline/jquery.sparkline.min.js"),
                asset("/backend/js/demo/sparkline-demo.js")
            ]
        ];
    }
}
