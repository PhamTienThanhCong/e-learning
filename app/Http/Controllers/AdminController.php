<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\course;
use App\Models\lesson;
use App\Models\order;
use App\Models\question;
use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function overview(){
        $course = course::query()
                ->select(DB::raw('COUNT(orders.id) as number_order'), DB::raw('SUM(orders.price_buy) as total_price'))
                ->leftJoin('orders' , 'courses.id', '=', 'orders.courses_id')
                ->first();
        $user = user::query()
                ->select(DB::raw('COUNT(*) as total_user'))
                ->first();
        $top_admin = admin::query()
                ->select('admins.id', 'admins.name', 'admins.email','admins.image', 'admins.created_at', DB::raw('COUNT(orders.id) as number_order'), DB::raw('SUM(orders.price_buy) as total_price'), DB::raw('AVG(orders.rate) as number_rate'))
                ->leftJoin('courses' , 'admins.id', '=', 'courses.id_admin')
                ->leftJoin('orders' , 'courses.id', '=', 'orders.courses_id')
                ->where('admins.lever', '=', '1')
                ->groupBy('admins.id')
                ->orderBy('total_price', 'DESC')
                ->limit(10)
                ->get();       
        return view('content.admin.overView',[
            'course'        => $course,
            'number_user'   => $user->total_user,
            'top_admin'     => $top_admin,
        ]);
    }
    public function managerSeller(Request $request){
        $s = $request->get('search');
        
        $admin = DB::table('admins')
            ->leftJoin('courses' , 'admins.id', '=', 'courses.id_admin')
            ->select('admins.id','admins.name','admins.image','admins.email','admins.lever','admins.created_at', DB::raw('COUNT(admins.id) as number'))
            ->where('admins.name', 'like', "%".$s."%")
            ->groupBy('admins.id')
            ->paginate(10);

        $admin->appends([
           'search' => $s,
        ]);
        
        return view('content.admin.managerSeller',[
            'data' => $admin,
            'search' => $s,
        ]);
    }
    public function managerUser(Request $request){
        $search = $request->get('search');

        $user = DB::table('users')
            ->select('users.id','users.name','users.email','users.image','users.created_at',DB::raw('COUNT(orders.id) as number_order'))
            ->leftJoin('orders', 'users.id', 'orders.users_id')
            ->where('users.name', 'like', "%".$search."%")
            ->groupBy('users.id')
            ->paginate(10);

        $user->appends([
           'search' => $search,
        ]);
        return view('content.admin.managerUser',[
            'data' => $user,
            'search' => $search,
        ]);
    }
    public function viewSeller($seller){
        $admin =  admin::query()
                ->select('admins.*',DB::raw('COUNT(courses.id) as number_courses'))
                ->leftJoin('courses' , 'admins.id', '=', 'courses.id_admin')
                ->where('admins.id', '=', $seller)
                ->groupBy('admins.id')
                ->firstOrFail();
        $course = course::query()
                ->select(DB::raw('COUNT(orders.id) as number_order'), DB::raw('AVG(orders.rate) as number_rate'), DB::raw('SUM(orders.price_buy) as total_price'))
                ->leftJoin('orders' , 'courses.id', '=', 'orders.courses_id')
                ->where('courses.id_admin', '=', $seller)
                ->first();
        return view('content.admin.ViewSeller',[
            'admin'     => $admin,
            'course'    => $course,
        ]);
    }
    public function mamagerCourses(Request $request, $name_admin = ""){

        $part[2]['name'] = $name_admin;

        $s = $request->get('search');
        $t = $request->get('check');

        if ($t == ""){ $t = "3"; }

        $Show = ["1","2"];
        
        if ($t != "3"){ $Show = [$t]; }
        
        $course = course::query()
            ->select('courses.*','admins.name as name_admin', DB::raw('COUNT(orders.id) as number_buy'))
            ->join('admins', 'courses.id_admin', '=', 'admins.id')
            ->leftJoin('orders', 'courses.id', '=', 'orders.courses_id')
            ->where('courses.name', 'like', "%".$s."%")
            ->whereIn('courses.type', $Show)
            ->groupBy('courses.id')
            ->paginate(10);
        $course->appends([
            'search' => $s,
            'check' => $t,
        ]);
        return view('content.admin.managerCourse',[
            'data' => $course,
            'type' => $t,
            'search' => $s,
        ]);
    }
    public function mamagerDetailCourses($name_admin,$course){
        $part[2]['name'] = $name_admin;

        $my_course = course::find($course);
        $my_lesson = lesson::query()
            ->select('lessons.*')
            ->Where('courses_id', '=', $course)
            ->groupBy('lessons.id')
            ->get();
        $my_rate = order::query()
            ->select('orders.rate', 'orders.comment', 'orders.created_at', 'users.name')
            ->join('users','orders.users_id','=', 'users.id')
            ->where('orders.courses_id', '=', $course)
            ->where('orders.rate', '!=', 'null')
            ->get();
        $total_rate = 0;
        for ($i = 0; $i < count($my_rate); $i++) {
            $total_rate += $my_rate[$i]->rate;
        }
        $total_rate = $total_rate/count($my_rate);
        return view('content.admin.detailCourse', [
            'name_admin'    => $name_admin,
            'course'        => $course,
            'data'          => $my_course,
            'lesson'        => $my_lesson,
            'rates'          => $my_rate,
            'total_rate'    => $total_rate,
        ]);
    }
    public function viewLesson($name_admin,$course,$lesson){
        $my_course = course::query()
                ->select('*')
                ->Where('id', '=', $course)
                ->first();
        $my_lesson = lesson::query()
                ->select('*')
                ->where('id', '=', $lesson)
                ->where('courses_id', '=', $course)
                ->first();

        return view('content.seller.viewLesson', [
            'my_course' => $my_course,
            'my_lesson' => $my_lesson,
        ]);
    }
}
