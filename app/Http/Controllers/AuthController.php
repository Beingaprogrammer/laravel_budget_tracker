<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Transaction;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function register(){
        return view('register');
    }
    public function storeregister(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'cpassword' => 'required|same:password',
        ]);

        if($validator->passes()){
           $user = new User;
           $user->name = $request->name;
           $user->email = $request->email;
           $user->password = Hash::make($request->password);
           $user->save();

           session()->flash('success','You have registered successfully');


            return response()->json([
                'status'=>true,
            ]); 
        }else{
            return response()->json([
                'status'=>false,
                'errors'=>$validator->errors()
            ]);   
        }
    }
    public function authenticate(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if($validator->passes()){
            if(Auth::attempt(['email' => $request->email,'password'=> $request->password],$request->get('remember'))){
                return redirect()->route('profile');
            }else{
                // session()->flash('error','Either Email/Password is Invalid');
                return redirect()->route('login')
                    ->withInput($request->only('email'))
                    ->with('error','Either email and password are invalid!');
            }
        }else{
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput($request->only('email'));   
        }
    }
    public function profile(){
        $user = Auth::user();
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpenses = Transaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpenses;
        // dd($user);
        $context = [
            'user'=>$user, 
            'totalIncome'=>$totalIncome, 
            'totalExpenses'=>$totalExpenses, 
            'balance'=>$balance, 
        ];
        return view('dashboard',$context);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')
            ->with('error','You successfully logged out!');
    }
}
