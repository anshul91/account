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
                'title' =>  'required|max:50',
                'sub_title' =>  'required|max:60',
                'description' => 'max:200',
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
        
        if(!is_null($id)){
            $id = Crypt::decrypt($id);
            $request->request->add(['id'=>$id]);
        }
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'id' => 'required|integer',
                'master_product_id' => 'required|integer',
                'unit_id' => 'required|integer', 
                'title' => 'required|max:100',
                'sub_title' => 'required|max:100'   
            ]);
            $product_data = Products::find($id);
            $product_data->master_product_id = $request->input('master_product_id');
            $product_data->unit_id = $request->input('unit_id');
            $product_data->title = $request->input('title');
            $product_data->sub_title = $request->input('sub_title');
            $product_data->description = $request->input('description');
            $product_data->save();
            $request->session()->flash('success', 'Product Updated successfully!');
        }
        $product_data = Products::find($id);
        $master_product_data = MasterProducts::select(['id','title'])
                ->where(['id' => $product_data->master_product_id])
                ->get();
        $unit_data = Units::all();

        return view('products/update',[
            'product_data' => $product_data, 
            'master_product' => $master_product_data,
            'unit_data' => $unit_data
            ]);
    }

    public function destroy(Request $request){
        try{
            $id = $request->input('id');
            $product = Products::find($id);
            $res = $product->delete();
            if($res){
                exit(json_encode(['status'=>'success','msg'=>'Deleted Successfully!']));
            }else{
                exit(json_encode(['status'=>'error','msg'=>'Something unexpected Happened!']));
            }
        } catch (\Illuminate\Database\QueryException $e) {
            exit(json_encode(['status'=>'error','msg'=>'This product is used in one of the purchase or sales so cannot be deleted.']));
        } catch(Exception $e) {
            exit(json_encode(['status'=>'error','msg'=>'Something unexpected Happened!'.$e]));
        }
    }

    public function view($id){
        $id = Crypt::decrypt($id);
        
        $product_data = Products::find($id);
        $master_product_data = MasterProducts::select(['id','title'])
                ->where(['id' => $product_data->master_product_id])
                ->get();
        $unit_data = Units::all();
        return view('products/view',[
            'product_data' => $product_data, 
            'master_product' => $master_product_data,
            'unit_data' => $unit_data
            ]);
    }
}
