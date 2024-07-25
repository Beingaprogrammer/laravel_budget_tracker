<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserSetting;

use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function edit()
    {
      
        $settings = UserSetting::where('user_id', Auth::id())->first();
        
    
        if (!$settings) {
            $settings = new UserSetting();
            $settings->budget_limit = 0; 
        }
        
        return view('budget.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate(['budget_limit' => 'nullable|numeric']);
    
        
        $settings = UserSetting::firstOrNew(['user_id' => Auth::id()]);
        $settings->budget_limit = $request->budget_limit;
        $settings->save();
    
        return redirect()->route('profile')->with('success', 'Settings updated successfully.');
    }
}
