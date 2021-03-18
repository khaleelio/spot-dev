<?php

namespace App\Http\Controllers;

use App\Area;
use App\Cost;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use DB;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        $areas= Area::paginate(20);
        return view('backend.shipments.index-areas',compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shipments.create-area');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{	
			DB::beginTransaction();
			$model = new Area();
			
			
			$model->fill($_POST['Area']);
			if (!$model->save()){
				throw new \Exception();
			}
			
			DB::commit();
            flash(translate("Area added successfully"))->success();
            return back();
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
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
        $area = Area::find($id);
        return view('backend.shipments.edit-area',compact('area'));
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
        try{	
			DB::beginTransaction();
			$model = Area::find($id);
			
			
			$model->fill($_POST['Area']);
			if (!$model->save()){
				throw new \Exception();
			}
			
			DB::commit();
            flash(translate("Area Updated successfully"))->success();
            return back();
		}catch(\Exception $e){
			DB::rollback();
			print_r($e->getMessage());
			exit;
			
			flash(translate("Error"))->error();
            return back();
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($area)
    {
   
        $model = Area::findOrFail($area);
       
      
        if($model->delete()){
            flash(translate('Area has been deleted successfully'))->success();
            return redirect()->back();
        }
        return back();
    }
}
