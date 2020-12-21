<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\UserChart;
use App\User;
class ChartController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $user        = User::first();
        $userTwo     = User::find(2);

        $chart = LarapexChart::setTitle('Your Todos Stats')
            ->setLabels(['Done', 'Not Yet'])
            ->setDataset([$todosDone, $todosNotYet]);


        return view('index', compact('chart'));
    }
    public function getDash(Request $req){
	 	 $month = date('m');
        //thống kê số tài khoản user và tài khoản sô tài khoản trong tháng
         $user = new UserChart;
         $user_month =User::whereMonth('created_at','=',$month)->count();
         $user_total=User::count();
         $user->labels(['Số User trong tháng '.$month,'Tổng số User','Tổng số Imployee','Tổng số Admin']);
         $user->dataset('Thống kê tổng số User trong hệ thống','bar',[$user_month,$user_total])
         		->color(['#f0ad4e','#5cb85c'])
        		->backgroundcolor(['#e2b77a','#90ce90']);
         			
        // //thống kê số người đăng kí tổng và số người đăng kí trong tháng
        // $chart_sub = new SubcriberChart;
        // $sub_month = Subcriber::whereMonth('created_at',$month)->count();
        // $sub_total = Subcriber::count();
        // $chart_sub->labels(['Số người đăng kí trong tháng','Tổng số đăng kí ']);
        // $chart_sub->dataset('Thống kê khách hàng đăng kí email nhận thông tin','pie',[$sub_month,$sub_total])
        // 		->color(['#337AB7','#D9534F'])
        // 		->backgroundcolor(['#77abd6','#db8583']);
                
    return view ('admin.dashboard',['user'=>$user);
   }
}
