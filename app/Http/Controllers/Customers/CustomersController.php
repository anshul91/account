<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\CustomersType;

class CustomersController extends Controller
{
    public function customerList(){
        $customer_data = Customers::select("*")->get();
        return view('customers/customer-listing',['customers'=>$customer_data]);
    }

    public function create(Request $request){
        if ($request->isMethod('post')) {            
            $validatedData = $request->validate([
                'first_name' => 'required|max:200',
                'last_name' => 'required|max:200',
                'company_name' => 'required|max:200',
                'email' => 'required|email|max:255|unique:customers',
                'mobile_no' => 'min:10|max:10|unique:customers',
                'contact_no' => 'min:10|max:20',
                'city' => 'required',
                'state' => 'required',
                'tax_reg_no' => 'required|min:15|integer',
                'address' => 'required|min:0|max:255',
            ]);
            
            $request->request->add(['created_by'=>Auth::id()]);
            $request->customers_type_id = intval($request->customers_type_id);
            Customers::create($request->all());
            $request->session()->flash('success', 'Customer Added successfully!');
        }
        $customers_type = CustomersType::where(['is_del' => 0])->get();
        return view('customers/create',compact('customers_type'));
    }
    public function update($id=null, Request $request){
        if(!is_null($id))
            $id = Crypt::decrypt($id);
        
        if ($request->isMethod('post')) {            
            $validatedData = $request->validate([
                'first_name' => 'required|max:50',
                'last_name' => 'required|max:50',
                'company_name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'mobile_no' => 'required|min:5|max:30',
                'contact_no' => 'required|min:5|max:30',
                'address' => 'required|min:5|max:255',
            ]);
            $id = $request->input('id');
            $customer_data = Customers::find($id);
            $customer_data->first_name = $request->input('first_name');
            $customer_data->last_name = $request->input('last_name');
            $customer_data->company_name = $request->input('company_name');
            $customer_data->email = $request->input('email');
            $customer_data->mobile_no = $request->input('mobile_no');
            $customer_data->contact_no = $request->input('contact_no');
            $customer_data->address = $request->input('address');            
            $customer_data->faxno = $request->input('faxno');            
            $customer_data->city = $request->input('city');            
            $customer_data->state = $request->input('state');
            $customer_data->contact_person = $request->input('contact_person');            
            $customer_data->tax_reg_no = $request->input('tax_reg_no');            
            $customer_data->customers_type_id = $request->input('customers_type_id');            
            $customer_data->description = $request->input('description');            
            $customer_data->save();
            $request->session()->flash('success', 'Customer Updated successfully!');
        }
        $customer_data = Customers::find($id);
        $customers_type = CustomersType::where(['is_del' => 0])->get();
        return view('customers/update',['customer'=>$customer_data,'customers_type' => $customers_type]);
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        $customer = Customers::find($id);
        $res = $customer->delete();
        if($res){
            exit(json_encode(['status'=>'success','msg'=>'Deleted Successfully!']));
        }else{
            exit(json_encode(['status'=>'error','msg'=>'Something unexpected Happened!']));
        }
    }

    public function view($id){
        $id = Crypt::decrypt($id);
        $customer_data = Customers::find($id);        
        
        return view('customers/view',['customer'=>$customer_data]);
    }
}
