<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    public function expenseCategoryList()
    {
        $user_id = auth()->user()->id;
        return ExpenseCategory::where('user_id', '=', $user_id)->get();

    }

    public function expenseCategoryCreate(Request $request)
    {

        $user_id = auth()->user()->id;
        $name = $request->input('name');

        return ExpenseCategory::create([
            'name' => $name,
            'user_id' => $user_id,
        ]);
    }

    public function expenseCategoryUpdate(Request $request)
    {
    
        $expense_cat_id = $request->input('id');

        return ExpenseCategory::where('id', '=', $expense_cat_id)->update([
            'name' => $request->input('name')
        ]);
    }

    public function expenseCategoryDelete(Request $request)
    {
        $expense_cat_id = $request->id;
        return ExpenseCategory::where('id', '=', $expense_cat_id)->delete();
    }

    function expenseCategoryBYId(){
        //
    }

}
