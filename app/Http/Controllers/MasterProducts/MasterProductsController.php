<?php

namespace App\Http\Controllers\MasterProducts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MasterProducts;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class MasterProductsController extends Controller
{
    public function masterProductList(){
        $master_product = MasterProducts::select("*")->get();
        return view('master-products/master-product-list',['data'=>$master_product]);
    }

    public function create(Request $request){
        if ($request->isMethod('post')) {            
            $validatedData = $request->validate([
                'title' => 'required|max:20',
                'sub_title' => 'required|max:20'                
            ]);
            $request->request->add(['created_by'=>Auth::id()]);
            MasterProducts::create($request->all());
            $request->session()->flash('success', 'Master Product Added successfully!');
        }
        return view('master-products/create');
    }

    public function update($id=null, Request $request){
        if(!is_null($id))
            $id = Crypt::decrypt($id);
        
        if ($request->isMethod('post')) {            
            $validatedData = $request->validate([
                'title' => 'required|max:20',
                'sub_title' => 'required|max:20'   
            ]);
            $id = $request->input('id');
            $master_product_data = MasterProducts::find($id);
            $master_product_data->title = $request->input('title');
            $master_product_data->sub_title = $request->input('sub_title');
            $master_product_data->save();
            $request->session()->flash('success', 'Master Product Updated successfully!');
        }
        $master_product_data = MasterProducts::find($id);
        
        return view('master-products/update',['data'=>$master_product_data]);
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        $customer = MasterProducts::find($id);
        $res = $customer->delete();
        if($res){
            exit(json_encode(['status'=>'success','msg'=>'Deleted Successfully!']));
        }else{
            exit(json_encode(['status'=>'error','msg'=>'Something unexpected Happened!']));
        }
    }

    public function view($id){
        $id = Crypt::decrypt($id);
        $master_product_data = MasterProducts::find($id);        
        
        return view('master-products/view',['data'=>$master_product_data]);
    }
}
