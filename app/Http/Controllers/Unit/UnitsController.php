<?php

namespace App\Http\Controllers\Unit;

use App\Units;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class UnitsController extends Controller
{
    public function unitList(){       
        $unit_data = Units::select("*")->get();
        return view('units/unit-list',['unit_data'=>$unit_data]);
    
    }

    public function create(Request $request){
        if ($request->isMethod('post')) {            
            $validatedData = $request->validate([
                'name' => 'required|max:20|unique:units',
                'type' => 'required|max:20',
                'description' => 'required|max:255',
            ]);
            $request->request->add(['created_by'=>Auth::id()]);
            Units::create($request->all());
            $request->session()->flash('success', 'Unit Added successfully!');
        }
        return view('units/create');
    }

    public function update($id=null, Request $request){
        if(!is_null($id))
            $id = Crypt::decrypt($id);
        
        if ($request->isMethod('post')) {            
            $validatedData = $request->validate([
                'name' => 'unique:units,name,null,null,name,name',
                'type' => 'required|max:20',
                'description' => 'required|max:255',
            ]);
            $id = $request->input('id');
            $unit_data = Units::find($id);
            $unit_data->name = $request->input('name');
            $unit_data->type = $request->input('type');
            $unit_data->description = $request->input('description');         
            $unit_data->save();
            $request->session()->flash('success', 'Unit Updated successfully!');
        }
        $unit_data = Units::find($id);
        
        return view('units/update',['unit'=>$unit_data]);
    }

    public function destroy(Request $request){
        $id = $request->input('id');
        $unit = Units::find($id);
        $res = $unit->delete();
        if($res){
            exit(json_encode(['status'=>'success','msg'=>'Deleted Successfully!']));
        }else{
            exit(json_encode(['status'=>'error','msg'=>'Something unexpected Happened!']));
        }
    }

    public function view($id){
        $id = Crypt::decrypt($id);
        $unit_data = Units::find($id);        
        
        return view('units/view',['unit'=>$unit_data]);
    }
}
