<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sellers;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\CustomersType;

class SellersController extends Controller
{
    public function sellerList(){
        $seller_data = Sellers::select("*")->get();
        return view('sellers/seller-listing',['sellers'=>$seller_data]);
    }

    public function create(Request $request){
        if ($request->isMethod('post')) {            
            $validatedData = $request->validate([
                'first_name' => 'required|max:200',
                'last_name' => 'required|max:200',
                'email' => 'required|email|max:255|unique:sellers',
                'mobile_no' => 'min:10|max:10|unique:sellers',
                'contact_no' => 'min:10|max:20',
                'city' => 'required',
                'state' => 'required',
                'tax_reg_no' => 'required|min:15|integer',
                'address' => 'required|min:0|max:255',
            ]);
            
            $request->request->add(['created_by'=>Auth::id()]);
            $request->customers_type_id = intval($request->customers_type_id);
            Sellers::create($request->all());
            $request->session()->flash('success', 'Seller Added successfully!');
        }
        $customers_type = CustomersType::where(['is_del' => 0])->get();
        return view('sellers/create',compact('customers_type'));
    }
    public function update($id=null, Request $request){
        if(!is_null($id))
            $id = Crypt::decrypt($id);
        
        if ($request->isMethod('post')) {            
            $validatedData = $request->validate([
                'first_name' => 'required|max:50',
                'last_name' => 'required|max:50',
                'email' => 'required|email|max:255',
                'mobile_no' => 'required|min:5|max:20',
                'contact_no' => 'required|min:5|max:20',
                'address' => 'required|min:5|max:255',
            ]);
            $id = $request->input('id');
            $seller_data = Sellers::find($id);
            $seller_data->first_name = $request->input('first_name');
            $seller_data->last_name = $request->input('last_name');
            $seller_data->email = $request->input('email');
            $seller_data->mobile_no = $request->input('mobile_no');
            $seller_data->contact_no = $request->input('contact_no');
            $seller_data->address = $request->input('address');            
            $seller_data->faxno = $request->input('faxno');            
            $seller_data->city = $request->input('city');            
            $seller_data->state = $request->input('state');
            $seller_data->contact_person = $request->input('contact_person');            
            $seller_data->tax_reg_no = $request->input('tax_reg_no');            
            $seller_data->customers_type_id = $request->input('customers_type_id');            
            $seller_data->description = $request->input('description');            
            $seller_data->save();
            $request->session()->flash('success', 'Seller Updated successfully!');
        }
        $seller_data = sellers::find($id);
        $customers_type = CustomersType::where(['is_del' => 0])->get();
        return view('sellers/update',['seller'=>$seller_data,'customers_type' => $customers_type]);
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        $seller = sellers::find($id);
        $res = $seller->delete();
        if($res){
            exit(json_encode(['status'=>'success','msg'=>'Deleted Successfully!']));
        }else{
            exit(json_encode(['status'=>'error','msg'=>'Something unexpected Happened!']));
        }
    }

    public function view($id){
        $id = Crypt::decrypt($id);
        $seller_data = sellers::find($id);        
        
        return view('sellers/view',['seller'=>$seller_data]);
    }

    public function getAjxSellerDetailsById(Request $request) {
        $seller_id = $request->input('seller_id');
        $seller_data = Sellers::where(['id' => $seller_id])->first();
        $ret_data = ['status'=>'error'];
        if($seller_data){
            $ret_data = [
                'status'=>'success', 
                'mobile_no' => $seller_data->mobile_no ?? 'N/A',
                'email' => $seller_data->email ?? 'N/A',
                'contact_person' => $seller_data->contact_person ?? 'N/A'
            ];
        }
        return json_encode($ret_data);
    }
}
