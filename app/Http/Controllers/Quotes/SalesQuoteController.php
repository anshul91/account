<?php

namespace App\Http\Controllers\quotes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Products;
use App\StockDetails;
use App\Sellers;
use App\MasterProducts;
use Config;
use DB;
use Auth;
use Crypt;
use App\Quotes;

class SalesQuoteController extends Controller
{

    /**purpose : TO show all purchases done
     * @created by : Anshul pareek
     * @created at : 11-April-2020 
     */
    public function quoteList() {
        $quotes = Quotes::select("*")
                    ->with(['quoteDetails'])
                    ->get();        
        return view('quotes/sales-quote-list',compact('quotes'));
    }

    /**@purpose: TO add new purchase
     * @created by : Anshul Pareek
     * @created at: 11-April-2020
     */
    public function create() {
        $master_product = MasterProducts::select("*")->get();
        $sellers = Sellers::select("*")->get();
        return view('quotes/create',compact('master_product', 'sellers'));
    }

    public function getProdOptByMasterid(Request $request){
        $master_product_id = $request->input('master_product_id');
        $purchase_product_data = Products::with(['unit','stock_details'])
        ->where(['master_product_id' => $master_product_id])
        ->get();
        $html = '';
        $html .= '
            <option value="">--Select Master Product--</option>';
        if($purchase_product_data->count()) {
            foreach($purchase_product_data as $k => $row) {
                $html.=" <option value=".$row->id.">".$row->title."</option>";
            }
        }
        return json_encode(['html'=>$html]);
    }

    public function getUnitByProductId(Request $request) {
        $unit_type = Products::with(['unit'])
            ->where(['id' => $request->input('product_id')])
            ->first();
        $ret_data = ['unit_type' => '', 'status' => 'error'];
        if(!is_null($unit_type) && !empty($unit_type->unit->type)){
            $measurement_unit = Config::get('constants.measurement_unit');
            $ret_data = [
                'unit_type' => $measurement_unit[$unit_type->unit->type], 
                'status' => 'success'];
        }
        return json_encode($ret_data);
    }

    /*********************************************************************************
     * **********************FUNCTIONS BELOW WILL USED TO PURCHASE GOODS**************
     *********************************************************************************/
    public function purchaseGoods(Request $request) {
        DB::beginTransaction();
        try{
            $request_all = $request->all();
            if ($request->isMethod('post')) {
                $validatedData = $request->validate([
                    'seller_id' => 'required|integer',
                    'master_product_id.*' => 'required|integer',
                    'product_id.*' => 'required|integer',
                    // 'unit_id.*' => 'required|integer',
                    'length.*' => 'required|numeric|min:1',
                    'width.*' => 'required|numeric|min:1',
                    'quantity.*' => 'required|numeric|min:1',
                    'price.*' => 'required|numeric|min:1'
                ]
            );
                $response = [];
                $user_id = Auth::id();
                $purchase_rec = [
                    'seller_id' => $request_all['seller_id'],
                    'purchase_date' => date('Y-m-d'),
                    'created_at' => date('Y-m-d'),
                    'created_by' => $user_id
                ];
                $purchase_id = DB::table('purchase')->insertGetId($purchase_rec);
                $req_arr[] = $request_all;
                
                //updating purchase details table
                $purchase_detail_status = $this->savePurchaseDetails($purchase_id, $user_id, $req_arr);
                
                //updating or adding data into stock table
                $stock_add_update = $this->stockUpdateOrAdd($user_id, $req_arr);

                /**wILL REturn response if everyting is fine */
                if($purchase_detail_status && $stock_add_update){
                    $response = ['status'=>'success','resp'=>'Stock Purchased successfully!'];
                    DB::commit();
                }
            return json_encode($response);
            }
        } catch(Exception $e) {
            DB::rollback();
            Log::error("error occured:".$e.getMessage());
        }
    }

