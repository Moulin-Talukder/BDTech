<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerGroup;
use App\Customer;
use App\Deposit;
use App\Account;
use App\User;
use App\Comment;
use App\Interest;
use App\Reminder;
use App\CustomerPriority;
use App\ServiceQuotation;
use Illuminate\Validation\Rule;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Mail\UserNotification;
use Complex\Exception;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('customers-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if (empty($all_permission))
                $all_permission[] = 'dummy text';
            $lims_customer_all = Customer::where('is_active', true)->get();
            $interests_list = Interest::where('is_active', true)->get();
            $lims_customer_group_all = CustomerGroup::where('is_active', true)->get();
            $lims_priority_all = CustomerPriority::where('is_active', true)->get();

            return view('customer.index', compact('lims_customer_all', 'all_permission', 'interests_list', 'lims_customer_group_all', 'lims_priority_all'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function create()
    {
        $customerGroupModal = request()->session()->get('customerGroupModal');
        $customerPriorityModal = request()->session()->get('customerPriorityModal');
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('customers-add')) {
            $lims_customer_group_all = CustomerGroup::where('is_active', true)->get();
            $interests = Interest::where('is_active', true)->get();
            $lims_priority_all = CustomerPriority::where('is_active', true)->get();
            return view('customer.create', compact('lims_customer_group_all', 'interests', 'lims_priority_all', 'customerGroupModal', 'customerPriorityModal'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function store(Request $request)
    {
        //return $request->all();
        $this->validate($request, [
            'phone_number' => [
                'max:255',
                Rule::unique('customers')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
        ]);
        $lims_customer_data = $request->all();
        //dd($lims_customer_data);
        $lims_customer_data['contract_person'] = json_encode($request->contract_person);
        $lims_customer_data['contract_phone'] = json_encode($request->contract_phone);


        //image
        if ($request->file('image') && $request->image !== null) {
            $image = $request->image;
            if ($image) {
                $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
                $imageName = preg_replace('/[^a-zA-Z0-9]/', '', uniqid());
                $imageName = $imageName . '.' . $ext;
                $image->move('public/images/customer', $imageName);
                $lims_customer_data['image'] = $imageName;
            }
        }

        $lims_customer_data['is_active'] = true;
        //creating user if given user access
        if (isset($lims_customer_data['user'])) {
            $this->validate($request, [
                'name' => [
                    'max:255',
                    Rule::unique('users')->where(function ($query) {
                        return $query->where('is_deleted', false);
                    }),
                ],
                'email' => [
                    'email',
                    'max:255',
                    Rule::unique('users')->where(function ($query) {
                        return $query->where('is_deleted', false);
                    }),
                ],
            ]);

            $lims_customer_data['phone'] = $lims_customer_data['phone_number'];
            $lims_customer_data['role_id'] = 5;
            $lims_customer_data['is_deleted'] = false;
            $lims_customer_data['password'] = bcrypt($lims_customer_data['password']);
            $user = User::create($lims_customer_data);
            $lims_customer_data['user_id'] = $user->id;
            $message = 'Customer and user created successfully';
        } else {
            $message = 'Customer created successfully';
        }

        // $lims_customer_data['name'] = $lims_customer_data['customer_name'];

        if ($lims_customer_data['email']) {
            try {
                Mail::send('mail.customer_create', $lims_customer_data, function ($message) use ($lims_customer_data) {
                    $message->to($lims_customer_data['email'])->subject('New Customer');
                });
            } catch (\Exception $e) {
                $message = 'Customer created successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
            }
        }
        $lims_customer_data['company_name'] = $request->company_name;

        Customer::create($lims_customer_data);

        $latestCustomer = Customer::latest()->first();
        request()->session()->put('saleModalcategory', $latestCustomer->id);
        request()->session()->forget('saleModalcategory');

        if(isset($request->customerAdd)){
            return [
                "id"=>$latestCustomer->id,
                "name"=>$latestCustomer->company_name,
            ];
        }

        if (isset($request->returntosale) && $request->returntosale != null) {
            return back()->with('message', $message);
        } elseif ($lims_customer_data['pos']) {
            return redirect('pos')->with('message', $message);
        } elseif (isset($request->returntoservicesale) && $request->returntoservicesale != null) {
            return back()->with('message', $message);
        } elseif (isset($request->returntoservicereceipt) && $request->returntoservicereceipt != null) {
            return back()->with('message', $message);
        } else
            return redirect('customer')->with('create_message', $message);
    }

    public function edit($id)
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('customers-edit')) {
            $lims_customer_data = Customer::find($id);
            $lims_customer_group_all = CustomerGroup::where('is_active', true)->get();
            $interests = Interest::where('is_active', true)->get();
            $lims_priority_all = CustomerPriority::where('is_active', true)->get();
            return view('customer.edit', compact('lims_customer_data', 'lims_customer_group_all', 'lims_priority_all', 'interests'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'phone_number' => [
                'max:255',
                Rule::unique('customers')->ignore($id)->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
        ]);

        $input = $request->except('image');
        $lims_customer_data = Customer::find($id);
        $input['contract_person'] = json_encode($request->contract_person);
        $input['contract_phone'] = json_encode($request->contract_phone);


        $image = $request->image;
        if ($image) {
            $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
            $imageName = preg_replace('/[^a-zA-Z0-9]/', '', uniqid());
            $imageName = $imageName . '.' . $ext;
            $image->move('public/images/customer', $imageName);
            $input['image'] = $imageName;
        }


        if (isset($input['user'])) {
            $this->validate($request, [
                'name' => [
                    'max:255',
                    Rule::unique('users')->where(function ($query) {
                        return $query->where('is_deleted', false);
                    }),
                ],
                'email' => [
                    'email',
                    'max:255',
                    Rule::unique('users')->where(function ($query) {
                        return $query->where('is_deleted', false);
                    }),
                ],
            ]);

            $input['phone'] = $input['phone_number'];
            $input['role_id'] = 5;
            $input['is_active'] = true;
            $input['is_deleted'] = false;
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $input['user_id'] = $user->id;
            $message = 'Customer updated and user created successfully';
        } else {
            $message = 'Customer updated successfully';
        }

        $input['name'] = $request->company_name;
        $lims_customer_data->update($input);
        return redirect('customer')->with('edit_message', $message);
    }

    public function show($id)
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('customers-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if (empty($all_permission))
                $all_permission[] = 'dummy text';

            $customer = Customer::find($id);
            //dd($customer);
            $lims_account_list = Account::where('is_active', true)->get();
            return view('customer.show', compact('customer', 'all_permission', 'lims_account_list'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function print($id)
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('customers-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if (empty($all_permission))
                $all_permission[] = 'dummy text';

            $customer = Customer::find($id);
            $lims_account_list = Account::where('is_active', true)->get();
            return view('customer.print', compact('customer', 'all_permission', 'lims_account_list'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function importCustomer(Request $request)
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('customers-add')) {
            $upload = $request->file('file');
            $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
            if ($ext != 'csv')
                return redirect()->back()->with('not_permitted', 'Please upload a CSV file');
            $filename =  $upload->getClientOriginalName();
            $filePath = $upload->getRealPath();
            //open and read
            $file = fopen($filePath, 'r');
            $header = fgetcsv($file);
            $escapedHeader = [];
            //validate
            foreach ($header as $key => $value) {
                $lheader = strtolower($value);
                $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
                array_push($escapedHeader, $escapedItem);
            }
            //looping through othe columns
            while ($columns = fgetcsv($file)) {
                if ($columns[0] == "")
                    continue;
                foreach ($columns as $key => $value) {
                    $value = preg_replace('/\D/', '', $value);
                }
                $data = array_combine($escapedHeader, $columns);
                $lims_customer_group_data = CustomerGroup::where('name', $data['customergroup'])->first();
                $lims_customer_priority_data = CustomerPriority::where('priority', $data['priority'])->first();
                $lims_interest_data = Interest::where('topic', $data['interest'])->first();

                $customer = Customer::firstOrNew(['company_name' => $data['companyname']]);
                $customer->customer_group_id = $lims_customer_group_data->id;
                $customer->priority_id = $lims_customer_priority_data->id;
                if($lims_interest_data){
                    $customer->interest_id = $lims_interest_data->id;
                }else{
                    $customer->interest_id = null;
                }
                
                //$customer->name = $data['companyname'];
                $customer->company_name = $data['companyname'];
                $customer->email = $data['email'];
                $customer->phone_number = $data['phonenumber'];
                $customer->factory_address = $data['factoryaddress'];
                $customer->head_office_address = $data['headofficeaddress'];
                $customer->is_active = true;
                $customer->save();
                $message = 'Customer Imported Successfully';
                if ($data['email']) {
                    try {
                        Mail::send('mail.customer_create', $data, function ($message) use ($data) {
                            $message->to($data['email'])->subject('New Customer');
                        });
                    } catch (\Exception $e) {
                        $message = 'Customer imported successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
                    }
                }
            }
            return redirect('customer')->with('import_message', $message);
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function getDeposit($id)
    {
        $lims_deposit_list = Deposit::where('customer_id', $id)->get();
        $deposit_id = [];
        $deposits = [];
        foreach ($lims_deposit_list as $deposit) {
            $deposit_id[] = $deposit->id;
            $date[] = $deposit->created_at->toDateString() . ' ' . $deposit->created_at->toTimeString();
            $amount[] = $deposit->amount;
            $note[] = $deposit->note;
            $lims_user_data = User::find($deposit->user_id);
            $name[] = $lims_user_data->name;
            $email[] = $lims_user_data->email;
        }
        if (!empty($deposit_id)) {
            $deposits[] = $deposit_id;
            $deposits[] = $date;
            $deposits[] = $amount;
            $deposits[] = $note;
            $deposits[] = $name;
            $deposits[] = $email;
        }
        return $deposits;
    }

    public function addDeposit(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $lims_customer_data = Customer::find($data['customer_id']);
        $lims_customer_data->deposit += $data['amount'];
        $lims_customer_data->save();
        Deposit::create($data);
        $message = 'Data inserted successfully';
        if ($lims_customer_data->email) {
            $data['name'] = $lims_customer_data->name;
            $data['email'] = $lims_customer_data->email;
            $data['balance'] = $lims_customer_data->deposit - $lims_customer_data->expense;
            try {
                Mail::send('mail.customer_deposit', $data, function ($message) use ($data) {
                    $message->to($data['email'])->subject('Recharge Info');
                });
            } catch (\Exception $e) {
                $message = 'Data inserted successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
            }
        }
        return redirect('customer')->with('create_message', $message);
    }

    public function updateDeposit(Request $request)
    {
        $data = $request->all();
        $lims_deposit_data = Deposit::find($data['deposit_id']);
        $lims_customer_data = Customer::find($lims_deposit_data->customer_id);
        $amount_dif = $data['amount'] - $lims_deposit_data->amount;
        $lims_customer_data->deposit += $amount_dif;
        $lims_customer_data->save();
        $lims_deposit_data->update($data);
        return redirect('customer')->with('create_message', 'Data updated successfully');
    }

    public function deleteDeposit(Request $request)
    {
        $data = $request->all();
        $lims_deposit_data = Deposit::find($data['id']);
        $lims_customer_data = Customer::find($lims_deposit_data->customer_id);
        $lims_customer_data->deposit -= $lims_deposit_data->amount;
        $lims_customer_data->save();
        $lims_deposit_data->delete();
        return redirect('customer')->with('not_permitted', 'Data deleted successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $customer_id = $request['customerIdArray'];
        foreach ($customer_id as $id) {
            $lims_customer_data = Customer::find($id);
            $lims_customer_data->is_active = false;
            $lims_customer_data->save();
        }
        return 'Customer deleted successfully!';
    }

    public function addReminder(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|integer',
            'topic' => 'string|required|max:100',
            'note' => 'string|nullable|max:255',
            'date' => 'date|required',
            'time' => 'required'
        ], [
            'customer_id.required' => 'Please select customer'
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['status'] = true;
        $data['is_active'] = true;
        try {
            $reminder = Reminder::create($data);
            $message = 'Reminder added successfully';
        } catch (\Exception $e) {
            $message = 'something wrong !';
        }
        return redirect('customer')->with('create_message', $message);
    }

    public function destroy($id)
    {
        $lims_customer_data = Customer::find($id);
        ServiceQuotation::where('customer_id', $id)->delete();
        $lims_user_data = User::where('id', $lims_customer_data->user_id)->first();
        //dd($lims_user_data);
        if ($lims_user_data) {
            $lims_customer_data->is_active = false;
            $lims_user_data->is_active = false;
            $lims_customer_data->save();
            $lims_user_data->save();
        }
        $lims_customer_data->is_active = false;
        $lims_customer_data->save();

        return redirect('customer')->with('not_permitted', 'Data deleted Successfully');
    }

    public function getCustomer($id)
    {
        $customer = Customer::where('id', $id)
            ->select('name')->first();
        return $customer;
    }
    public function addComment(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required|integer',
            'topic' => 'string|required',
            'details' => 'string|required',
        ], [
            'customer_id.required' => 'Please select customer',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['status'] = true;
        try {
            Comment::create($data);
            $message = 'Comment added successfully';
        } catch (\Exception $e) {
            $message = "Something error found";
        }
        return redirect('customer')->with('create_message', $message);
    }

    public function filterCustomerGet()
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('customers-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if (empty($all_permission))
                $all_permission[] = 'dummy text';
            $lims_customer_all = Customer::where('is_active', true)->get();
            $interests_list = Interest::where('is_active', true)->get();
            $lims_customer_group_all = CustomerGroup::where('is_active', true)->get();
            $lims_priority_all = CustomerPriority::where('is_active', true)->get();

            return view('customer.index', compact('lims_customer_all', 'all_permission', 'interests_list', 'lims_customer_group_all', 'lims_priority_all'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function filterCustomer(Request $request)
    {
        //return $request->all();
        $start = ' 00:00:00';
        $end = ' 23:59:59';
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $interest_id = $request->interest_id;
        $customer_group_id = $request->group_id;
        $priority_id = $request->priority_id;
        //dd($interest_id);

        if ($interest_id == 0 && $customer_group_id == 0 && $priority_id == 0 && ($start_date == null && $start_date == null)) {
            return redirect()->back()->with('not_permitted', 'Please select filtering criteria');
        }

        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('customers-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if (empty($all_permission))
                $all_permission[] = 'dummy text';

            $lims_customer_all = Customer::where(function ($query) use ($interest_id, $customer_group_id, $priority_id, $start_date, $end_date, $start, $end) {
                if ($interest_id != 0 && $customer_group_id != 0 && $priority_id != 0 && $start_date != null && $end_date != null) {
                    return $query->where('interest_id', $interest_id)
                        ->where('customer_group_id', $customer_group_id)
                        ->where('priority_id', $priority_id)
                        ->whereBetween('created_at', [$start_date . $start, $end_date . $end]);
                } elseif ($interest_id != 0 && $customer_group_id != 0 && $priority_id != 0) {
                    return $query->where('interest_id', $interest_id)
                        ->where('customer_group_id', $customer_group_id)
                        ->where('priority_id', $priority_id);
                } elseif ($interest_id != 0 && $priority_id != 0 && $start_date != null && $end_date != null) {
                    return $query->where('interest_id', $interest_id)
                        ->where('priority_id', $priority_id)
                        ->whereBetween('created_at', [$start_date . $start, $end_date . $end]);
                } elseif ($customer_group_id != 0 && $priority_id != 0 && $start_date != null && $end_date != null) {
                    return $query->where('customer_group_id', $customer_group_id)
                        ->where('priority_id', $priority_id)
                        ->whereBetween('created_at', [$start_date . $start, $end_date . $end]);
                } elseif ($interest_id != 0 && $customer_group_id != 0) {
                    return $query->where('interest_id', $interest_id)
                        ->where('customer_group_id', $customer_group_id);
                } elseif ($interest_id != 0 && $priority_id != 0) {
                    return $query->where('interest_id', $interest_id)
                        ->where('priority_id', $priority_id);
                } elseif ($interest_id != 0 && $start_date != null && $end_date != null) {
                    return $query->where('interest_id', $interest_id)
                        ->whereBetween('created_at', [$start_date . $start, $end_date . $end]);
                } elseif ($customer_group_id != 0 && $priority_id != 0) {
                    return $query->where('customer_group_id', $customer_group_id)
                        ->where('priority_id', $priority_id);
                } elseif ($customer_group_id != 0 && $start_date != null && $end_date != null) {
                    return $query->where('customer_group_id', $customer_group_id)
                        ->whereBetween('created_at', [$start_date . $start, $end_date . $end]);
                } elseif ($priority_id != 0 && $start_date != null && $end_date != null) {
                    return $query->where('priority_id', $priority_id)
                        ->whereBetween('created_at', [$start_date . $start, $end_date . $end]);
                } elseif ($start_date != null && $end_date != null) {
                    return $query->whereBetween('created_at', [$start_date . $start, $end_date . $end]);
                } elseif ($interest_id != 0) {
                    return $query->where('interest_id', $interest_id);
                } elseif ($customer_group_id != 0) {
                    return $query->where('customer_group_id', $customer_group_id);
                } elseif ($priority_id != 0) {
                    return $query->where('priority_id', $priority_id);
                }
            })->where('is_active', true)->get();
            $interests_list = Interest::where('is_active', true)->get();
            $lims_customer_group_all = CustomerGroup::where('is_active', true)->get();
            $lims_priority_all = CustomerPriority::where('is_active', true)->get();
            return view('customer.index', compact('lims_customer_all', 'all_permission', 'interests_list', 'interest_id', 'start_date', 'end_date', 'lims_customer_group_all', 'customer_group_id', 'lims_priority_all', 'priority_id'));
        } else {
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
        }
    }
}
