<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Validator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (!empty(Auth::user()->role)) {
            return redirect('/'.Auth::user()->role);
        }
        
        return view('auth.register');
    }


    public function validateuser($request, $editpassword = true , $editmode = false, $emailuniquecheck = true) 
    {

        $check = [
            'name' => 'required|string|max:255',
            'compname' => 'required|string|max:255',
            'entity' => 'not_in:0',
            'purpose' => 'not_in:0',
            'compindustry' => 'not_in:0',
            'position' => 'not_in:0',
            'membernumber' => 'required|not_in:0',
            'dob' => 'required|string|max:255',
            'companyinfo' => 'required|string|max:3000',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|confirmed|min:6',
            'check' => 'required',
            'phone' => ['required', 'regex:/^(0([1-9]{1}-?[1-9]\d{3}|[1-9]{2}-?\d{3}|[1-9]{2}\d{1}-?\d{2}|[1-9]{2}\d{2}-?\d{1})-?\d{4}|0[789]0-?\d{4}-?\d{4}|050-?\d{4}-?\d{4})$/'],
        ];

        if (!$editpassword) {
            unset($check['password']);
        }

        if ($editmode) {
            unset($check['check']);
        }

        if ($emailuniquecheck) {
            $check['email'] .= '|unique:users' ;
        }

        // print_r("$request->check");die;
        $validator = Validator::make($request->all(), $check,
        [
            // 'phone.required' => '電話番号を入力してください',
            // 'phone.regex' => '有効な電話番号を入力してください',
            'check.required' => __('validation.pleasecheck'),
        ]);

        return $validator;

    }


    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function confirm(Request $request)
    {

        $validator = $this->validateuser($request);

        if($request->ajax()){
        
            if ($validator->passes()) {
                return response()->json(['success'=>'allpasses']);
            }         
            return response()->json(['error'=>$validator->errors()]);
        
        }

        if (!empty($request->image)) {
            $imageName = time().'_'.$request->image->getClientOriginalName().'.'.$request->image->extension();           
            $request->image->move(public_path('images/avatar'), $imageName);
            $request->image = $imageName;
        } else {
            $imageName = '';
        }

        return view('auth.registerconfirm',compact('request'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        // print_r($request->all());die;
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'furiname' => 'required|string|max:255',
        //     'agerange' => 'not_in:0',
        //     'gender' => 'not_in:0',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|confirmed|min:6',
        //     'check' => 'required',
        // ],
        // [
        //     'check.required' => 'please tick',
        // ]);

        if (empty($request->role)) {
            $role = 'user';
        } else {
            $role = $request->role;
        }

        $user = User::create([
            'role' => $role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'compname' => $request->compname, 
            'entity' => $request->entity, 
            'purpose' => $request->purpose, 
            'compindustry' => $request->compindustry, 
            'position' => $request->position,
            'membernumber' => $request->membernumber,
            'dob' => $request->dob.'-01',
            'companyinfo' => $request->companyinfo,
            'profileimg' => $request->image,
            'compname' => $request->compname,
            'phone' => $request->phone,
            'address' => $request->address,
            'url' => $request->url,
        ]);

        event(new Registered($user));

        // Auth::login($user);
        $email = $request->email;
        // return redirect('/email/verification-notification');
        return view('auth.verify-email',compact('email'));
    }
}
