<?php

namespace App\Http\Controllers\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Products;
use App\MasterProducts;
use App\Units;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function productList(){
        $products = Products::select("*")->with(['Units','master_products'])->get();
        
        return view('products/product-list',['data'=>$products]);
    }

    public function create(Request $request){
        if ($request->isMethod('post')) {            
            $validatedData = $request->validate([
                'master_product_id' => 'required|integer',
                'unit_id' => 'required|integer',
                'is_dimension' => 'required|integer',
                'title' =>  'required|max:50',
                'sub_title' =>  'required|max:60',
                'description' => 'required|max:200',
                'stock_in_hand' => 'required|numeric|min:0',
                'final_product' => 'required'
            ]);
            $request->request->add(['created_by'=>Auth::id()]);
            Products::create($request->all());
            $request->session()->flash('success', 'Product Added successfully!');
        }
        $master_product = MasterProducts::all();
        $unit_data = Units::all();
        
        return view('products/create',[
                    'master_product' => $master_product,
                    'unit_data' => $unit_data,
                ]);
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
