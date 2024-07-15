<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CustomerPriority;
use PhpParser\Node\Stmt\TryCatch;

class CustomerPriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $lims_priority_all = CustomerPriority::where('is_active', true)->get();
        return view('priority.index', compact('lims_priority_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $data['is_active'] = true;

        try {
            CustomerPriority::create($data);
            $latestCustomerPriority = CustomerPriority::latest()->first();
            //request()->session()->put('customerPriorityModal', $latestCustomerPriority->id);
            $message = 'Priority added successfully';
        } catch (\Exception $e) {
            $message = 'something wrong !';
        }

        if(isset($request->customerAddPriority)){
            return [
                "id"=>$latestCustomerPriority->id,
                "name"=>$latestCustomerPriority->priority,
            ];
        }

        if (isset($request->returntocustomer) && $request->returntocustomer != null) {
            return back();
        } else {
            return redirect('priority')->with('message', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $priority = CustomerPriority::find($id);
        return $priority;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        try {
            $priority = CustomerPriority::find($data['priority_id']);
            $priority->update($data);
            $message = 'Priority updated successfully';
        } catch (\Exception $e) {
            $message = 'something wrong !';
        }
        return redirect('priority')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            CustomerPriority::find($id)->delete();
            $message = 'Priority deleted successfully';
        } catch (\Exception $e) {
            $message = 'something wrong !';
        }
        return redirect()->back()->with('message', $message);
    }
}
