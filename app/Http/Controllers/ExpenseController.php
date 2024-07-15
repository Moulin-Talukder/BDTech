<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Account;
use App\CashRegister;
use App\ExpenseCategory;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;
use DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $productModalcategory = request()->session()->get('productModalcategory');
        $lims_expense_category_all = ExpenseCategory::where('is_active', true)->get();
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('expenses-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if (empty($all_permission))
                $all_permission[] = 'dummy text';
            $lims_account_list = Account::where('is_active', true)->get();

            if (Auth::user()->role_id > 2 && config('staff_access') == 'own')
                $lims_expense_all = Expense::orderBy('id', 'desc')->where('user_id', Auth::id())->get();
            else
                $lims_expense_all = Expense::orderBy('id', 'desc')->get();
            return view('expense.index', compact('lims_expense_category_all', 'lims_account_list', 'lims_expense_all', 'all_permission', 'productModalcategory'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['reference_no'] = 'er-' . date("Ymd") . '-' . date("his");
        $data['user_id'] = Auth::id();
        $cash_register_data = CashRegister::where([
            ['user_id', $data['user_id']],
            ['warehouse_id', $data['warehouse_id']],
            ['status', true]
        ])->first();
        if ($cash_register_data)
            $data['cash_register_id'] = $cash_register_data->id;
        Expense::create($data);
        return redirect('expenses')->with('message', 'Data inserted successfully');
    }

    public function show($id)
    {
        $expense_list = Expense::findOrFail($id);

        $user = DB::table('users')->find($expense_list->user_id);

        $account = DB::table('accounts')->find($expense_list->account_id);
        
        $lims_expense_category_list = DB::table('expense_categories')->where('is_active', true)->find($expense_list->expense_category_id);

        $warehouse = DB::table('warehouses')->find($expense_list->warehouse_id);



        $expense[] = $expense_list->reference_no;
        $expense[] = $warehouse->name;
        $expense[] = $lims_expense_category_list->name;
        $expense[] = $expense_list->amount;
        $expense[] = $user->name;
        $expense[] = $account->name;
        $expense[] = $expense_list->note;
        return $expense;
    }

    public function edit($id)
    {
        $role = Role::firstOrCreate(['id' => Auth::user()->role_id]);
        if ($role->hasPermissionTo('expenses-edit')) {
            $lims_expense_data = Expense::find($id);
            return $lims_expense_data;
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $lims_expense_data = Expense::find($data['expense_id']);
        $lims_expense_data->update($data);
        return redirect('expenses')->with('message', 'Data updated successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $expense_id = $request['expenseIdArray'];
        foreach ($expense_id as $id) {
            $lims_expense_data = Expense::find($id);
            $lims_expense_data->delete();
        }
        return 'Expense deleted successfully!';
    }

    public function destroy($id)
    {
        $lims_expense_data = Expense::find($id);
        $lims_expense_data->delete();
        return redirect('expenses')->with('not_permitted', 'Data deleted successfully');
    }
}
