<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\View_history;
use App\Models\lesson;
use App\Models\order;
use App\Models\result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeViewController extends Controller
{
    public function course(Request $request){
        // Lấy thông tin từ khóa học course
        $course = course::query()
            ->select('courses.*','admins.name as name_admin',DB::raw('COUNT(lessons.courses_id) as number_lesson'))
            ->join('admins', 'courses.id_admin', '=', 'admins.id')
            ->leftJoin('lessons' , 'courses.id', '=', 'lessons.courses_id')
            ->where('courses.type', '=', '2')
            ->groupBy('courses.id')
            ->paginate(12);;
        return view('content.user.course',[
            'courses' => $course,
        ]);
    }

    public function viewCourse($course_id){
        // Lấy thông tin từ khóa học course
        $course = course::query()
            ->select('courses.*','admins.name as name_admin','admins.image as avatar',DB::raw('COUNT(lessons.courses_id) as number_lesson'), DB::raw('AVG(`orders`.`rate`) AS rate_course'))
            ->join('admins', 'courses.id_admin', '=', 'admins.id')
            ->leftJoin('orders' , 'courses.id', '=', 'orders.courses_id')
            ->leftJoin('lessons' , 'courses.id', '=', 'lessons.courses_id')
            ->where('courses.type', '=', '2')
            ->where('courses.id', '=', $course_id)
            ->groupBy('courses.id')
            ->firstOrFail();

        // Lấy tất cả từ bài học từ khóa học
        $lessons = lesson::query()
            ->select('*')
            ->where('courses_id', '=', $course_id)
            ->get();

        // Kiểm tra xem khóa học này đã được mua chưa
        $my_order = order::query()
            ->select('*')
            ->where('users_id', '=', session()->get('id'))
            ->where('courses_id', '=', $course_id)
            ->first();
        
        $check = 1;
        if(session()->has('id_course')){
            foreach (session()->get('id_course') as $cour){
                if ($cour == $course_id){
                    $check = 2;
                }
            }
        }

        if (isset($my_order->id)){
            $check = 3;
        }

        return view('content.user.viewCourse',[
            'courses'    => $course,
            'lessons'    => $lessons,
            'check'      => $check,
            'my_order'   => $my_order,
        ]);
    }

    public function orderCourse($course_id){
        // lấy thông tin khóa học
        $course = course::query()
            ->select('courses.*','admins.name as author')
            ->join('admins', 'courses.id_admin', '=', 'admins.id')
            ->where('courses.type', '=', '2')
            ->where('courses.id', '=', $course_id)
            ->firstOrFail();

        // Lưu thông tin bài học vào session
        session()->push('id_course', $course->id);
        session()->push('name_course', $course->name);
        session()->push('price_course', $course->price);
        session()->push('author_course', $course->author);

        return redirect()->route('home.viewCourse', $course_id);
    
    }

    public function unOrderCourse($course_id) {
        // hủy đặt hàng khóa học
        $id = session()->get('id_course') == null ? [] : session()->get('id_course');
        $name = session()->get('name_course') == null ? [] : session()->get('name_course');
        $price = session()->get('price_course') == null ? [] : session()->get('price_course');
        $author = session()->get('author_course') == null ? [] : session()->get('author_course');

        session()->forget('id_course');
        session()->forget('name_course');
        session()->forget('price_course');
        session()->forget('author_course');

        for ($i = 0; $i < count($id) ; $i++) {
            if($id[$i] != $course_id){
                session()->push('id_course', $id[$i]);
                session()->push('name_course', $name[$i]);
                session()->push('price_course', $price[$i]);
                session()->push('author_course', $author[$i]);
            }
        }

        return redirect()->route('home.myCart');
    }

    public function buyCourse(Request $request){
        $id_oder = explode(",", $request->get('id-buy'));
        $id_course = explode(",", $request->get('id-not-buy'));
        for ($i = 0; $i < count($id_course); $i++){
            $course = course::find($id_course[$i]);
            $order = order::query()
            ->create([
                'users_id'  => session()->get('id'),
                'courses_id' => $course->id,
                'price_buy'  => $course->price,
            ]);
            View_history::query()
            ->create([
                'users_id'  => session()->get('id'),
                'courses_id' => $course->id,
                'number_view'  => 1,
            ]);
        }

        $id = session()->get('id_course') == null ? [] : session()->get('id_course');
        $name = session()->get('name_course') == null ? [] : session()->get('name_course');
        $price = session()->get('price_course') == null ? [] : session()->get('price_course');
        $author = session()->get('author_course') == null ? [] : session()->get('author_course');

        session()->forget('id_course');
        session()->forget('name_course');
        session()->forget('price_course');
        session()->forget('author_course');

        for ($i = 0; $i < count($id) ; $i++) {
            if(in_array($id[$i], $id_oder)){
                session()->push('id_course', $id[$i]);
                session()->push('name_course', $name[$i]);
                session()->push('price_course', $price[$i]);
                session()->push('author_course', $author[$i]);
            }
        }

        return redirect()->route('home.myCourse');
    }

    public function myCourse(){
        $course = course::query()
            ->select('courses.*','admins.name as name_admin',DB::raw('COUNT(lessons.courses_id) as number_lesson'))
            ->join('admins', 'courses.id_admin', '=', 'admins.id')
            ->join('orders', 'courses.id', '=', 'orders.courses_id')
            ->leftJoin('lessons' , 'courses.id', '=', 'lessons.courses_id')
            ->where('courses.type', '=', '2')
            ->where('orders.users_id', '=', session()->get('id'))
            ->groupBy('courses.id')
            ->paginate(12);

        return view('content.user.myCourse',[
            'courses' => $course,
        ]);
    }

    public function ratingCourse(Request $request, $course_id){
        DB::table('orders')
        ->where('users_id', '=', session()->get('id'))
        ->where('courses_id', '=', $course_id)
        ->update([
            'rate' => $request->get('rating'),
            'comment' => $request->get('comment')
        ]);
        return redirect()->route('home.viewCourse', $course_id);
    }

    public function myCart(){
        return view('content.user.myCart');
    }

    public function updateViewHistory($course, $number_update){
        $number_lesson = course::query()
            ->select(DB::raw('COUNT(lessons.id) as number_lesson'))
            ->leftJoin('lessons' , 'courses.id', 'lessons.courses_id')
            ->where('courses.id', '=', $course)
            ->groupBy('courses.id')
            ->first();
        if ($number_lesson->number_lesson >= $number_update){
            $view =  DB::table('view_histories')
                ->where('users_id', session()->get('id'))
                ->where('courses_id', $course)
                ->update(['number_view' => $number_update]);
            return true;
        }else{
            return false;
        }
    }

    public function updateResult($question_id,$true_number,$false_number){
        $result = result::find($question_id);
        $result->number_true += $true_number;
        $result->number_false += $false_number;
        $result->save();
    }

}
