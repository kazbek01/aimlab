<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers;
use App\Models\Actions;
use App\Models\Menu;
use App\Models\Contact;
use App\Models\Users;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use View;
use DB;
use Auth;

class ContactController extends Controller
{
    public function __construct()
    {
        View::share('menu', 'contact');

    }
    public function index(Request $request)
    {
        $row = Contact::orderBy('contact_id', 'desc')
            ->select('contact.*');

//        dd($row);

        


        $row = $row->paginate(20);

        return view('admin.contact.contact', [
            'row' => $row,
            'request' => $request
        ]);
    }

    public function create()
    {
        $row = new Contact();
      

        return view('admin.contact.contact-edit', [
            'title' => 'Добавить контакты',
            'row' => $row
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();
            return view('admin.contact.contact-edit', [
                'title' => 'Добавить контакты',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $contact = new Contact();
        $contact->phone = $request->phone;
        $contact->whatsapp = $request->whatsapp;
        $contact->email = $request->email;
        $contact->fax = $request->fax;


        $contact->save();


        $action = new Actions();
        $action->action_code_id = 2;
        $action->action_comment = 'contact';
        $action->action_text_ru = 'добавил(а) контакты "' . $contact->contact_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $contact->contact_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/contact');
    }

    public function edit($id)
    {
        $row = Contact::where('contact_id', $id)
            ->select('*')
            ->first();

        return view('admin.contact.contact-edit', [
            'title' => 'Редактировать данные контактa',
            'row' => $row
        ]);
    }

    public function show(Request $request, $id)
    {

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors();
            $error = $messages->all();


            return view('admin.contact.contact-edit', [
                'title' => 'Редактировать данные контакты',
                'row' => (object)$request->all(),
                'error' => $error[0]
            ]);
        }

        $contact = Contact::find($id);

        $contact->phone = $request->phone;
        $contact->whatsapp = $request->whatsapp;
        $contact->email = $request->email;
        $contact->fax = $request->fax;



        $contact->save();

        $action = new Actions();
        $action->action_code_id = 3;
        $action->action_comment = 'contact';
        $action->action_text_ru = 'редактировал(а) данные контакты "' . $contact->contact_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $contact->contact_id;
        $action->save();

        Cache::flush();

        return redirect('/admin/contact');
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);


        $contact->delete();

        $action = new Actions();
        $action->action_code_id = 1;
        $action->action_comment = 'contact';
        $action->action_text_ru = 'удалил(а) контакты "' . $contact->contact_title . '"';
        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $id;
        $action->save();

        Cache::flush();

    }

    public function changeIsShow(Request $request)
    {
        $contact = Contact::find($request->id);
        $contact->is_show = $request->is_show;
        $contact->save();

        $action = new Actions();
        $action->action_comment = 'contact';

        if ($request->is_show == 1) {
            $action->action_text_ru = 'отметил(а) как активное - контакты "' . $contact->contact_title . '"';
            $action->action_code_id = 5;
        } else {
            $action->action_text_ru = 'отметил(а) как неактивное - контакты "' . $contact->contact_title . '"';
            $action->action_code_id = 4;
        }

        $action->user_id = Auth::user()->user_id;
        $action->universal_id = $contact->contact_id;
        $action->save();

        Cache::flush();
    }
}
