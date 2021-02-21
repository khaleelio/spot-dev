<?php

namespace App\Http\Controllers;

use App\Addon;
use App\Menu;
use Illuminate\Http\Request;
use ZipArchive;
use DB;
use Auth;
use App\BusinessSetting;
use App\Http\Helpers\SpotConfigHelper;
use CoreComponentRepository;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Storage;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        CoreComponentRepository::instantiateShopRepository();
        return view('backend.addons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.addons.create');
    }

    private function recurse_copy($src, $dst)
    {
        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (env('DEMO_MODE') == 'On') {
            flash(translate('This action is disabled in demo mode'))->error();
            return back();
        }

        if (class_exists('ZipArchive')) {
            if ($request->hasFile('addon_zip')) {

                if ($request->addon_zip->getClientOriginalExtension() != 'zip') {
                    flash(translate('Please upload correct addon zipped file!'))->error();
                    return back();
                }
                // Create update directory.
                $dir = 'addons';
                if (!is_dir($dir))
                    mkdir($dir, 0777, true);

                $path = Storage::disk('local')->put('addons', $request->addon_zip);

                $zipped_file_name = $request->addon_zip->getClientOriginalName();

                //Unzip uploaded update file and remove zip file.
                $zip = new ZipArchive;
                $res = $zip->open(base_path('public/' . $path));

                $random_dir = Str::random(10);

                $dir = trim($zip->getNameIndex(0), '/');

                if ($res === true) {
                    $res = $zip->extractTo(base_path('temp/' . $random_dir . '/addons'));
                    $zip->close();
                } else {
                    dd('could not open');
                }

                $str = file_get_contents(base_path('temp/' . $random_dir . '/addons/' . $dir . '/config.json'));

                $json = json_decode($str, true);



                $files = array();

                if (!empty($json['files'])) {
                    foreach ($json['files'] as $file) {
                        $files[] = $file['update_directory'];
                    }
                }

                // TODO: add any sql changes in database so it can be revert again when uninstall

                if (BusinessSetting::where('type', 'current_version')->first()->value >= $json['minimum_item_version']) {
                    if (count(Addon::where('unique_identifier', $json['unique_identifier'])->get()) == 0) {
                        if (isset($json['required_addons'])) {
                            $req_addons = explode(',', $json['required_addons']);
                            if (count(Addon::whereIn('unique_identifier', $req_addons)->get()) == 0) {
                                flash(translate('This addon is required another addons') . ' (' . $json['required_addons'] . ')')->error();
                                return redirect()->route('addons.index');
                            }
                        }
                        $this->recurse_copy(base_path('temp/' . $random_dir . '/addons/' . $dir), base_path('addons/' . $json['unique_identifier'] . '/'));
                        $addon = new Addon;
                        $addon->name = $json['name'];
                        $addon->unique_identifier = $json['unique_identifier'];
                        if (isset($json['required_addons'])) {
                            $addon->required_addons = $json['required_addons'];
                        }
                        $addon->version = $json['version'];
                        $addon->activated = 1;
                        $addon->image = $json['addon_banner'];
                        $addon->files = implode(',', $files);
                        $addon->save();

                        // Create new directories.
                        if (!empty($json['directory'])) {
                            //dd($json['directory'][0]['name']);
                            foreach ($json['directory'][0]['name'] as $directory) {
                                if (is_dir(base_path($directory)) == false) {
                                    mkdir(base_path($directory), 0777, true);
                                } else {
                                    echo "error on creating directory";
                                }
                            }
                        }

                        // Create/Replace new files.
                        if (!empty($json['files'])) {
                            foreach ($json['files'] as $file) {
                                copy(base_path('temp/' . $random_dir . '/' . $file['root_directory']), base_path($file['update_directory']));
                            }
                        }
                        // Run sql modifications
                        $sql_path = base_path('temp/' . $random_dir . '/addons/' . $dir . '/sql/update.sql');
                        $migrations_temp_path = 'temp/' . $random_dir . '/addons/' . $dir . '/sql/migrations';
                        $migrations_path =  base_path($migrations_temp_path);
                        if (file_exists($sql_path)) {
                            DB::unprepared(file_get_contents($sql_path));
                        } elseif (file_exists($migrations_path)) {
                            //delte migration rollback files info from migrations table
                            $migrations_path_old = 'addons/' . $addon->unique_identifier . '/sql/migrations/rollbacks/';
                            if (file_exists($migrations_path_old)) {
                                $files = \File::files($migrations_path_old);
                                foreach ($files as $file) {
                                    $file_name_without_ext = explode('.',$file->getFilename())[0];
                                    DB::table('migrations')->where('migration', $file_name_without_ext)->delete();
                                }
                            }
                            $files = \File::files($migrations_path);
                            foreach ($files as $file) {
                                Artisan::call('migrate', array('--path' => $migrations_temp_path . '/' . $file->getFilename(), '--force' => true));
                            }
                        }

                        flash(translate('Addon installed successfully'))->success();
                        return redirect()->route('addons.index');
                    } else {
                        // Create new directories.
                        if (!empty($json['directory'])) {
                            //dd($json['directory'][0]['name']);
                            foreach ($json['directory'][0]['name'] as $directory) {
                                if (is_dir(base_path($directory)) == false) {
                                    mkdir(base_path($directory), 0777, true);
                                } else {
                                    echo "error on creating directory";
                                }
                            }
                        }

                        // Create/Replace new files.
                        if (!empty($json['files'])) {
                            foreach ($json['files'] as $file) {
                                copy(base_path('temp/' . $random_dir . '/' . $file['root_directory']), base_path($file['update_directory']));
                            }
                        }

                        $addon = Addon::where('unique_identifier', $json['unique_identifier'])->first();
                        $this->recurse_copy(base_path('temp/' . $random_dir . '/addons/' . $dir), base_path('addons/' . $json['unique_identifier'] . '/'));
                        for ($i = $addon->version + 0.1; $i <= $json['version']; $i = $i + 0.1) {
                            // Run sql modifications
                            $sql_path = base_path('temp/' . $random_dir . '/addons/' . $dir . '/sql/' . $i . '.sql');
                            $migrations_temp_path = 'temp/' . $random_dir . '/addons/' . $dir . '/sql/migrations/' . $i;
                            $migrations_path =  base_path($migrations_temp_path);
                            if (file_exists($sql_path)) {
                                DB::unprepared(file_get_contents($sql_path));
                            } elseif (file_exists($migrations_path)) {
                                $files = \File::files($migrations_path);
                                foreach ($files as $file) {
                                    Artisan::call('migrate', array('--path' => $migrations_temp_path . '/' . $file->getFilename(), '--force' => true));
                                }
                            }
                        }

                        $addon->files = implode(',', $files);
                        $addon->version = $json['version'];
                        $addon->save();

                        flash(translate('This addon is updated successfully'))->success();
                        return redirect()->route('addons.index');
                    }
                } else {
                    flash(translate('This version is not capable of installing Addons, Please update.'))->error();
                    return redirect()->route('addons.index');
                }
            }
        } else {
            flash(translate('Please enable ZipArchive extension.'))->error();
        }
    }

    public function forceDelete($id)
    {
        $addon = Addon::find($id);
        $addon_folder = base_path('addons/' . $addon->unique_identifier . '/');
        
    }

    private function delete_directory($dirname)
    {
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file))
                    unlink($dirname . "/" . $file);
                else
                    $this->delete_directory($dirname . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }
    public function delete($id)
    {
        $addon = Addon::find($id);
        $addon_folder = base_path('addons/' . $addon->unique_identifier . '/');
        $str = file_get_contents($addon_folder . 'config.json');
        $json = json_decode($str, true);
        $addons = Addon::all();
        foreach ($addons as $s_addon) {
            $reqs = explode(',', $s_addon->required_addons);
            if (in_array($addon->unique_identifier, $reqs)) {
                flash(translate("You can't delete this addon , this addon required by another addons"))->error();
                return redirect()->route('addons.index');
            }
        }

        //delte migration files info from migrations table
        $migrations_path_old = 'addons/' . $addon->unique_identifier . '/sql/migrations/';
        if (file_exists($migrations_path_old)) {
            $files = \File::files($migrations_path_old);
            foreach ($files as $file) {
                $file_name_without_ext = explode('.',$file->getFilename())[0];
                DB::table('migrations')->where('migration', $file_name_without_ext)->delete();
            }
        }

        //Rollback database
        $migrations_temp_path = 'addons/' . $addon->unique_identifier . '/sql/migrations/rollbacks/';
        $migrations_path =  base_path($migrations_temp_path);
        if (file_exists($migrations_path)) {
            $files = \File::files($migrations_path);
            foreach ($files as $file) {
                //rollback migration
                Artisan::call('migrate', array('--path' => $migrations_temp_path.$file->getFilename(), '--force' => true));
                
            }
            
        }
        //Delete files
        if (!empty($json['files'])) {
            foreach ($json['files'] as $file) {
                unlink(base_path($file['update_directory']));
            }
        }
        //Delete folders 
        if (!empty($json['directory'])) {
            //dd($json['directory'][0]['name']);
            foreach ($json['directory'][0]['name'] as $directory) {
                if (is_dir(base_path($directory)) == true) {
                    $this->delete_directory(base_path($directory));
                } 
            }
        }

        $addon->delete();

        flash(translate('This addon is deleted successfully'))->success();
        return redirect()->route('addons.index');


    }

    public function resetSystem()
    {
        $all_addons = Addon::all();
        foreach($all_addons as $addon)
        {
            
            $addon_folder = base_path('addons/' . $addon->unique_identifier . '/');
            $str = file_get_contents($addon_folder . 'config.json');
            $json = json_decode($str, true);
            $addons = Addon::all();
            foreach ($addons as $s_addon) {
                $reqs = explode(',', $s_addon->required_addons);
                if (in_array($addon->unique_identifier, $reqs)) {
                    flash(translate("You can't delete this addon , this addon required by another addons"))->error();
                    return redirect()->route('addons.index');
                }
            }
    
            //delte migration files info from migrations table
            $migrations_path_old = 'addons/' . $addon->unique_identifier . '/sql/migrations/';
            if (file_exists($migrations_path_old)) {
                $files = \File::files($migrations_path_old);
                foreach ($files as $file) {
                    $file_name_without_ext = explode('.',$file->getFilename())[0];
                    DB::table('migrations')->where('migration', $file_name_without_ext)->delete();
                }
            }
    
            //Rollback database
            $migrations_temp_path = 'addons/' . $addon->unique_identifier . '/sql/migrations/rollbacks/';
            $migrations_path =  base_path($migrations_temp_path);
            if (file_exists($migrations_path)) {
                $files = \File::files($migrations_path);
                foreach ($files as $file) {
                    //rollback migration
                    Artisan::call('migrate', array('--path' => $migrations_temp_path.$file->getFilename(), '--force' => true));
                    
                }
                
            }
            //Delete files
            if (!empty($json['files'])) {
                foreach ($json['files'] as $file) {
                    unlink(base_path($file['update_directory']));
                }
            }
            //Delete folders 
            if (!empty($json['directory'])) {
                //dd($json['directory'][0]['name']);
                foreach ($json['directory'][0]['name'] as $directory) {
                    if (is_dir(base_path($directory)) == true) {
                        $this->delete_directory(base_path($directory));
                    } 
                }
            }
            $this->delete_directory(base_path('addons/'.$addon->unique_identifier.'/'));
            $addon->delete();    
        }
        
        SpotConfigHelper::setValue("installable","true");
        return redirect('/');
    }

    public function writeEnvironmentFile($type, $val) {
        $path = base_path('.env');
       
        if (file_exists($path)) {
            
            $val = '"'.trim($val).'"';
            file_put_contents($path, str_replace(
                $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Addon $addon
     * @return \Illuminate\Http\Response
     */
    public function show(Addon $addon)
    {
        //
    }

    public function list()
    {
        //return view('backend.'.Auth::user()->role.'.addon.list')->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Addon $addon
     * @return \Illuminate\Http\Response
     */
    public function edit(Addon $addon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Addon $addon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Addon $addon
     * @return \Illuminate\Http\Response
     */
    public function activation(Request $request)
    {
        $addon = Addon::find($request->id);
        //$menu  = Menu::where('displayed_name', $addon->unique_identifier)->first();
        $addon->activated = $request->status;

        $addon->save();
        //$menu->save();

        // $data = array(
        //     'status' => true,
        //     'notification' => translate('addon_status_updated_successfully')
        // );
        // return $data;

        return 1;
    }
}
