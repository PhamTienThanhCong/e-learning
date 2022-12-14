<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\lesson;
use App\Models\question;
use App\Models\result;
use App\Models\answer;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class SellerController extends Controller
{
    public function test(){}
    public function overview(){
        $course = course::query()
                ->select(DB::raw('COUNT(orders.id) as number_order'), DB::raw('SUM(orders.price_buy) as total_price'), DB::raw('AVG(orders.rate) as number_rate'))
                ->leftJoin('orders' , 'courses.id', '=', 'orders.courses_id')
                ->where('id_admin', '=', session()->get('id'))
                ->first();
        return view('content.seller.overView',[
            'course'    => $course,
        ]);
    }

    public function createCourse(){
        return view('content.seller.addCourse',[
        ]);
    }

    public function createCourseProcessing(Request $request){
        $filename = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $filename);
        $course = course::query()
            ->create([
                'id_admin' => Session::get('id'),
                'name'  => $request->get('name'),
                'price'  => $request->get('price'),
                'image'  => $filename,
                'price'  => $request->get('price'),
                'description'  => $request->get('description'),
            ]);
        return redirect()->route('seller.detailCourse', $course->id);
    }
    public function manageCourse(Request $request){
        $s = $request->get('search');
        $t = $request->get('check');

        if ($t == ""){ $t = "3"; }

        $Show = ["1","2"];

        if ($t != "3"){ $Show = [$t]; }

        $course = course::query()
            ->select('courses.*',DB::raw('COUNT(orders.id) as number_buy'))
            ->leftJoin('orders', 'courses.id', '=', 'orders.courses_id')
            ->where('courses.id_admin', '=', session()->get('id'))
            ->where('courses.name', 'like', "%".$s."%")
            ->whereIn('courses.type', $Show)
            ->groupBy('courses.id')
            ->paginate(10);
        $course->appends([
            'search' => $s,
            'check' => $t,
        ]);
        return view('content.seller.managerCourse',[
            'data' => $course,
            'type' => $t,
            'search' => $s,
        ]);
    }

    // Ki???m tra xem kh??a h???c n??y c?? ph???i c???a m??nh kh??ng
    public function getMyCourse($course){
        $my_course = course::query()
            ->select('*')
            ->where('id_admin', '=', Session::get('id'))
            ->Where('id', '=', $course)
            ->first();
        return $my_course;
    }

    // Ki???m tra xem b??i h???c n??y kh??a h???c n??y c?? ph???i c???a m??nh kh??ng
    public function getMyLesson($course_id,$lesson_id){
        $my_lesson = lesson::query()
            ->select('*')
            ->where('id', '=', $lesson_id)
            ->where('courses_id', '=', $course_id)
            ->first();
        return $my_lesson;
    }

    public function detailCourse($course){
        $my_course = $this->getMyCourse($course);
        if (!isset($my_course->name)){
            dd("Ban khong co quyen truy cap");
        }

        // Danh s??ch b??i h???c
        $my_lesson = lesson::query()
            ->select('lessons.*')
            ->Where('courses_id', '=', $course)
            ->groupBy('lessons.id')
            ->get();

        // Danh s??ch c??u h???i
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

        return view('content.seller.detailCourse', [
            'course'    => $course,
            'data'      => $my_course,
            'lesson'    => $my_lesson,
            'rates'     => $my_rate,
            'total_rate'=> $total_rate,
        ]);

    }
    public function createLesson($course){
        $my_course = $this->getMyCourse($course);
        if (!isset($my_course->name)){
            dd("fail");
        }
        return view('content.seller.addLesson', [
            'course' => $course,
            'name_course' => $my_course->name,
        ]);
    }
    public function createLessonProcessing($course,Request $request){
        // Ki??m tra xem kh??a h???c n??y c?? ph???i c???a m??nh kh??ng
        $my_course = $this->getMyCourse($course);
        if (!isset($my_course->name)){
            dd("fail");
        }

        $filename = Session::get('name') . "Video" . time().'.'.request()->video->getClientOriginalExtension();
        request()->video->move(public_path('videos'), $filename);
        $lesson = lesson::query()
            ->create([
                'courses_id' => $course,
                'name'  => $request->get('name'),
                'link'  => $filename,
                'description'  => $request->get('description'),
            ]);

        return redirect()->route('seller.detailCourse', [$course]);
    }

    public function manageLesson($course, $lesson){
        $my_course = $this->getMyCourse($course);
        if (!isset($my_course->name)){
            dd("fail");
        }
        $my_lesson = $this->getMyLesson($course, $lesson);
        if (!isset($my_lesson->name)){
            dd("fail");
        }

        return view('content.seller.viewLesson', [
            'my_course' => $my_course,
            'my_lesson' => $my_lesson,
        ]);
    }
}
