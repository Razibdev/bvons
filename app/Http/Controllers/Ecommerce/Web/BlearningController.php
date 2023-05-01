<?php

namespace App\Http\Controllers\Ecommerce\Web;

use App\BLearningCategory;
use App\Http\Controllers\Controller;
use App\Model\BCourse;
use App\Model\BSubject;
use App\Model\BTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlearningController extends Controller
{
    public function index(){
        return view('dashboard.b_learning.b_learning');
    }

    public function addCategory(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required|unique:b_learning_categories|max:255',
                'type' => 'required',
            ]);

            $data = $request->all();
            $category = new BLearningCategory();
            $category->name = $data['name'];
            $category->url = Str::slug($data['name']);
            $category->type = $data['type'];
            $category->save();
            return redirect()->back();
        }
        return view('dashboard.b_learning.category.add_category');
    }


    public function viewCategory(){
        $categories = BLearningCategory::orderBy('id', 'desc')->paginate(10);
        return view('dashboard.b_learning.category.view_category', compact('categories'));
    }


    public function editCategory(Request $request, $id){

        if($request->isMethod('post')){
            $request->validate([
                'name' => 'required|unique:b_learning_categories|max:255',
                'type' => 'required',
            ]);
            $data = $request->all();

            BLearningCategory::where('id', $id)->update(['name' => $data['name'], 'type'=> $data['type'], 'url' => Str::slug($data['name'])]);
            return redirect()->back();

        }

        $category = BLearningCategory::where('id', $id)->first();
        return view('dashboard.b_learning.category.edit_category', compact('category'));
    }


    public function deleteCategory($id){
        BLearningCategory::where('id', $id)->delete();
        return redirect()->back();
    }


    // course controller here

    public function addCourse(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'course_name' => 'required|unique:b_courses|max:255',
                'category' => 'required',
            ]);
            $data = $request->all();

            $course = BCourse::latest()->first();
            $coursec = BCourse::count();
            if($coursec >= 1){
                $course_id = $course->id + 1;
            }else{
                $course_id = 1;
            }


            if(empty($data['course_description'])){
                $data['course_description'] = '';
            }

            if(empty($data['live_class'])){
                $data['live_class'] = '';
            }

            if(empty($data['course_feature'])){
                $data['course_feature'] = '';
            }

            if(empty($data['course_price'])){
                $data['course_price'] = '';
            }

            if(empty($data['current_price'])){
                $data['current_price'] = '';
            }

            if(empty($data['top_course'])){
                $top_course = 0;
            }else{
                $top_course = 1;

            }

            if($request->hasFile('course_image')){
                $image_tmp = $request->file('course_image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;
                }

                $path = 'media/blearning/course/image/'.$course_id;
                if(!File::isDirectory($path)){

                    File::makeDirectory($path, 0777, true, true);

                }

                $large_image_path = 'media/blearning/course/image/'.$course_id."/".$filename;

                Image::make($image_tmp)->resize(655, 300)->save($large_image_path);
            }else{
                $filename = '';
            }


            if($request->hasFile('course_video')){
                $image_tmp = $request->file('course_video');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filevideo = rand(111111, 999999).'.'.$extension;
                }

                $path = 'media/blearning/course/video/'.$course_id;
                if(!File::isDirectory($path)){

                    File::makeDirectory($path, 0777, true, true);

                }
                $image_tmp->move($path, $filevideo);

            }else{
                $filevideo = '';
            }


            $course = new BCourse();
            $course->category_id = $data['category'];
            $course->course_name = $data['course_name'];
            $course->course_url = Str::slug($data['course_name']);
            $course->course_description = $data['course_description'];
            $course->live_class = $data['live_class'];
            $course->course_feature = $data['course_feature'];
            $course->course_price = $data['course_price'];
            $course->current_price = $data['current_price'];
            $course->cover_image = $filename;
            $course->cover_video = $filevideo;
            $course->top_course = $top_course;
            $course->save();
            return redirect()->back();

        }

        $categories = BLearningCategory::get();
        return view('dashboard.b_learning.course.add_course', compact('categories'));
    }


    public function viewCourse(){
        $courses = BCourse::with('category')->orderBy('id', 'desc')->get();
        return view('dashboard.b_learning.course.view_course', compact('courses'));
    }




    public function editCourse(Request $request, $id){

        if($request->isMethod('post')){
            $request->validate([
                'course_name' => 'required|unique:b_courses|max:255',
                'category' => 'required',
            ]);
            $data = $request->all();

            $course = BCourse::where('id', $id)->first();


            if(empty($data['course_description'])){
                $data['course_description'] = '';
            }

            if(empty($data['live_class'])){
                $data['live_class'] = '';
            }

            if(empty($data['course_feature'])){
                $data['course_feature'] = '';
            }

            if(empty($data['course_price'])){
                $data['course_price'] = '';
            }

            if(empty($data['current_price'])){
                $data['current_price'] = '';
            }

            if(empty($data['top_course'])){
                $top_course = 0;
            }else{
                $top_course = 1;

            }

            if($request->hasFile('course_image')){
                $image_tmp = $request->file('course_image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;
                }

                $path = 'media/blearning/course/image/'.$course->id;
                if(!File::isDirectory($path)){

                    File::makeDirectory($path, 0777, true, true);

                }

                $large_image_path = 'media/blearning/course/image/'.$course->id."/".$filename;

                Image::make($image_tmp)->resize(655, 300)->save($large_image_path);
            }else{
                $filename = $data['image_current'];
            }


            if($request->hasFile('course_video')){
                $image_tmp = $request->file('course_video');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filevideo = rand(111111, 999999).'.'.$extension;
                }

                $path = 'media/blearning/course/video/'.$course->id;
                if(!File::isDirectory($path)){

                    File::makeDirectory($path, 0777, true, true);

                }
                $image_tmp->move($path, $filevideo);

            }else{
                $filevideo = $data['video_current'];
            }

            BCourse::where('id', $id)->update(['category_id'=> $data['category'], 'course_name' => $data['course_name'], 'course_description' => $data['course_description'], 'live_class' => $data['live_class'], 'course_feature' => $data['course_feature'], 'course_price' => $data['course_price'], 'current_price' => $data['current_price'], 'cover_image' => $filename, 'cover_video' => $filevideo, 'top_course' => $top_course, 'course_url'=>Str::slug($data['course_name'])]);
            return redirect()->back();
        }
        $courses = BCourse::where('id', $id)->first();
        $categories = BLearningCategory::get();
        return view('dashboard.b_learning.course.edit_course', compact('courses', 'categories'));

    }


    public function deleteCourse($id){

        $deletePost = BCourse::where('id', $id)->first();
        if($deletePost->cover_image != null || $deletePost->cover_image != '' ){
            $directory = 'media/blearning/course/image/'.$id;
            File::deleteDirectory(public_path($directory));
        }


        if($deletePost->cover_video != null || $deletePost->cover_video != '' ){
            $directory = 'media/blearning/course/video/'.$id;
            File::deleteDirectory(public_path($directory));
        }

        $deletePost->delete();
        return redirect()->back();
    }

    public function addTeacher(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'teacher_name' => 'required|max:255',
                'subject' => 'required',
                'u_name' => 'required',
                'profile_image' => 'required',
            ]);
            $data = $request->all();


            if($request->hasFile('profile_image')){
                $image_tmp = $request->file('profile_image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;
                }

                $large_image_path = 'media/blearning/teacher/image/'.$filename;

                Image::make($image_tmp)->resize(655, 300)->save($large_image_path);
            }else{
                $filename = '';
            }

            $teacher = new BTeacher();
            $teacher->teacher_name = $data['teacher_name'];
            $teacher->subject_id = $data['subject'];
            $teacher->university_name = $data['u_name'];
            $teacher->profile_image = $filename;
            $teacher->save();

            return redirect()->back();
        }

        $subjects = BSubject::all();
        return view('dashboard.b_learning.teacher.add_teacher', compact('subjects'));
    }

    public function viewTeacher(){
        $teachers = BTeacher::orderBy('id', 'desc')->get();
        return view('dashboard.b_learning.teacher.view_teacher', compact('teachers'));
    }


    public function editTeacher(Request $request, $id){
        $teacher = BTeacher::where('id', $id)->first();

        if($request->isMethod('post')){
            $request->validate([
                'teacher_name' => 'required|max:255',
                'u_name' => 'required',
                'subject' => 'required',
            ]);
            $data = $request->all();


            if($request->hasFile('profile_image')){
                $image_tmp = $request->file('profile_image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111111, 999999).'.'.$extension;
                }
                if (isset($teacher->profile_image)){
                    $large_image_path = "media/blearning/teacher/image/".$teacher->profile_image;

                    if(File::exists($large_image_path)){
                        File::delete($large_image_path);
                    }
                }

                $large_image_path = "media/blearning/teacher/image/".$filename;
                Image::make($image_tmp)->save($large_image_path);

            }else{
                $filename = $request->profile_image_current;
            }


            BTeacher::where('id', $id)->update(['teacher_name' => $data['teacher_name'], 'university_name' => $data['u_name'], 'profile_image' => $filename, 'subject_id' => $data['subject']]);
            return redirect('/blearning/teacher/view');

        }

        $subjects = BSubject::all();

        return view('dashboard.b_learning.teacher.edit_teacher', compact('teacher', 'subjects'));
    }


    public function deleteTeacher($id){
        $deleteTeacher = BTeacher::where('id', $id)->first();
        $directory = "media/blearning/teacher/image/".$deleteTeacher->profile_image;
        if(file_exists($directory)){
            unlink($directory);
        }
        $deleteTeacher->delete();
        return redirect()->back();
    }



    public function addSubject(Request $request){


        if($request->isMethod('post')){
            $request->validate([
                'course_id' => 'required',
                'subject_name' => 'required',
                'content_description' => 'required',
            ]);
            $data = $request->all();

            $subject = new BSubject();
            $subject->course_id = $data['course_id'];
            $subject->subject_name = $data['subject_name'];
            $subject->subject_description = $data['content_description'];
            $subject->save();

            return redirect()->back();

        }

        $courses = BCourse::all();
        return view('dashboard.b_learning.subject.add_subject', compact( 'courses'));
    }


        public function viewSubject(){
            $subjects = BSubject::with('course', 'teacher')->orderBy("id", 'desc')->get();
            //        $subjects = json_decode(json_encode($subjects));
            //        echo"<pre>"; print_r($subjects); die;
            return view('dashboard.b_learning.subject.view_subject', compact('subjects'));
        }

        public function editSubject(Request $request, $id){

            if($request->isMethod('post')){
                $request->validate([
                    'course_id' => 'required',
                    'subject_name' => 'required',
                    'content_description' => 'required',
                ]);
                $data = $request->all();

                BSubject::where('id', $id)->update(['course_id' => $data['course_id'], 'subject_name' => $data['subject_name'], 'subject_description' => $data['content_description']]);
                return redirect()->back();
            }

            $subject = BSubject::where('id', $id)->first();
            $courses = BCourse::all();
            return view('dashboard.b_learning.subject.edit_subject', compact('subject', 'courses'));
        }

        public function deleteSubject($id){
            BSubject::where('id', $id)->delete();
            return redirect()->back();
        }










}
