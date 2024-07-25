<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\UserSetting;


class TransactionController extends Controller
{
    protected function checkBudgetLimit()
    {
        $user = Auth::user();
        $settings = UserSetting::where('user_id', $user->id)->first();
        
        if ($settings && $settings->budget_limit) {
            $totalExpenses = Transaction::where('user_id', $user->id)
                ->where('type', 'expense')
                ->whereYear('date', now()->year)
                ->whereMonth('date', now()->month)
                ->sum('amount');
        
            if ($totalExpenses >= $settings->budget_limit) {
                $user->notify(new BudgetLimitApproaching($totalExpenses));
            }
        }
    }

    public function index(Request $request){
        $transactions = Transaction::select('transactions.*', 'categories.name as category_name')
        ->leftJoin('categories', 'transactions.category_id', '=', 'categories.id');

        if ($request->filled('keyword')) {
            $transactions->where('categories.name', 'LIKE', '%' . $request->keyword . '%');
        }

        $transactions = $transactions->get();

        $context =[
            'transactions'=>$transactions
        ];
        return view('transactions.list',$context);
    }
    public function tra_create(){
        $categories = Category::orderby('name','ASC')->get();
        $context =[
            'categories'=>$categories
        ];
        return view('transactions.create',$context);
    }
    public function tra_store(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'type' => 'required|in:income,expense',
        ]);
    
        if($validator->passes()){
            $transaction = new Transaction();
            $transaction->description = $request->description; 
            $transaction->amount = $request->amount; 
            $transaction->date = $request->date; 
            $transaction->type = $request->type; 
            $transaction->user_id = Auth::id();
            $transaction->category_id = $request->category_name; 
            $transaction->save();

            $this->checkBudgetLimit();
    
            $request->session()->flash('success','Transaction added Successfully');
    
            return response()->json([
                'status' => true,
                'message' => 'Transaction added Successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);   
        }
    }
    public function tra_edit($id){
        $transaction = Transaction::find($id);
        $categories = Category::orderby('name','ASC')->get();

        $context =[
            'transaction'=>$transaction,
            'categories'=>$categories
        ];
       return view('transactions.edit',$context);
    }
    public function tra_update(Request $request,$id){
        $transaction = Transaction::find($id);
        
        $validator = Validator::make($request->all(),[
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'type' => 'required|in:income,expense',
        ]);
    
        if($validator->passes()){
            $transaction->description = $request->description; 
            $transaction->amount = $request->amount; 
            $transaction->date = $request->date; 
            $transaction->type = $request->type; 
            $transaction->user_id = Auth::id();
            $transaction->category_id = $request->category_name; 
            $transaction->save();

            $this->checkBudgetLimit();
    
            $request->session()->flash('success','Transaction updated Successfully');
    
            return response()->json([
                'status' => true,
                'message' => 'Transaction updated Successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);   
        }

    }

    public function tra_destroy($id){
        $transaction = Transaction::find($id);
        if(empty($id)){
            $request->session()->flash('error', 'Transaction not found');
            return response()->json([
                'status'=>true,
                'message'=>'Transaction not found'
            ]);
        }
       
        $transaction->delete();

        $request->session()->flash('success','Transaction deleted Successfully');
        return response()->json([
            'status'=>true,
            'message'=>'Transaction deleted Successfully'
        ]);

    }
    public function monthlyReport(Request $request)
    {
        $month = $request->input('month', now()->format('Y-m'));
    
        $transactions = Transaction::whereYear('date', '=', substr($month, 0, 4))
            ->whereMonth('date', '=', substr($month, 5, 2))
            ->get();
    
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpenses = $transactions->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpenses;

        $context =[
            'totalIncome'=>$totalIncome,
            'totalExpenses'=>$totalExpenses,
            'balance'=>$balance,
            'transactions'=>$transactions,
            'month'=>$month,
        ];
    
        return view('transactions.monthly_report',$context);
    }
}
