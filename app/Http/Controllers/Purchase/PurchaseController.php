<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Purchase;
use App\Products;
use App\Sellers;
use App\MasterProducts;
use Config;

class PurchaseController extends Controller
{

    /**purpose : TO show all purchases done
     * @created by : Anshul pareek
     * @created at : 11-April-2020 
     */
    public function purchaseList() {
        $purchases = Purchase::select("*")->with(['sellers'])->get();        
        return view('purchase/purchase-list',compact('purchases'));
    }

    /**@purpose: TO add new purchase
     * @created by : Anshul Pareek
     * @created at: 11-April-2020
     */
    public function create() {
        $master_product = MasterProducts::select("*")->get();
        $sellers = Sellers::select("*")->get();
        return view('purchase/create',compact('master_product', 'sellers'));
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
}
