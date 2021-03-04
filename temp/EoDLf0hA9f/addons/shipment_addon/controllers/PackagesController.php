<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\Http\Helpers\UserRegistrationHelper;
use DB;
class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::paginate(15);
        return view('backend.shipments.index-package', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.shipments.create-package');
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
			$model = new Package();
			
			
			$model->fill($_POST['Package']);
	      
			if (!$model->save()){
				throw new \Exception();
			}
			
			DB::commit();
            flash(translate("Package added successfully"))->success();
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
        
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::where('id', $id)->first();
        if($package != null){
            return view('backend.shipments.edit-package',compact('package'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $package)
    {
        try{	
			DB::beginTransaction();
			$model = Package::find($package);
			
			
			$model->fill($_POST['Package']);
		
			if (!$model->save()){
				throw new \Exception();
			}
			
			
			DB::commit();
            flash(translate("Package updated successfully"))->success();
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
    public function destroy($package)
    {
   
        $model = Package::findOrFail($package);
        
        if($model->delete()){
            flash(translate('Package has been deleted successfully'))->success();
            return redirect()->back();
        }
        return back();
    }
}