    public function savePurchaseDetails($purchase_id, $user_id, $req_arr){
        
        if(!empty($req_arr[0]['master_product_id'])){
            foreach($req_arr[0]['master_product_id'] as $k => $req_data) {

            $product_data = Products::where(['id' => $req_arr[0]['product_id'][$k]])
                ->select('unit_id')->first();
                $stock_details[] = [
                    'master_product_id' => $req_data,
                    'purchase_id' => $purchase_id,
                    'product_id' => $req_arr[0]['product_id'][$k],
                    'length' => $req_arr[0]['length'][$k],
                    'width' => $req_arr[0]['width'][$k],
                    'unit_id' => $product_data->unit_id ?? 0,
                    'quantity' => $req_arr[0]['quantity'][$k],
                    'price' => $req_arr[0]['price'][$k],
                    'created_by' => $user_id,
                    'created_at' => date('Y-m-d')
                ];
            }
            return DB::table('purchase_details')->insert($stock_details);
        }
        return false;
        
    }

    public function stockUpdateOrAdd($user_id, $req_arr) {
        $req_arr = $req_arr[0];
        if(!empty($req_arr['master_product_id'])) {
            foreach($req_arr['master_product_id'] as $k => $req_data) {

                $product_data = Products::where(['id' => $req_arr['product_id'][$k]])
                    ->select('unit_id')->first();
                $stock = StockDetails::checkStockExistsByProductId($req_arr['product_id'][$k]);
                /**Calculating remaining quantity adding with we have and now purchased */
                $we_have_qty = $we_have_length = $we_have_width = 0;
                /**If we have stock already then add with new one*/
                
                if(!is_null($stock)) {
                    $is_update = TRUE;
                    $we_have_qty = $stock->remaining_qty ?? 0;
                    $we_have_length = $stock->length ?? 0;
                    $we_have_width = $stock->length ?? 0;
                } else {
                    $is_update = FALSE;
                }
                /**Calculating final stock or length/width */
                $remaining_length = $we_have_length + $req_arr['length'][$k];
                $remaining_width = $we_have_width + $req_arr['width'][$k];
                $remaining_qty = $we_have_qty + $req_arr['quantity'][$k];
                $product_id = $req_arr['product_id'][$k];
                $stock_data = [
                    'product_id' => $product_id,
                    'length' => $remaining_length,
                    'unit_id' => $product_data->unit_id,
                    'width' => $remaining_width,
                    'remaining_qty' => $remaining_qty,
                    'created_at' => date('Y-m-d')
                ];
                if($is_update) {
                    DB::table('stock_details')
                    ->where(['product_id' => $product_id])
                    ->update($stock_data);
                } else {
                    DB::table('stock_details')
                    ->insert($stock_data);
                }
            }
            return true;
        }
        return false;
    }

    /**
     * @Purpose: This function will soft delete purchase
     * @created by : Anshul Pareek
     * @created at: 17-May-2020
     */
    public function destroy(Request $request){
        try {
            $id = $request->input('id');
            $res = Purchase::where(['id'=>$id])->delete();
            if($res){
                exit(json_encode(['status'=>'success','msg'=>'Deleted Successfully!']));
            }else{
                exit(json_encode(['status'=>'error','msg'=>'Something unexpected Happened!']));
            }
        } catch (\Illuminate\Database\QueryException $e) {
            exit(json_encode(['status'=>'error','msg'=>'This purchase cannot be deleted now.']));
        } catch(Exception $e) {
            exit(json_encode(['status'=>'error','msg'=>'Something unexpected Happened!'.$e]));
        }
    }
    /********************************************************************************************
     ************************************UPDATE OF PURCHASE OR VIEW******************************
     ********************************************************************************************/

    public function view($id){
        $id = Crypt::decrypt($id);
        
        $product_data = Purchase::with('purchaseDetails','sellers')->find($id);
        return view('purchase/view',[
            'product_data' => $product_data, 
            // 'master_product' => $master_product_data,
            // 'unit_data' => $unit_data
            ]);
    }
}
