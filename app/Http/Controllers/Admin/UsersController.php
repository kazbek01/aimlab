<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Actions;
use App\Models\Role;
use App\Models\UserRegion;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use Excel;
use Lang;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        View::share('menu', 'admin');
    }

    public function index(Request $request)
    {
        if(Auth::user()->role_id == 12) abort(404);

        $region_ids = 0;

        if(Auth::user()->role_id != 1 && Auth::user()->role_id != 8){
            $region_ids = Helpers::getRegionsByParent(Auth::user()->region_id);
        }

        $row = Users::leftJoin('region','region.region_id','=','users.region_id')
            ->leftJoin('school','school.school_id','=','users.school_id')
            ->leftJoin('role','role.role_id','=','users.role_id')
            ->orderBy('users.user_id','desc')
            ->where('users.user_id','!=',Auth::user()->user_id)
            ->select(
                'users.user_id',
                'users.name',
                'users.email',
                'users.phone',
                'users.avatar',
                'users.grade',
                'users.grade_type',
                'users.is_schoolchild',
                'school.school_name_ru',
                'role.role_name_ru',
                'region.region_name_ru',
                DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('users.is_ban',$request->active);
        else $row->where('users.is_ban','0');

        if(Auth::user()->role_id == 11){
            $row->where('users.school_id',Auth::user()->school_id);
        }
        elseif(Auth::user()->role_id == 12){
            $row->where('users.school_id',Auth::user()->school_id)->where('users.grade',Auth::user()->grade)->where('users.grade_type',Auth::user()->grade_type);
        }
        elseif($region_ids != 0) $row->whereIn('users.region_id',$region_ids);

        if(Auth::user()->role_id == 8){
            $row->where('users.role_id',8)->orWhere('users.role_id',9);
        }
        elseif(Auth::user()->role_id == 9 && Helpers::checkHasChildRegion(Auth::user()->region_id) == 0){
            $row->where(function($query) use ($request){
                $query->where('users.role_id',9)->orWhere('users.role_id',10);
            });
        }
        elseif(Auth::user()->role_id == 9){
            $row->where(function($query) use ($request){
                $query->where('users.role_id',9)->orWhere('users.role_id',10)->orWhere('users.role_id',11);
            });
        }
        elseif(Auth::user()->role_id == 10){
            $row->where(function($query) use ($request){
                $query->where('users.role_id',10)->orWhere('users.role_id',11);
            });
        }
        elseif(Auth::user()->role_id == 11){
            $row->where(function($query) use ($request){
                $query->where('users.role_id',11)->orWhere('users.role_id',12);
            });
        }
        else {
            $row->where(function($query) use ($request){
                $query->where('users.role_id','>=',8)->where('users.role_id','<=',12);
            });
        }

        if(isset($request->client_name) && $request->client_name != ''){
            $row->where(function($query) use ($request){
                $query->where('users.name','like','%' .$request->client_name .'%');
            });
        }

        if(isset($request->school_name) && $request->school_name != ''){
            $row->where(function($query) use ($request){
                $query->where('school_name_ru','like','%' .$request->school_name .'%');
            });
        }

        if(isset($request->region_name) && $request->region_name != ''){
            $row->where(function($query) use ($request){
                $query->where('region_name_ru','like','%' .$request->region_name .'%');
            });
        }

        if(isset($request->email) && $request->email != ''){
            $row->where(function($query) use ($request){
                $query->where('users.email','like','%' .$request->email .'%')
                    ->orWhere('users.phone','like','%' .Helpers::getPhoneFormat4($request->email) .'%');
            });
        }

        if(isset($request->grade) && $request->grade > 0){
            $row->where(function($query) use ($request){
                $query->where('users.grade',$request->grade);
            });
        }

        if($request->grade_type != ''){
            $row->where(function($query) use ($request){
                $query->where('users.grade_type',$request->grade_type);
            });
        }

        if(isset($request->school_id) && $request->school_id > 0){
            $row->where(function($query) use ($request){
                $query->where('users.school_id',$request->school_id);
            });
        }

        $row = $row->paginate(100);


        return  view('admin.users.users',[
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        if(Auth::user()->role_id == 12) abort(404);

        $row = new Users();
        $row->avatar = '/admin/img/avatar.jpg';

        Helpers::getRoles(Auth::user()->role_id);
        Helpers::getRegions(Auth::user()->role_id);
        Helpers::getSchools(Auth::user()->role_id);

        return  view('admin.users.users-edit', [
            'title' => 'Добавить пользователя',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        if(Auth::user()->role_id == 12) abort(404);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,NULL,user_id,deleted_at,NULL'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();

            Helpers::getRoles(Auth::user()->role_id);
            Helpers::getRegions(Auth::user()->role_id);
            Helpers::getSchools(Auth::user()->role_id);

            return  view('admin.users.users-edit', [
                'title' => 'Добавить пользователя',
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $client = new Users();
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->avatar = $request->avatar;
        $client->email = $request->email;
        $client->password = Hash::make('12345');
        $client->role_id = $request->role_id;
        $client->region_id = ($request->region_id > 0)?$request->region_id:null;
        $client->school_id = ($request->school_id > 0)?$request->school_id:null;
        $client->grade = ($request->grade >= 0 && $request->grade != '')?$request->grade:null;
        $client->grade_type = ($request->grade_type != '')?$request->grade_type:null;
        $client->registered_user_id = Auth::user()->user_id;
        $client->save();

        $action = new Actions();
        $action->action_code_id = 2;
        $action->action_comment = 'users';
        $action->action_text_ru = 'добавил(а) пользователя "' .$client->name .'"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $client->user_id;
        $action->save();

        return redirect('/admin/user');
    }

    public function edit($id)
    {
        $region_ids = 0;

        if(Auth::user()->role_id != 1 && Auth::user()->role_id != 8){
            $region_ids = Helpers::getRegionsByParent(Auth::user()->region_id);
        }

        $row = Users::where('user_id',$id);

        $row->where(function($query){
            $query->where('users.role_id',3)->orWhere('users.role_id','>=',8);
        });

        if($region_ids != 0) $row->whereIn('users.region_id',$region_ids);

        $row = $row->first();

        if($row == null) abort(404);

        Helpers::getRoles(Auth::user()->role_id);
        Helpers::getRegions(Auth::user()->role_id);
        Helpers::getSchools(Auth::user()->role_id);

        return  view('admin.users.users-edit', [
            'title' => Lang::get('app.edit_user'),
            'row' => $row
        ]);
    }


    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email,' .$id .',user_id,deleted_at,NULL'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();

            Helpers::getRoles(Auth::user()->role_id);
            Helpers::getRegions(Auth::user()->role_id);
            Helpers::getSchools(Auth::user()->role_id);

            return  view('admin.users.users-edit', [
                'title' => Lang::get('app.edit_user'),
                'row' => (object) $request->all(),
                'error' => $error[0]
            ]);
        }

        $region_ids = 0;

        if(Auth::user()->role_id != 1 && Auth::user()->role_id != 8){
            $region_ids = Helpers::getRegionsByParent(Auth::user()->region_id);
        }

        $client = Users::where('user_id',$id);

        if($region_ids != 0) $client->whereIn('users.region_id',$region_ids);

        $client = $client->first();

        if($client == null) abort(404);

        $client->name = $request->name;

        if(Auth::user()->role_id != 12){
            $client->role_id = $request->role_id;
            $client->region_id = ($request->region_id > 0)?$request->region_id:null;
            $client->school_id = ($request->school_id > 0)?$request->school_id:null;
        }

        $client->phone = $request->phone;
        $client->avatar = $request->avatar;
        $client->email = $request->email;
        $client->grade = ($request->grade > 0)?$request->grade:null;
        $client->grade = ($request->grade >= 0 && $request->grade != '')?$request->grade:null;
        $client->grade_type = ($request->grade_type != '')?$request->grade_type:null;
        if($client->registered_user_id == '') $client->registered_user_id = Auth::user()->user_id;
        $client->save();

        $action = new Actions();
        $action->action_code_id = 3;
        $action->action_comment = 'users';
        $action->action_text_ru = 'редактировал(а) данные пользователя "' .$client->name .'"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $client->user_id;
        $action->save();

        Cache::flush();

        if(Auth::user()->role_id == 12) return redirect('/admin/client');

        return redirect('/admin/user');
    }

    public function destroy($id)
    {
        if(Auth::user()->role_id == 12) abort(404);

        $region_ids = 0;

        if(Auth::user()->role_id != 1 && Auth::user()->role_id != 8){
            $region_ids = Helpers::getRegionsByParent(Auth::user()->region_id);
        }

        $client = Users::where('user_id',$id);

        if(Auth::user()->role_id == 11){
            $client->where('users.school_id',Auth::user()->school_id);
        }
        elseif($region_ids != 0) $client->whereIn('users.region_id',$region_ids);

        $client = $client->first();

        if($client == null) abort(404);

        Cache::flush();

        $client->delete();

        $action = new Actions();
        $action->action_code_id = 1;
        $action->action_comment = 'users';
        $action->action_text_ru = 'удалил(а) пользователя "' .$client->name .'"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $id;
        $action->save();

    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function resetPassword(Request $request,$user_id){
        $user = Users::find($user_id);
        $user->password = Hash::make('12345');
        $user->save();

        $action = new Actions();
        $action->action_comment = 'user';
        $action->action_text_ru = 'сбросил пароль администратора "' .$user->name .'"';
        $action->action_code_id = 8;
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $user->user_id;
        $action->save();

        $url = '';
        if($request->page > 0) $url = '?page='.$request->page;
        return redirect('/admin/user'.$url);
    }
    
    public function password(Request $request){
        View::share('menu', 'password');
        if(isset($request->old_password)){
            $user = Users::where('user_id','=',Auth::user()->user_id)->first();
            $count = Hash::check($request->old_password, $user->password);
            if($count == false){
                return  view('admin.users.password-edit',[
                    'error' => 'Неправильный старый пароль'
                ]);
            }

            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'new_password' => 'required|different:old_password',
                'confirm_password' => 'required|same:new_password',
            ]);

            if ($validator->fails()) {
                $messages = $validator->errors();
                $error = $messages->all();
                return  view('admin.users.password-edit', [
                    'error' => $error[0]
                ]);
            }

            $user = Users::where('user_id','=',Auth::user()->user_id)->first();
            $user->password = Hash::make($request->new_password);
            $user->save();

            return  view('admin.users.password-edit', [
                'error' => 'Успешно изменен'
            ]);
        }
        return  view('admin.users.password-edit');
    }

    public function changeIsBan(Request $request){
        $review = Users::find($request->id);
        $review->is_ban = $request->is_show;
        $review->save();
    }

    public function exportExcel(Request $request)
    {
        if(Auth::user()->role_id != 11 && Auth::user()->role_id != 1) abort(404);

        $region_ids = 0;

        if(Auth::user()->role_id != 1 && Auth::user()->role_id != 8){
            $region_ids = Helpers::getRegionsByParent(Auth::user()->region_id);
        }

        $row = Users::leftJoin('region','region.region_id','=','users.region_id')
            ->leftJoin('school','school.school_id','=','users.school_id')
            ->leftJoin('role','role.role_id','=','users.role_id')
            ->orderBy('users.user_id','desc')
            ->where('users.user_id','!=',Auth::user()->user_id)
            ->select(
                'users.user_id',
                'users.name',
                'users.email',
                'users.phone',
                'users.avatar',
                'users.grade',
                'users.grade_type',
                'users.is_schoolchild',
                'school.school_name_ru',
                'role.role_name_ru',
                'region.region_name_ru',
                DB::raw('DATE_FORMAT(users.created_at,"%d.%m.%Y %H:%i") as date'));

        if(isset($request->active))
            $row->where('users.is_ban',$request->active);
        else $row->where('users.is_ban','0');

        if(Auth::user()->role_id == 11){
            $row->where('users.school_id',Auth::user()->school_id);
        }
        elseif(Auth::user()->role_id == 12){
            $row->where('users.school_id',Auth::user()->school_id)->where('users.grade',Auth::user()->grade)->where('users.grade_type',Auth::user()->grade_type);
        }
        elseif($region_ids != 0) $row->whereIn('users.region_id',$region_ids);

        if(Auth::user()->role_id == 8){
            $row->where('users.role_id',8)->orWhere('users.role_id',9);
        }
        elseif(Auth::user()->role_id == 9 && Helpers::checkHasChildRegion(Auth::user()->region_id) == 0){
            $row->where(function($query) use ($request){
                $query->where('users.role_id',9)->orWhere('users.role_id',10);
            });
        }
        elseif(Auth::user()->role_id == 9){
            $row->where(function($query) use ($request){
                $query->where('users.role_id',9)->orWhere('users.role_id',10)->orWhere('users.role_id',11);
            });
        }
        elseif(Auth::user()->role_id == 10){
            $row->where(function($query) use ($request){
                $query->where('users.role_id',10)->orWhere('users.role_id',11);
            });
        }
        elseif(Auth::user()->role_id == 11){
            $row->where(function($query) use ($request){
                $query->where('users.role_id',11)->orWhere('users.role_id',12);
            });
        }
        else {
            $row->where(function($query) use ($request){
                $query->where('users.role_id','>=',8)->where('users.role_id','<=',12);
            });
        }

        if(isset($request->client_name) && $request->client_name != ''){
            $row->where(function($query) use ($request){
                $query->where('users.name','like','%' .$request->client_name .'%');
            });
        }

        if(isset($request->school_name) && $request->school_name != ''){
            $row->where(function($query) use ($request){
                $query->where('school_name_ru','like','%' .$request->school_name .'%');
            });
        }

        if(isset($request->region_name) && $request->region_name != ''){
            $row->where(function($query) use ($request){
                $query->where('region_name_ru','like','%' .$request->region_name .'%');
            });
        }

        if(isset($request->email) && $request->email != ''){
            $row->where(function($query) use ($request){
                $query->where('users.email','like','%' .$request->email .'%')
                    ->orWhere('users.phone','like','%' .Helpers::getPhoneFormat4($request->email) .'%');
            });
        }

        if(isset($request->grade) && $request->grade != ''){
            $row->where(function($query) use ($request){
                $query->where('users.grade',$request->grade);
            });
        }

        if($request->grade_type != ''){
            $row->where(function($query) use ($request){
                $query->where('users.grade_type',$request->grade_type);
            });
        }

        if(isset($request->school_id) && $request->school_id > 0){
            $row->where(function($query) use ($request){
                $query->where('users.school_id',$request->school_id);
            });
        }

        $row = $row->take(10000);

        $row = $row->get();

        $param = [];

        $param[] = ['№', 'ФИО','Регион','Школа','Сынып','Литер'];

        foreach ($row as $key => $client) {
            $param[$key + 1][] = $key + 1;
            $param[$key + 1][] = $client->name;
            $param[$key + 1][] = $client->region_name_ru;
            $param[$key + 1][] = $client->school_name_ru;
            $param[$key + 1][] = $client->grade;
            $param[$key + 1][] = $client->grade_type;
        }

        $excel_name = 'Статистика - Пользователи';

        // Generate and return the spreadsheet
        $result = Excel::create($excel_name, function($excel) use ($param) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Статистика - Пользователи');
            $excel->setCreator('Daryn')->setCompany('Daryn');
            $excel->setDescription('Статистика - Пользователи');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($param) {
                $sheet->fromArray($param, null, 'A1', false, false);
            });

        })->download('xls');
    }
}
