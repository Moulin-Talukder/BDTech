<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product_Sale;
use App\Sale;
use Illuminate\Http\Request;
use App\Customer;
use App\CustomerGroup;
use App\Supplier;
use App\Warehouse;
use App\Biller;
use App\Service;
use App\Product;
use App\Unit;
use App\Tax;
use App\Quotation;
use App\Delivery;
use App\PosSetting;
use App\ServiceQuotation;
use App\ServicesQuotations;
use App\Product_Warehouse;
use App\ProductVariant;
use App\Variant;
use App\Interest;
use App\CustomerPriority;
use App\ServiceCategory;
use DB;
use NumberToWords\NumberToWords;
use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Mail\UserNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ServiceQuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $quotation = ServicesQuotations::whereIn('id',[71])->get();
        // dd($quotation);32qq
        $role = Role::find(Auth::user()->role_id);
        $lims_tax_list = Tax::where('is_active', true)->get();
        if ($role->hasPermissionTo('quotes-index')) {
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if (empty($all_permission))
                $all_permission[] = 'dummy text';

            if (Auth::user()->role_id > 2 && config('staff_access') == 'own') {

                $lims_quotation_all = ServiceQuotation::with('biller', 'customer', 'supplier', 'user')
                    ->orderBy('id', 'desc')
                    ->where('user_id', Auth::id())
                    ->get();
                //dd($lims_quotation_all);
            } else {
                $lims_quotation_all = ServiceQuotation::with('customer', 'supplier', 'user')
                    ->orderBy('id', 'desc')
                    ->get();
                //$sum =
                //dd($lims_quotation_all);
            }
            return view('service_quotation.index', compact('lims_quotation_all', 'all_permission', 'lims_tax_list'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $year = date('Y');
        $serviceModalcategory = request()->session()->get('serviceModalcategory');
        $customerGroupModal = request()->session()->get('customerGroupModal');
        $customerPriorityModal = request()->session()->get('customerPriorityModal');
        $value = ServiceQuotation::count();

        if ($value < 10) {
            $zero = '000';
        } elseif ($value >= 10) {
            $zero = '00';
        } elseif ($value >= 100) {
            $zero = '0';
        } else {
            $zero = '';
        }
        $quotation = $year . $zero . ($value + 1);

        $lims_supplier_list = Supplier::where('is_active', true)->get();
        $lims_warehouse_list = Warehouse::where('is_active', true)->get();
        $lims_tax_list = Tax::where('is_active', true)->get();
        $lims_customer_list = Customer::where('is_active', true)->get();
        $services = Service::where('is_active', true)->get();
        $lims_customer_group_all = CustomerGroup::where('is_active', true)->get();
        $interests = Interest::where('is_active', true)->get();
        $lims_priority_all = CustomerPriority::where('is_active', true)->get();
        $categories = ServiceCategory::where('is_active', true)->pluck('name', 'id');
        $all_categories = ServiceCategory::where('is_active', true)->get();
        $service_categories = ServiceCategory::where('is_active', true)->get();
        return view('service_quotation.create', compact('lims_customer_list', 'lims_supplier_list', 'lims_warehouse_list', 'lims_tax_list', 'services', 'quotation', 'year', 'lims_customer_group_all', 'interests', 'lims_priority_all', 'serviceModalcategory', 'categories', 'all_categories', 'service_categories', 'customerGroupModal', 'customerPriorityModal'));
    }


    public function getServices(Request $request)
    {

        $service_code = explode(" ", $request['data']);

        $service_data = Service::where('code', $service_code[0])->first();
        $service[] = $service_data->name;
        $service[] = $service_data->code;
        $service[] = $service_data->price;

        if ($service_data->tax_id) {
            $tax_data = Tax::find($service_data->tax_id);
            $service[] = $tax_data->rate;
            $service[] = $tax_data->name;
        } else {
            $service[] = 0;
            $service[] = 'No Tax';
        }
        $service[] = $service_data->tax_method;
        $service[] = $service_data->id;
        return $service;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->except('document');

        $data['user_id'] = Auth::id();
        $document = $request->document;
        if ($document) {
            $v = Validator::make(
                [
                    'extension' => strtolower($request->document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:jpg,jpeg,png,gif,pdf,csv,docx,xlsx,txt',
                ]
            );
            if ($v->fails())
                return redirect()->back()->withErrors($v->errors());
            $documentName = $document->getClientOriginalName();
            $document->move('public/sservice_quotation/documents', $documentName);
            $data['document'] = $documentName;
        }
        $data['reference_no'] = 'qr-' . date("Ymd") . '-' . date("his");
        $lims_quotation_data = ServiceQuotation::create($data);

        if ($lims_quotation_data->quotation_status == 2) {
            //collecting mail data
            $lims_customer_data = Customer::find($data['customer_id']);
            $mail_data['email'] = $lims_customer_data->email;
            $mail_data['reference_no'] = $lims_quotation_data->reference_no;
            $mail_data['total_qty'] = $lims_quotation_data->total_qty;
            $mail_data['total_price'] = $lims_quotation_data->total_price;
            $mail_data['order_tax'] = $lims_quotation_data->order_tax;
            $mail_data['order_tax_rate'] = $lims_quotation_data->order_tax_rate;
            $mail_data['order_discount'] = $lims_quotation_data->order_discount;
            $mail_data['shipping_cost'] = $lims_quotation_data->shipping_cost;
            $mail_data['grand_total'] = $lims_quotation_data->grand_total;
        }
        $service_id = $data['service_id'];
        $service_code = $data['service_code'];
        $service_quotation = [];

        foreach ($service_id as $i => $id) {

            $lims_service_data = Service::find($id);

            $mail_data['services'][$i] = $lims_service_data->name;
            $service_quotation['service_quotations_id'] = $lims_quotation_data->id;
            $service_quotation['service_id'] = $id;
            // $service_quotation['qty'] = $mail_data['qty'][$i] = $qty[$i];
            // $service_quotation['net_unit_price'] = $net_unit_price[$i];
            // $service_quotation['discount'] = $discount[$i];
            // $service_quotation['tax_rate'] = $tax_rate[$i];
            // $service_quotation['tax'] = $tax[$i];
            // $service_quotation['total'] = $mail_data['total'][$i] = $total[$i];

            DB::table('services_quotations')->insert($service_quotation);
        }

        return redirect('service_quotations')->with('message', 'Service Receipt added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('quotes-edit')) {
            $lims_customer_list = Customer::where('is_active', true)->get();
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            $lims_biller_list = Biller::where('is_active', true)->get();
            $lims_supplier_list = Supplier::where('is_active', true)->get();
            $lims_tax_list = Tax::where('is_active', true)->get();
            $lims_quotation_data = ServiceQuotation::find($id);
            $services = Service::where('is_active', true)->get();
            $lims_services_quotation_data = DB::table('services_quotations')->where('service_quotations_id', $id)->get();
            $lims_customer_group_all = CustomerGroup::where('is_active', true)->get();
            $interests = Interest::where('is_active', true)->get();
            $lims_priority_all = CustomerPriority::where('is_active', true)->get();
            $categories = ServiceCategory::where('is_active', true)->pluck('name', 'id');
            $all_categories = ServiceCategory::where('is_active', true)->get();
            $service_categories = ServiceCategory::where('is_active', true)->get();
            return view('service_quotation.edit', compact('lims_customer_list', 'lims_warehouse_list', 'lims_biller_list', 'lims_tax_list', 'lims_quotation_data', 'lims_services_quotation_data', 'lims_supplier_list', 'services', 'lims_customer_group_all', 'interests', 'lims_priority_all', 'categories', 'all_categories', 'service_categories'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }


    public function receipt($id)
    {
        $role = Role::find(Auth::user()->role_id);
        if ($role->hasPermissionTo('quotes-edit')) {
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            $lims_biller_list = Biller::where('is_active', true)->get();
            $lims_supplier_list = Supplier::where('is_active', true)->get();
            $lims_tax_list = Tax::where('is_active', true)->get();
            $lims_quotation_data = ServiceQuotation::find($id);
            //dd($lims_quotation_data);
            $lims_customer_list = Customer::where('is_active', true)->where('id', $lims_quotation_data->customer_id)->first();
            //dd($lims_customer_list);
            $lims_services_quotation_data = DB::table('services_quotations')->where('service_quotations_id', $id)->get();
            $ldate = date('d-m-Y');
            $sl_no = date("ymd") . '' . date("his");
            return view('service_quotation.receipt', compact('lims_customer_list', 'lims_warehouse_list', 'lims_biller_list', 'lims_tax_list', 'lims_quotation_data', 'lims_services_quotation_data', 'lims_supplier_list', 'ldate', 'sl_no'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except('document');
        //dd($id);
        $document = $request->document;
        if ($document) {
            $v = Validator::make(
                [
                    'extension' => strtolower($request->document->getClientOriginalExtension()),
                ],
                [
                    'extension' => 'in:jpg,jpeg,png,gif,pdf,csv,docx,xlsx,txt',
                ]
            );
            if ($v->fails())
                return redirect()->back()->withErrors($v->errors());

            $documentName = $document->getClientOriginalName();
            $document->move('public/quotation/documents', $documentName);
            $data['document'] = $documentName;
        }
        $lims_quotation_data = ServiceQuotation::find($id);
        $lims_service_quotation_data = DB::table('services_quotations')->where('service_quotations_id', $id)->get();
        //update quotation table
        $lims_quotation_data->update($data);
        if ($lims_quotation_data->quotation_status == 2) {
            //collecting mail data
            $lims_customer_data = Customer::find($data['customer_id']);
            $mail_data['email'] = $lims_customer_data->email;
            $mail_data['reference_no'] = $lims_quotation_data->reference_no;
            $mail_data['total_qty'] = $data['total_qty'];
            $mail_data['total_price'] = $data['total_price'];
            $mail_data['order_tax'] = $data['order_tax'];
            $mail_data['order_tax_rate'] = $data['order_tax_rate'];
            $mail_data['order_discount'] = $data['order_discount'];
            $mail_data['grand_total'] = $data['grand_total'];
        }
        $service_id = $data['service_id'];
        // $qty = $data['qty'];
        // $net_unit_price = $data['net_unit_price'];
        // $discount = $data['discount'];
        // $tax_rate = $data['tax_rate'];
        // $tax = $data['tax'];
        // $total = $data['subtotal'];

        foreach ($lims_service_quotation_data as $key => $service_quotation_data) {
            $old_service_id[] = $service_quotation_data->service_id;
            $lims_service_data = Service::select('id')->find($service_quotation_data->service_id);
        }

        DB::table('services_quotations')->where('service_quotations_id', $lims_quotation_data->id)->delete();
        foreach ($service_id as $i => $ser_id) {
            //return $service_id[1];
            $mail_data['unit'][$i] = '';
            $input['service_quotations_id'] = $id;
            $input['service_id'] = $ser_id;
            // $input['qty'] = $mail_data['qty'][$i] = $qty[$i];
            // $input['net_unit_price'] = $net_unit_price[$i];
            // $input['discount'] = $discount[$i];
            // $input['tax_rate'] = $tax_rate[$i];
            // $input['tax'] = $tax[$i];
            // $input['total'] = $mail_data['total'][$i] = $total[$i];
            $flag = 1;

            DB::table('services_quotations')->insert($input);


        }

        $message = 'Quotation updated successfully';

        if ($lims_quotation_data->quotation_status == 2 && $mail_data['email']) {
            try {
                Mail::send('mail.quotation_details', $mail_data, function ($message) use ($mail_data) {
                    $message->to($mail_data['email'])->subject('Quotation Details');
                });
            } catch (\Exception $e) {
                $message = 'Quotation updated successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
            }
        }
        return redirect()->route('service_quotations.index')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lims_quotation_data = ServiceQuotation::find($id);
        $lims_service_quotation_data = DB::table('services_quotations')->where('service_quotations_id', $id)->delete();
        // foreach ($lims_service_quotation_data as $service_quotation_data) {
        //     $service_quotation_data->delete();
        // }
        $lims_quotation_data->delete();
        return redirect()->back()->with('not_permitted', 'Quotation deleted successfully');
    }

    public function serviceSum($id)
    {
        $quotations = ServicesQuotations::whereIn('service_quotations_id', [$id])->get();
        $price = [];
        foreach ($quotations as $quotation) {
            $base_price = Service::where('id', $quotation->service_id)->first();
            $price[] = $base_price->price;
        }

        $sum = array_sum($price);
        return $sum;
    }

    public function serviceSale(Request $request)
    {
        //dd($request->input());
        $service_quotation = ServiceQuotation::where('id',$request->service_quotation_id)->first();

        if ($request->saleOption == 2) {
            $service_quotation->sale_status = 2;
            $service_quotation->update();
            return back()->with('message', '
            Sale cancel successfully');
        }
        if ($request->saleOption == 3) {
            $service_quotation->sale_status = 3;
            $service_quotation->update();
            return back()->with('message', '
            Sale Ongoing successfully');
        }

        $reference_no = 'sr-' . date("Ymd") . '-' . date("his");
        $item = $service_quotation->services->count();

        $ser = $service_quotation->services->map(function ($i){
            return $i->service($i->service_id);
        });

        $sale = new Sale();

        $sale->reference_no = $reference_no;
        $sale->user_id = Auth::user()->id;
        $sale->customer_id = $service_quotation->customer_id;
        $sale->warehouse_id = $service_quotation->warehouse_id;
        $sale->item = $item ?? 0;
        $sale->total_qty = $item ?? 0;
        $sale->service_item = utf8_encode(bzcompress(serialize($ser), 9));
        $sale->total_discount = $request->discount ?? 0;
        $sale->total_tax = $request->tax_amount ?? 0;
        $sale->total_price = $request->subtotal ?? 0;
        $sale->order_tax_rate = $request->order_tax_rate ?? 0;
        $sale->order_tax = $request->tax_amount ?? 0;
        $sale->order_discount = $request->discount ?? 0;
        $sale->shipping_cost = $request->shipping_cost ?? 0;
        $sale->commission_rate = $request->commission ?? 0;
        $sale->commission_amount = $request->commission_amount ?? 0;
        $sale->sale_status = $request->sale_status;
        $sale->payment_status = $request->payment_status;
        $sale->sale_note = $request->sale_note;
        $sale->grand_total = $request->grand_total ?? 0;
        $sale->service_quotation_id = $request->service_quotation_id;

        $sale->save();

        $service_quotation->sale_status = 1;
        $service_quotation->update();

        return back()->with('message', '
            Sale completed successfully
        ');
    }

    public function serviceSaleEdit($id)
    {

        $service_sale = Sale::findOrFail($id);

        $serviceQ = ServiceQuotation::where('id',$service_sale->service_quotation_id)->first();
        //dd($serviceQ);
        $cart = unserialize(bzdecompress(utf8_decode($service_sale->service_item)));

        $role = Role::find(Auth::user()->role_id);

        if ($role->hasPermissionTo('sales-edit')) {
            $services = Service::all();

            $lims_customer_list = Customer::where('is_active', true)->get();
            $lims_warehouse_list = Warehouse::where('is_active', true)->get();
            $lims_biller_list = Biller::where('is_active', true)->get();
            $lims_tax_list = Tax::where('is_active', true)->get();
            $lims_sale_data = Sale::find($id);
            $lims_product_sale_data = Product_Sale::where('sale_id', $id)->get();
            $lims_pos_setting_data = PosSetting::latest()->first();
            $lims_customer_group_all = CustomerGroup::where('is_active', true)->get();
            $interests = Interest::where('is_active', true)->get();
            $lims_priority_all = CustomerPriority::where('is_active', true)->get();
            $lims_categories = Category::where('is_active', true)->pluck('name', 'id');
            $lims_category_all = Category::where('is_active', true)->get();
            $lims_product_list = Product::where([['is_active', true], ['type', 'standard']])->get();
            $lims_brand_list = Brand::where('is_active', true)->get();
            $lims_category_list = Category::where('is_active', true)->get();
            $lims_unit_list = Unit::where('is_active', true)->get();
            $lims_product_list_without_variant = '';
            $lims_product_list_with_variant = '';

            return view('service_quotation.service_sale_edit', compact('lims_customer_list', 'lims_warehouse_list', 'lims_biller_list',
                'lims_tax_list', 'lims_sale_data', 'lims_product_sale_data',
                'lims_pos_setting_data', 'lims_customer_group_all', 'interests',
                'lims_priority_all', 'lims_categories', 'lims_category_all',
                'lims_product_list', 'lims_brand_list', 'lims_category_list',
                'lims_unit_list', 'lims_product_list_without_variant',
                'lims_product_list_with_variant','services','serviceQ','service_sale',
                'cart'));
        } else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function serviceSaleUpdate(Request $request, $id){
        //dd($request->input());
        $ser_arr = [];
        foreach ($request->service_id as $service_id){
            $ser = Service::where('id',$service_id)->first();
            $ser_arr[] = $ser;
        }

        $sale = Sale::findOrFail($id);

        $sale->customer_id = $request->customer_id;
        $sale->warehouse_id = $request->warehouse_id;
        $sale->item = count($request->service_id) ?? 0;
        $sale->total_qty = count($request->service_id) ?? 0;
        $sale->service_item = utf8_encode(bzcompress(serialize($ser_arr), 9));
        $sale->total_discount = $request->order_discount ?? 0;
        $sale->total_tax = $request->tax_amount ?? 0;
        $sale->total_price = $request->subtotal_amount ?? 0;
        $sale->order_tax_rate = $request->order_tax_rate ?? 0;
        $sale->order_tax = $request->tax_amount ?? 0;
        $sale->order_discount = $request->order_discount ?? 0;
        $sale->shipping_cost = $request->shipping_cost ?? 0;
        $sale->commission_rate = $request->commission_rate ?? 0;
        $sale->commission_amount = $request->commission_amount ?? 0;
        $sale->sale_status = $request->sale_status;
        $sale->payment_status = $request->payment_status;
        $sale->sale_note = $request->sale_note;
        $sale->grand_total = $request->grandtotal_amount ?? 0;

        $sale->update();

        return redirect()->route('sales.index')->with('message','Updated successfully');
    }

}
