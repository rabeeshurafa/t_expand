<?php


namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Managers\AttatchmentManager;
use App\Models\Folder;
use App\Models\License;
use App\Models\linkedTo;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Models\Equpment;
use App\Models\Admin;
use App\Models\Archive;
use App\Models\Department;
use App\Models\Orgnization;
use App\Models\Setting;
use App\Models\Region;
use App\Models\Project;
use App\Models\SpecialAsset;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\CopyTo;
use App\Models\ArchiveType;
use App\Models\AgendaExtention;
use App\Models\File;
use App\Models\Constant;
use Session;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ArchiveRequest;
use App\Http\Requests\LawArchive;
use App\Models\AttachmentType;
use App\Models\LicenseType;
use App\Models\ArchiveLicense;
use App\Models\Area;
use App\Models\City;
use App\Models\jobLicArchieve;
use App\Models\LimitNumber;
use App\Models\Volunteer;
use Illuminate\Support\Str;
use App\Models\ArchiveRole;
use App\Models\AgendaDetail;
use App\Models\TradeArchive;
use Illuminate\Support\Facades\DB as FacadesDB;

class ArchieveController extends Controller

{

    public function out_archieve()

    {

        $type = 'outArchive';

        $url = "out_archieve";

        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();
        /*
                $archive_type = ArchiveType::where('type', 'munArchive')->get();

                $projArchive = ArchiveType::where('type', 'projArchive')->get();

                $empArchive = ArchiveType::where('type', 'empArchive')->get();

                $citArchive = ArchiveType::where('type', 'citArchive')->get();

                $depArchive = ArchiveType::where('type', 'depArchive')->get();
        */
        return view('dashboard.archive.outArchive', compact('type', 'archive_config', 'url'));

    }


    public function store_archive_config(Request $request)
    {
        $empRole = ArchiveRole::find($request->config_id);
        if (!$empRole) {
            $empRole = new ArchiveRole();
        }
        $empRole->type = $request->archive_t;
        $empRole->empid = $request->empid;
        if ($request->emp_to_json) {
            $empRole->archiveroles = json_encode($request->emp_to_json);
        } else {
            $empRole->archiveroles = '[""]';
        }
        $res = $empRole->save();
        if ($res) {

            return response()->json(['success' => trans('تم الحفظ'), 'id' => $empRole->id]);

        }

        return response()->json(['error' => 'حدث خطأ']);

    }

    public function archive_delete(Request $request)
    {

        $archive = Archive::find($request['archive_id']);
        $copyTo = CopyTo::where('archive_id', $archive->id)->get();
        foreach ($copyTo as $copy) {
            $copy->deleted_by = Auth()->user()->id;
            $copy->enabled = 0;
            $copy->save();
        }
        $archive->deleted_by = Auth()->user()->id;
        $archive->enabled = 0;
        $archive->save();
        if ($archive) {

            return response()->json(['success' => trans('admin.subscriber_added')]);

        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function recoverArchive(Request $request)
    {

        $archive = Archive::find($request['archive_id']);
        $copyTo = CopyTo::where('archive_id', $archive->id)->get();
        foreach ($copyTo as $copy) {
            $copy->deleted_by = 0;
            $copy->enabled = 1;
            $copy->save();
        }
        $archive->deleted_by = 0;
        $archive->enabled = 1;
        $archive->save();
        if ($archive) {

            return response()->json(['success' => trans('admin.subscriber_added')]);

        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function archive_auto_complete(Request $request)
    {

        $emp_data = $request['term'];

        // $equip = Equpment::where('name', 'like', '%' . $emp_data . '%')        

        // ->select("CONCAT('name','equip') AS label")->get();        

        // $inArchive = Archive::where('name', 'like', '%' . $emp_data . '%')        

        // ->where('type','inArchive')        

        // ->select('*',DB::raw("CONCAT(name , '( أرشيف الوارد )' )AS label"))->get();     

        // $outArchive = Archive::where('name', 'like', '%' . $emp_data . '%')        

        // ->where('type','outArchive')       

        // ->select('*',DB::raw("CONCAT(name , '(  أرشيف الصادر  )' )AS label"))->get();    

        // $munArchive = Archive::where('name', 'like', '%' . $emp_data . '%')       

        // ->where('type','munArchive')       

        // ->select('*',DB::raw("CONCAT(name , '(  أرشيف عنوان الوثيقة  )' )AS label"))->get();

        // $projArchive = Archive::where('name', 'like', '%' . $emp_data . '%')       

        // ->where('type','projArchive')      

        // ->select('*',DB::raw("CONCAT(name , '(  أرشيف المشاريع   )' )AS label"))->get();  

        // $empArchive = Archive::where('name', 'like', '%' . $emp_data . '%')

        // ->where('type','empArchive')     

        // ->select('*',DB::raw("CONCAT(name , '(  أرشيف الموظفين   )' )AS label"))->get();  

        // $depArchive = Archive::where('name', 'like', '%' . $emp_data . '%')        

        // ->where('type','depArchive')    

        // ->select('*',DB::raw("CONCAT(name , '(  أرشيف الاقسام   )' )AS label"))->get(); 

        // $citArchive =  Archive::where('name', 'like', '%' . $emp_data . '%')      

        // ->where('type','citArchive')     

        // ->select('*',DB::raw("CONCAT(name , '(  أرشيف المواطنين   )' )AS label"))->get();   

        $equip = Equpment::where('name', 'like', '%'.$emp_data.'%')->where('enabled', '1')->select('*',
                DB::raw('name AS label')
        //, DB::raw("CONCAT(name ,' ', ' (اجهزه و معدات) ' )AS label")
        )->get();

        $vehicle = Vehicle::where('name', 'like', '%'.$emp_data.'%')->where('enabled', '1')->select('*',
                DB::raw('name AS label')
        //, DB::raw("CONCAT(name , ' ',' (المركبات) ' )AS label")
        )->get();

        $project = Project::where('name', 'like', '%'.$emp_data.'%')->where('enabled', '1')->select('*',
                DB::raw('name AS label')
        //, DB::raw("CONCAT(name , ' ',' (المشاريع) ' )AS label")
        )->get();

        $admin = Admin::where('admins.id', '!=', '74')->where('name', 'like', '%'.$emp_data.'%')->where('enabled',
                '1')->select('*', DB::raw('name AS label')
        //, DB::raw("CONCAT(name , ' ',' ( الموظفين ) ' )AS label")
        )->get();

        $department = Department::where('name', 'like', '%'.$emp_data.'%')->where('enabled', '1')->select('*',
                DB::raw('name AS label')
        //, DB::raw("CONCAT(name ,' ', ' (الاقسام) ' )AS label")
        )->get();

        $orgnization = Orgnization::where('name', 'like', '%'.$emp_data.'%')->where('enabled', '1')->select('*',
                DB::raw('name AS label')
        //, DB::raw("CONCAT(name )AS label")
        )->get();

        $specialAsset = SpecialAsset::where('name', 'like', '%'.$emp_data.'%')->where('enabled', '1')->select('*',
                DB::raw('name AS label')
        //DB::raw("CONCAT(name , ' ',' (المباني و المستودعات و الاراضي) ' )AS label")
        )->get();

        $user = User::where('name', 'like', '%'.$emp_data.'%')->where('enabled', '1')->select('*',
                DB::raw("CONCAT(name,' ','(مواطن)' )AS label"))->get();
        $volunteer = Volunteer::where('name', 'like', '%'.$emp_data.'%')->select('*',
                DB::raw("CONCAT(name )AS label"))->get();
        $folder = Folder::where('name', 'like', '%'.$emp_data.'%')->select('*', DB::raw('name AS label'))->get();
        $names = $equip->merge($vehicle)->merge($project)->merge($admin)->merge($department)->merge($equip)
                ->merge($orgnization)->merge($specialAsset)->merge($user)->merge($volunteer)->merge($folder);

        // ->merge($inArchive)        // ->merge($outArchive)->merge($munArchive)->merge($projArchive)     

        // ->merge($empArchive)->merge($depArchive)->merge($citArchive)        ->merge($orgnization)->merge($specialAsset)->merge($user);      

        return response()->json($names);

    }

    public function Linence_auto_complete(Request $request)
    {
//        $emp_data = $request['term'];
//        $users = User::where('name', 'like', '%' . $emp_data . '%')->where('enabled', '1')->select('*', DB::raw("CONCAT(name)AS label"))->get();
        $license = License::where(function ($query) use ($request) {
            $query->where('users.name', 'like', '%'.$request->term.'%')
                    ->orWhere('licenses.licNo', 'like', '%'.$request->term.'%');
        })->where('licenses.enabled',
                '1')->select(FacadesDB::raw("CONCAT(users.name ,' (',licenses.licNo,')' )AS title"),
                'licenses.id as licId','licenses.licNo as licNo','users.id as userId', 'fileNo', 'users.model as userModel',
                FacadesDB::raw("CONCAT(users.name ,' (',licenses.licNo,')' )AS label"), 'users.name as userName',
                'licenses.systemUse as systemUse', 'licenses.use_desc as use_desc', 'peiceNo', 'hodNo', 'license_date')
                ->leftJoin('users', 'users.id', 'licenses.user_id')
                ->with(['systemUse', 'use_desc'])->get();
        return response()->json($license);
    }

    public function licArchive_delete(Request $request)
    {
        // dd($request->all());
        $archive = ArchiveLicense::find($request['archive_id']);
        // $copyTo=CopyTo::find($archive->id);
        // foreach($copyTo as $copy){
        //     $copy->deleted_by = Auth()->user()->id;
        //     $copy->enabled = 0;
        // }
        $archive->deleted_by = Auth()->user()->id;
        $archive->enabled = 0;
        // dd($user->all());
        $archive->save();
        if ($archive) {

            return response()->json(['success' => trans('admin.subscriber_added')]);

        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function licArchive_recovery(Request $request)
    {
        // dd($request->all());
        $archive = ArchiveLicense::find($request['archive_id']);
        // $copyTo=CopyTo::find($archive->id);
        // foreach($copyTo as $copy){
        //     $copy->deleted_by = Auth()->user()->id;
        //     $copy->enabled = 0;
        // }
        $archive->deleted_by = 0;
        $archive->enabled = 1;
        // dd($user->all());
        $archive->save();
        if ($archive) {

            return response()->json(['success' => trans('admin.subscriber_added')]);

        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function jobLic_archieve_delete(Request $request)
    {
        // dd($request->all());
        $archive = jobLicArchieve::find($request['archive_id']);
        // $copyTo=CopyTo::find($archive->id);
        // foreach($copyTo as $copy){
        //     $copy->deleted_by = Auth()->user()->id;
        //     $copy->enabled = 0;
        // }
        $archive->deleted_by = Auth()->user()->id;
        $archive->enabled = 0;
        // dd($user->all());
        $archive->save();
        if ($archive) {

            return response()->json(['success' => trans('admin.subscriber_added')]);

        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function store_lince_archive(Request $request)
    {
        $attach = array();
        $attachName = $request->attachName;
        $attachFile = $request->attachFile;
        $attachFile_ids = $request->attachFile_id;
        for ($i = 0; $i < sizeof($attachName); $i++) {
            $temp = array();
            $temp[$attachName[$i]] = $attachFile[$i];
            $temp['id'] = $attachFile_ids[$i];
            $attach[] = $temp;
        }

        //dd($attach);
        $archive = ArchiveLicense::where('id', $request->ArchiveID)->first();
        if ($archive) {

            $archive->name = $request->customername;

            $archive->licn = $request->licn;
            // license_id
            $archive->licnfile = $request->licnfile;

            $archive->licNo = $request->licNo;

            $archive->license_type = $request->BuildingData;

            $archive->license_id = $request->pk_i_id;

            $archive->use_desc = $request->use_desc;

            $archive->fileNo = $request->fileNo;
            $archive->notes = $request->notes;

            $archive->license_date = $request->license_date;

            $archive->url = $request->url;

            $archive->attachment_id = $request->AttahType;

            $archive->json_feild = json_encode($attach);

            $archive->save();
            $prevFiles = File::where('model_name', "App\Models\ArchiveLicense")->where('archive_id',
                    $archive->id)->get();
            foreach ($prevFiles as $prevFile) {
                $prevFile->archive_id = 0;
                $prevFile->save();
            }
            $sum = 0;
            $countAttachments = 0;
            if ($attachFile_ids) {
                foreach ($attachFile_ids as $id) {
                    $file = File::find($id);
                    $file->archive_id = $archive->id;
                    $file->model_name = "App\Models\ArchiveLicense";
                    if ($file && $file->size) {
                        $size = $file->size;
                        if ($size && $size != '0') {
                            $countAttachments++;
                        }
                        if (str_contains($size, 'mb')) {
                            $size = (float)$size * 1000;
                        }
                        $sum = $sum +  (float)$size;
                    }
                    $file->save();
                }
            }
            $archive->sizeAttachments = $sum;
            $archive->countAttachments = $countAttachments;
            $archive->save();

        } else {

            $archive = new ArchiveLicense();
            $archive->url = $request->url;
            $archive->add_by = Auth()->user()->id;
            $archive->name = $request->customername;
            $archive->model_id = $request->customerid;
            $archive->model_name = $request->customerType;
            $archive->json_feild = json_encode($attach);
            $archive->notes = $request->notes;
            $archive->licn = $request->licn;
            $archive->licnfile = $request->licnfile;
            $archive->licNo = $request->licNo;
            $archive->license_type = $request->BuildingData;
            $archive->type = $request->type;
            $archive->license_id = $request->pk_i_id;
            $archive->use_desc = $request->use_desc;
            $archive->fileNo = $request->fileNo;
            $archive->license_date = $request->license_date;
            $archive->attachment_id = $request->AttahType;
            $archive->save();
            $sum = 0;
            $countAttachments = 0;
            if ($attachFile_ids) {
                foreach ($attachFile_ids as $id) {
                    $file = File::find($id);
                    $file->archive_id = $archive->id;
                    $file->model_name = "App\Models\ArchiveLicense";
                    if ($file && $file->size) {
                        $size = $file->size;
                        if ($size && $size != '0') {
                            $countAttachments++;
                        }
                        if (str_contains($size, 'mb')) {
                            $size = (float)$size * 1000;
                        }
                        $sum = $sum +  (float)$size;
                    }
                    $file->save();
                }
            }
            $archive->sizeAttachments = $sum;
            $archive->countAttachments = $countAttachments;
            $archive->save();

        }

        if ($archive) {

            return response()->json(['success' => trans('admin.archive_added')]);

        }

    }

    public function volunteerReport()
    {
        $type = 'volunteerReport';
        $url = "volunteer_report";
        $attachment_type = AttachmentType::get();
        $license_type = LicenseType::where('type', 'drive_lic')->get();
        $city = City::get();
        $town = Area::get();
        return view('dashboard.archive.volunteerReport', compact('type', 'attachment_type'
                , 'license_type', 'url', 'city', 'town'));
    }

    public function volunteerArchieve_report(Request $request)
    {
        // dd($request->all());

        $archive['type'] = "all";
        $currentyear = date('Y', time());
        /*
        $archive['result'] = Volunteer::query()
        ->join('addresses', 'addresses.id', '=', 'volunteers.address_id')->with('address.city')->with('lincence')->with('Volunteercourse');
        $nowdate = date('Y', time());

        if($request->get('bloodType')){
            $archive['result']->where('blood_type','=',$request->get('bloodType'));
        }
        // if($request->get('townID')){
        //     $archive['result']->where('blood_type','=',$request->get('bloodType'));
        // }
        // if($request->get('cityID')){
        //     $archive['result']->where('city_id ','=',$request->get('cityID'));
        // }
        if($request->get('licType')){
            $archive['result']->where('license_types_id','=',$request->get('licType'));
        }
        if($request->get('age')){
            $birthdate=$nowdate-$request->get('age');
            $archive['result']->where('birthdate','like','%'.$birthdate);
        }
        if($request->get('duration')){
            $duration=$nowdate-$request->get('duration');
            $archive['result']->where('joining_date','like','%'.$duration);
        }
        if($request->get('course')){
            $volunteerIDs= Volunteer_Courses::where('name','like','%'.$request->get('course').'%')->get('volunteer_id');
            $archive['result']->whereIn('id',$volunteerIDs);
        }
        if($request->get('education')){
            $volunteerIDs= Volunteer_Courses::where('name','like','%'.$request->get('education').'%')->get('volunteer_id');
            $archive['result']->whereIn('id',$volunteerIDs);
        }

        $archive['result']= $archive['result']->get();
        */
        $blood_type = "";
        if ($request->get('bloodType')) {
            if ($request->get('bloodType') == 1) {
                $blood_type = "A+";
            } else if ($request->get('bloodType') == 2) {
                $blood_type = "A-";
            } else if ($request->get('bloodType') == 3) {
                $blood_type = "B+";
            } else if ($request->get('bloodType') == 4) {
                $blood_type = "B-";
            } else if ($request->get('bloodType') == 5) {
                $blood_type = "O+";
            } else if ($request->get('bloodType') == 6) {
                $blood_type = "O-";
            } else if ($request->get('bloodType') == 7) {
                $blood_type = "AB+";
            } else if ($request->get('bloodType') == 8) {
                $blood_type = "AB-";
            }
        }
        $fromyear = 1;
        $toyear = 50000;
        if ($request->get('age')) {
            if ($request->get('age') == 1) {
                $toyear = $currentyear - 16;
                $fromyear = $currentyear - 25;
            } else if ($request->get('age') == 2) {
                $toyear = $currentyear - 26;
                $fromyear = $currentyear - 35;
            } else if ($request->get('age') == 3) {
                $toyear = $currentyear - 36;
                $fromyear = $currentyear - 45;
            } else if ($request->get('age') == 4) {
                $toyear = $currentyear - 46;
                $fromyear = $currentyear - 55;
            } else if ($request->get('age') == 5) {
                $fromyear = $currentyear - 56;
                $toyear = 1900;
            }
        }


        $where = '';
        if ($request->get('bloodType')) {
            $where .= " and blood_type='".$blood_type."'";
        }
        if ($request->get('townID')) {
            $where .= " and addresses.area_id='".$request->get('townID')."'";
        }
        if ($request->get('cityID')) {
            $where .= " and addresses.city_id='".$request->get('cityID')."'";
        }
        if ($request->get('licType')) {
            $where .= " and license_types_id='".$request->get('licType')."'";
        }
        if ($request->get('age')) {
            $where .= " and year(str_to_date(birthdate,'%d/%m/%Y')) BETWEEN ".$fromyear." and ".$toyear;
        }
        if ($request->get('duration')) {
            $where .= " and year(joining_date)='".(date('Y') - $request->get('duration'))."'";
        }
        if ($request->get('course')) {
            $where .= " and volunteers in ( SELECT  `volunteer_id`
                                    FROM `volunteer__courses`
                                    WHERE `name` like '%".$request->get('course')."%')";
        }
        if ($request->get('education')) {
            $where .= " and volunteers in ( SELECT  `volunteer_id`
                                        FROM `volunteer__courses`
                                        WHERE `name` like '%".$request->get('education')."%')";
        }
        // echo $where;exit;
        // DB::enableQueryLog();
        $id = array();
        $archive = DB::select('select volunteers.* from  volunteers join addresses on addresses.id = volunteers.address_id  where 1=1 '.$where);
        foreach ($archive as $row) {
            $id[] = $row->id;
            /*$row->address=Address::where('id',$row->address_id)->get();
            $row->courses=Volunteer_Courses::where('volunteer_id',$row->id)->get();*/
        }
        $archive = Volunteer::whereIn('id',
                $id)->with('address.city')->with('address.area')->with('lincence')->with('Volunteercourse')->get();
        //     $query = DB::getQueryLog();
        //     print_r($query);
        // dd($archive);
        return response()->json($archive);

    }

    public function assets_archieve()

    {

        $type = 'assetsArchive';

        $url = "assets_archieve";
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();
        $archive_type = Constant::where('parent', 9)->where('status', 1)->get();

        return view('dashboard.archive.assetsArchive', compact('type', 'archive_config', 'archive_type', 'url'));

    }

    public function store_jobLic_archieve(Request $request)
    {

        $archive = jobLicArchieve::where('id', $request->ArchiveID)->first();

        if ($archive) {

            $archive->name = $request->customerName;

            $archive->region = $request->cityData;

            $archive->license_number = $request->licNo;

            $archive->trade_name = $request->businessName;

            $archive->start_date = $request->startAt;

            $archive->expiry_ate = $request->endAt;

            $archive->craft_type_id = $request->licType;

            $archive->limit_number_id = $request->LicBorder;

            $archive->attachment_id = $request->AttahType;
            $archive->url = $request->url;

            $archive->license_rating_id = $request->lic_cat;

            $archive->save();

            $files_ids = $request->formDataaaorgIdList;

            if ($files_ids) {

                foreach ($files_ids as $id) {

                    $file = File::find($id);

                    $file->archive_id = $archive->id;

                    $file->model_name = "App\Models\jobLicArchieve";

                    $file->save();

                }

            }

        } else {

            $archive = new jobLicArchieve();

            $archive->url = $request->url;

            $archive->added_by = Auth()->user()->id;

            $archive->name = $request->customerName;

            $archive->model_id = $request->customerid;

            $archive->model_name = $request->customerType;

            $archive->region = $request->cityData;

            $archive->license_number = $request->licNo;

            $archive->trade_name = $request->businessName;

            $archive->start_date = $request->startAt;

            $archive->expiry_ate = $request->endAt;

            $archive->craft_type_id = $request->licType;

            $archive->limit_number_id = $request->LicBorder;

            $archive->attachment_id = $request->AttahType;

            $archive->license_rating_id = $request->lic_cat;

            $archive->save();

            $files_ids = $request->formDataaaorgIdList;

            if ($files_ids) {

                foreach ($files_ids as $id) {

                    $file = File::find($id);

                    $file->archive_id = $archive->id;

                    $file->model_name = "App\Models\jobLicArchieve";

                    $file->save();

                }

            }

        }

        if ($archive) {

            return response()->json(['success' => trans('admin.archive_added')]);

        }

    }

    /*public function creatImages($images){
        $data=$images;

        if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
            $data = substr($data, strpos($data, ',') + 1);

            $type = strtolower($type[1]); // jpg, png, gif

            if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                return 0;
                // throw new \Exception('invalid image type');
            }
            $data = str_replace( ' ', '+', $data );
            $data = base64_decode($data);

            if ($data === false) {
                return 0;
                // throw new \Exception('base64_decode failed');
            }
        } else {
            return 0;
            // throw new \Exception('did not match data URI with image data');
        }
        $name='scanner'. rand(3, 999) . '-' . time();
        // file_put_contents(public_path('storage').'/'.$name. '.'.$type, $data);
        Storage::disk('s3')->put(($name.'.'.$type), $data);
        $file=new File();
        $file->real_name=$name.'.'.$type;
        $file->extension=$type;
        $file->url=Storage::cloud()->url(($name.'.'.$type));
        $file->type='2';
        $file->save();
        return $file;
    }*/
    public function phpinfo()
    {

        phpinfo();

    }

    /*public function creatPdf($images){
        $pdf_base64 = $images;
        $pdf_base64 = substr($pdf_base64, strpos($pdf_base64, ',') + 1);
        $pdf_decoded = base64_decode ($pdf_base64,true);
        if (strpos($pdf_decoded, '%PDF') !== 0) {
            return 0;
            // throw new Exception('Missing the PDF file signature');
        }

        $name='scanner'. rand(3, 999) . '-' . time();
        // file_put_contents(public_path('storage').'/'.$name.'.pdf', $pdf_decoded);
        Storage::disk('s3')->put(($name.'.pdf'), $pdf_decoded);
        $file=new File();
        $file->real_name=$name.'.pdf';
        $file->extension='pdf';
        $file->url=Storage::cloud()->url(($name.'.pdf'));
        $file->type='2';
        $file->save();
        return $file;
    }*/

    public function saveScanedFile(Request $request)
    {
        if ($request->type == 'application/pdf') {
            $file = AttatchmentManager::creatPdf($request->scannedData);
        } else {
            $file = AttatchmentManager::creatImages($request->scannedData);
        }
        if ($file) {
            return response()->json(['success' => true, 'file' => $file]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function preparconnectTo($ids = [], $types = []): array
    {
        $connectTo = array();
        $connectToTrade = array();
        $connectToArchive = array();
        for ($i = 0; $i < sizeof($ids??[]); $i++) {
            if ($types[$i] == 'trade_archive') {
                $connectToTrade[] = intval($ids[$i]);
            } else {
                $connectToArchive[] = intval($ids[$i]);
            }
        }
        $connectTo['connectToTrade'] = $connectToTrade;
        $connectTo['connectToArchive'] = $connectToArchive;
        return $connectTo;
    }

    public function store_archive(ArchiveRequest $request)
    {
        $connectTo = $this->preparconnectTo($request->connectedToID, $request->connectedToType);
        $scannedFileIds = array();
        if ($request->scannerfile != null) {
            foreach ($request->scannerfile as $scan) {
                $scannedFileId = $this->creatImages($scan);
                array_push($scannedFileIds, $scannedFileId);
            }
        }

        if ($request->scannerPdf != null) {
            foreach ($request->scannerPdf as $scan) {
                $scannedFileId = $this->creatPdf($scan);
                array_push($scannedFileIds, $scannedFileId);
            }
        }

        $archive = Archive::where('id', $request->ArchiveID)->first();
        if ($archive) {
            // dd($request->all());
            $archive->model_id = $request->customerid;
            $archive->type_id = $request->archive_type;
            $archive->name = $request->customername == '0' ? '' : $request->customername;
            $archive->model_name = $request->customerType;
            if ($request->msgDate) {
                $from = explode('/', ($request->msgDate));
                $from = $from[2].'-'.$from[1].'-'.$from[0];
            } else {
                $from = "0000-00-00";
            }
            $archive->date = $from;
            $archive->title = $request->msgTitle;
            $archive->type = $request->msgType;
            $archive->serisal = $request->msgid;
            $archive->url = $request->url;
            $archive->notes = $request->notes;
            $archive->connect_to = $connectTo;
            $archive->save();

            $files_ids = $request->formDataaaorgIdList;
            File::where('archive_id', $request->ArchiveID)
                    ->update(['archive_id' => 0, 'model_name' => '']);
            $sum = 0;
            $countAttachments = 0;
            if ($files_ids) {
                foreach ($files_ids as $id) {
                    $file = File::find($id);
                    if ($file && $file->size) {
                        $size = $file->size;
                        if ($size && $size != '0') {
                            $countAttachments++;
                        }
                        if (str_contains($size, 'mb')) {
                            $size = (float)$size * 1000;
                        }
                        $sum = $sum +  (float)$size;
                    }
                    $file->archive_id = $archive->id;
                    $file->model_name = "App\Models\Archive";
                    $file->save();
                }
            }
            ///////////////scanner file/////////
            foreach ($scannedFileIds as $fileid) {
                $file = File::find($fileid);
                $file->archive_id = $archive->id;
                $file->model_name = "App\Models\Archive";
                if ($file && $file->size) {
                    $size = $file->size;
                    if ($size && $size != '0') {
                        $countAttachments++;
                    }
                    if (str_contains($size, 'mb')) {
                        $size = (float)$size * 1000;
                    }
                    $sum = $sum +  (float)$size;
                }
                $file->save();
            }
            $archive->sizeAttachments = $sum;
            $archive->countAttachments = $countAttachments;
            $archive->save();
            ///////////////////////////////////
            CopyTo::where('archive_id', $archive->id)->delete();
            if ($request->copyToText[0] != null) {
                for ($i = 0; $i < count($request->copyToText); $i++) {
                    $copyTo = new CopyTo();
                    $copyTo->archive_id = $archive->id;
                    $copyTo->model_id = $request->copyToID[$i];
                    $copyTo->name = $request->copyToCustomer[$i];
                    $copyTo->model_name = $request->copyToType[$i];
                    $copyTo->save();
                }
            }

        } else {
            $archive = new Archive();
            $archive->model_id = $request->customerid;
            $archive->type_id = $request->archive_type;
            $archive->name = $request->customername == '0' ? '' : $request->customername;
            $archive->model_name = $request->customerType;
            if ($request->msgDate) {
                $from = explode('/', ($request->msgDate));
                $from = $from[2].'-'.$from[1].'-'.$from[0];
            } else {
                $from = "0000-00-00";
            }
            $archive->date = $from;
            $archive->title = $request->msgTitle;
            $archive->type = $request->msgType;
            $archive->serisal = $request->msgid;
            $archive->url = $request->url;
            $archive->notes = $request->notes;
            $archive->add_by = Auth()->user()->id;
            $archive->connect_to = $connectTo;
            $archive->save();
            $files_ids = $request->formDataaaorgIdList;

            $sum = 0;
            $countAttachments = 0;        
            if ($files_ids) {
                foreach ($files_ids as $id) {
                    $file = File::find($id);
                    $file->archive_id = $archive->id;
                    if ($file && $file->size) {
                        $size = $file->size;
                        if ($size && $size != '0') {
                            $countAttachments++;
                        }
                        if (str_contains($size, 'mb')) {
                            $size = (float)$size * 1000;
                        }
                        $sum = $sum +  (float)$size;
                    }
                    $file->model_name = "App\Models\Archive";
                    $file->save();
                }
            }
            ///////////////scanner file/////////
            foreach ($scannedFileIds as $fileid) {
                $file = File::find($fileid);
                $file->archive_id = $archive->id;
                $file->model_name = "App\Models\Archive";
                if ($file && $file->size) {
                    $size = $file->size;
                    if ($size && $size != '0') {
                        $countAttachments++;
                    }
                    if (str_contains($size, 'mb')) {
                        $size = (float)$size * 1000;
                    }
                    $sum = $sum +  (float)$size;
                }
                $file->save();
            }
            $archive->sizeAttachments = $sum;
            $archive->countAttachments = $countAttachments;
            $archive->save();
            ///////////////////////////////////

            if ($request->copyToText[0] != null) {
                for ($i = 0; $i < count($request->copyToText); $i++) {
                    $copyTo = new CopyTo();
                    $copyTo->archive_id = $archive->id;
                    $copyTo->model_id = $request->copyToID[$i];
                    $copyTo->name = $request->copyToCustomer[$i];
                    $copyTo->model_name = $request->copyToType[$i];
                    $copyTo->save();
                }
            }
        }

        if ($archive) {

            return response()->json(['success' => trans('admin.archive_added'), 'id' => $archive->id]);

        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function in_archieve()

    {

        $type = 'inArchive';

        $url = "in_archieve";
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();
        /*$archive_type = ArchiveType::where('type', 'munArchive')->get();

        $projArchive = ArchiveType::where('type', 'projArchive')->get();

        $empArchive = ArchiveType::where('type', 'empArchive')->get();

        $citArchive = ArchiveType::where('type', 'citArchive')->get();

        $depArchive = ArchiveType::where('type', 'depArchive')->get();*/

        return view('dashboard.archive.outArchive', compact('type', 'archive_config', 'url'));

    }

    public function mun_archieve()

    {

        $type = 'munArchive';

        $url = "mun_archieve";
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();
        $archive_type = Constant::where('parent', 49)->where('status', 1)->get();
        /*
        $projArchive = ArchiveType::where('type', 'projArchive')->get();

        $empArchive = ArchiveType::where('type', 'empArchive')->get();

        $citArchive = ArchiveType::where('type', 'citArchive')->get();

        $depArchive = ArchiveType::where('type', 'depArchive')->get();
        */
        return view('dashboard.archive.outArchive', compact('type', 'archive_config', 'archive_type', 'url'));

    }

    public function proj_archieve()

    {

        $type = 'projArchive';

        $url = "proj_archieve";
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();

        $archive_type = Constant::where('parent', 53)->where('status', 1)->get();
        /*
        $projArchive = ArchiveType::where('type', 'projArchive')->get();

        $empArchive = ArchiveType::where('type', 'empArchive')->get();

        $citArchive = ArchiveType::where('type', 'citArchive')->get();

        $depArchive = ArchiveType::where('type', 'depArchive')->get();
        */
        return view('dashboard.archive.outArchive', compact('type', 'archive_config', 'archive_type', 'url'));

    }

    public function emp_archieve()

    {

        $type = 'empArchive';

        $url = "emp_archieve";
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();
        $archive_type = Constant::where('parent', 50)->where('status', 1)->get();
        /*
        $projArchive = ArchiveType::where('type', 'projArchive')->get();

        $empArchive = ArchiveType::where('type', 'empArchive')->get();

        $citArchive = ArchiveType::where('type', 'citArchive')->get();

        $depArchive = ArchiveType::where('type', 'depArchive')->get();
        */
        return view('dashboard.archive.outArchive', compact('type', 'archive_config', 'archive_type', 'url'));

    }

    public function law_archieve()

    {

        $type = 'lawArchieve';

        $url = "law_archieve";
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();
        $archive_type = Constant::where('parent', '101')->where('status', 1)->get();

        return view('dashboard.archive.lawArchive',
                compact('archive_config', 'type', 'archive_type', 'url'));

    }

    public function specialEmpArchive()

    {

        $type = 'specialEmpArchive';

        $url = "specialEmpArchive";

        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();

        $archive_type = Constant::where('parent', '102')->where('status', 1)->get();

        return view('dashboard.empArchive.index',
                compact('archive_config', 'type', 'archive_type', 'url'));

    }

    public function store_lawArchive(LawArchive $request)
    {

        $connectTo = $this->preparconnectTo($request->connectedToID, $request->connectedToType);
        $archive = Archive::where('id', $request->ArchiveID)->first();
        if ($archive) {

            $archive->model_id = $request->customerid;

            $archive->type_id = $request->archive_type;

            $archive->name = $request->customername == '0' ? null : $request->customername;

            $archive->model_name = $request->customerType;

            if ($request->msgDate) {
                $from = explode('/', ($request->msgDate));

                $from = $from[2].'-'.$from[1].'-'.$from[0];
            } else {
                $from = "0000-00-00";
            }
            $archive->date = $from;

            $archive->title = $request->msgTitle;

            $archive->type = $request->msgType;

            $archive->serisal = $request->msgnote;

            $archive->url = $request->url;
            $archive->connect_to = $connectTo;
            $archive->save();

            $files_ids = $request->formDataaaorgIdList;

            $sum = 0;
            $countAttachments = 0;
            if ($files_ids) {

                foreach ($files_ids as $id) {

                    $file = File::find($id);

                    $file->archive_id = $archive->id;

                    $file->model_name = "App\Models\Archive";
                    if ($file && $file->size) {
                        $size = $file->size;
                        if ($size && $size != '0') {
                            $countAttachments++;
                        }
                        if (str_contains($size, 'mb')) {
                            $size = (float)$size * 1000;
                        }
                        $sum = $sum +  (float)$size;
                    }

                    $file->save();

                }

            }
            $archive->sizeAttachments = $sum;
            $archive->countAttachments = $countAttachments;
            $archive->save();
            CopyTo::where('archive_id', $archive->id)->delete();
            if ($request->copyToText[0] != null) {

                for ($i = 0; $i < count($request->copyToText); $i++) {

                    $copyTo = new CopyTo();

                    $copyTo->archive_id = $archive->id;

                    $copyTo->model_id = $request->copyToID[$i];

                    $copyTo->name = $request->copyToCustomer[$i];

                    $copyTo->model_name = $request->copyToType[$i];

                    $copyTo->save();

                }

            }

        } else {

            $archive = new Archive();

            $archive->model_id = $request->customerid;

            $archive->type_id = $request->archive_type;

            $archive->name = $request->customername == '0' ? null : $request->customername;

            $archive->model_name = $request->customerType;

            if ($request->msgDate) {
                $from = explode('/', ($request->msgDate));

                $from = $from[2].'-'.$from[1].'-'.$from[0];
            } else {
                $from = "0000-00-00";
            }
            $archive->date = $from;

            $archive->title = $request->msgTitle;

            $archive->type = $request->msgType;

            $archive->serisal = $request->msgnote;

            $archive->url = $request->url;

            $archive->add_by = Auth()->user()->id;
            $archive->connect_to = $connectTo;
            //dd( $request->customername=='0',$request->customername,$archive);
            $archive->save();

            $files_ids = $request->formDataaaorgIdList;

            $sum = 0;
            $countAttachments = 0;
            if ($files_ids) {

                foreach ($files_ids as $id) {

                    $file = File::find($id);

                    $file->archive_id = $archive->id;

                    $file->model_name = "App\Models\Archive";
                    if ($file && $file->size) {
                        $size = $file->size;
                        if ($size && $size != '0') {
                            $countAttachments++;
                        }
                        if (str_contains($size, 'mb')) {
                            $size = (float)$size * 1000;
                        }
                        $sum = $sum +  (float)$size;
                    }

                    $file->save();

                }

            }
            $archive->sizeAttachments = $sum;
            $archive->countAttachments = $countAttachments;
            $archive->save();

            if ($request->copyToText[0] != null) {

                for ($i = 0; $i < count($request->copyToText); $i++) {

                    $copyTo = new CopyTo();

                    $copyTo->archive_id = $archive->id;

                    $copyTo->model_id = $request->copyToID[$i];

                    $copyTo->name = $request->copyToCustomer[$i];

                    $copyTo->model_name = $request->copyToType[$i];

                    $copyTo->save();

                }

            }

        }

        if ($archive) {

            return response()->json(['success' => trans('admin.archive_added'), 'id' => $archive->id]);

        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function store_specialEmpArchive(LawArchive $request)
    {

        // dd($request->all());
        $archive = Archive::where('id', $request->ArchiveID)->first();
        if ($archive) {

            $archive->model_id = $request->customerid;

            $archive->type_id = $request->archive_type;

            $archive->name = $request->customername == '0' ? '' : $request->customername;

            $archive->model_name = $request->customerType;

            if ($request->msgDate) {
                $from = explode('/', ($request->msgDate));

                $from = $from[2].'-'.$from[1].'-'.$from[0];
            } else {
                $from = "0000-00-00";
            }
            $archive->date = $from;

            $archive->title = $request->msgTitle;

            $archive->type = $request->msgType;

            $archive->serisal = $request->msgid;

            $archive->url = $request->url;

            $archive->save();

            $files_ids = $request->formDataaaorgIdList;

            $sum = 0;
            $countAttachments = 0;
            if ($files_ids) {

                foreach ($files_ids as $id) {

                    $file = File::find($id);

                    $file->archive_id = $archive->id;

                    $file->model_name = "App\Models\Archive";
                    if ($file && $file->size) {
                        $size = $file->size;
                        if ($size && $size != '0') {
                            $countAttachments++;
                        }
                        if (str_contains($size, 'mb')) {
                            $size = (float)$size * 1000;
                        }
                        $sum = $sum +  (float)$size;
                    }

                    $file->save();

                }

            }
            $archive->sizeAttachments = $sum;
            $archive->countAttachments = $countAttachments;
            $archive->save();
            CopyTo::where('archive_id', $archive->id)->delete();
            if ($request->copyToText[0] != null) {

                for ($i = 0; $i < count($request->copyToText); $i++) {

                    $copyTo = new CopyTo();

                    $copyTo->archive_id = $archive->id;

                    $copyTo->model_id = $request->copyToID[$i];

                    $copyTo->name = $request->copyToCustomer[$i];

                    $copyTo->model_name = $request->copyToType[$i];

                    $copyTo->save();

                }

            }

        } else {

            $archive = new Archive();

            $archive->model_id = $request->customerid;

            $archive->type_id = $request->archive_type;

            $archive->name = $request->customername == '0' ? '' : $request->customername;

            $archive->model_name = $request->customerType;

            if ($request->msgDate) {
                $from = explode('/', ($request->msgDate));

                $from = $from[2].'-'.$from[1].'-'.$from[0];
            } else {
                $from = "0000-00-00";
            }
            $archive->date = $from;

            $archive->title = $request->msgTitle;

            $archive->type = $request->msgType;

            $archive->serisal = $request->msgid;

            $archive->url = $request->url;

            $archive->add_by = Auth()->user()->id;

            //dd( $request->customername=='0',$request->customername,$archive);
            $archive->save();

            $files_ids = $request->formDataaaorgIdList;

            $sum = 0;
            $countAttachments = 0;
            if ($files_ids) {

                foreach ($files_ids as $id) {

                    $file = File::find($id);

                    $file->archive_id = $archive->id;

                    $file->model_name = "App\Models\Archive";
                    if ($file && $file->size) {
                        $size = $file->size;
                        if ($size && $size != '0') {
                            $countAttachments++;
                        }
                        if (str_contains($size, 'mb')) {
                            $size = (float)$size * 1000;
                        }
                        $sum = $sum +  (float)$size;
                    }

                    $file->save();

                }

            }
            $archive->sizeAttachments = $sum;
            $archive->countAttachments = $countAttachments;
            $archive->save();

            if ($request->copyToText[0] != null) {

                for ($i = 0; $i < count($request->copyToText); $i++) {

                    $copyTo = new CopyTo();

                    $copyTo->archive_id = $archive->id;

                    $copyTo->model_id = $request->copyToID[$i];

                    $copyTo->name = $request->copyToCustomer[$i];

                    $copyTo->model_name = $request->copyToType[$i];

                    $copyTo->save();

                }

            }

        }

        if ($archive) {

            return response()->json(['success' => trans('admin.archive_added')]);

        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function cit_archieve()

    {

        $type = 'citArchive';

        $url = "cit_archieve";
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();
        $archive_type = Constant::where('parent', 52)->where('status', 1)->get();
        /*
        $projArchive = ArchiveType::where('type', 'projArchive')->get();

        $empArchive = ArchiveType::where('type', 'empArchive')->get();

        $citArchive = ArchiveType::where('type', 'citArchive')->get();

        $depArchive = ArchiveType::where('type', 'depArchive')->get();
        */
        return view('dashboard.archive.outArchive', compact('type', 'archive_config', 'archive_type', 'url'));

    }

    public function dep_archieve()

    {

        $type = 'contractArchive';

        $url = "contract_archieve";
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();
        $archive_type = Constant::where('parent', 51)->where('status', 1)->get();
        /*
        $projArchive = ArchiveType::where('type', 'projArchive')->get();

        $empArchive = ArchiveType::where('type', 'empArchive')->get();

        $citArchive = ArchiveType::where('type', 'citArchive')->get();

        $depArchive = ArchiveType::where('type', 'depArchive')->get();
        */
        return view('dashboard.archive.outArchive', compact('type', 'archive_config', 'archive_type', 'url'));

    }

    public function projArchive()

    {

        $type = 'projArchive';

        $url = "proj_archieve";
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();
        $archive_type = Constant::where('parent', 53)->where('status', 1)->get();

        return view('dashboard.archive.outArchive',
                compact('archive_config', 'type', 'archive_type', 'url'));

    }

    public function munArchive()

    {

        $type = 'munArchive';

        $url = "mun_archieve";

        $archive_type = ArchiveType::where('type', 'munArchive')->get();

        $projArchive = ArchiveType::where('type', 'projArchive')->get();

        $empArchive = ArchiveType::where('type', 'empArchive')->get();

        $citArchive = ArchiveType::where('type', 'citArchive')->get();

        $depArchive = ArchiveType::where('type', 'depArchive')->get();

        return view('dashboard.archive.outArchive',
                compact('depArchive', 'citArchive', 'type', 'archive_type', 'url', 'projArchive', 'empArchive'));

    }

    public function licArchive()

    {

        $type = 'licArchive';
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();
        $url = "lic_archieve";

        $attachment_type = Constant::where('parent', 18)->where('status', 1)->get();

        $license_type = Constant::where('parent', 11)->where('status', 1)->get();

        return view('dashboard.archive.licArchive',
                compact('type', 'attachment_type', 'archive_config', 'license_type', 'url'));

    }

    public function financeArchive()
    {

        $type = 'financeArchive';

        $attachment_type = Constant::where('parent', 106)->where('status', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();
        $license_type = Constant::where('parent', 6485)->where('status', 1)->get();

        $url = "finance_archive";

        return view('dashboard.archive.licFileArchive',
                compact('type', 'archive_config', 'attachment_type', 'license_type', 'url'));

    }

    public function store_finance_archive(Request $request)
    {
        $connectTo = $this->preparconnectTo($request->connectedToID, $request->connectedToType);
        $attach = array();
        $attachName = $request->attachName;
        $attachFile = $request->attachFile;
        $attachFile_ids = $request->attachFile_id;
        for ($i = 0; $i < sizeof($attachName); $i++) {
            $temp = array();
            $temp[$attachName[$i]] = $attachFile[$i];
            $temp['id'] = $attachFile_ids[$i];
            $attach[] = $temp;
        }

        //dd($attach);
        $archive = Archive::where('id', $request->ArchiveID)->first();
        if ($archive) {
            // dd($request->all());
            $archive->model_id = $request->supplierid;
            $archive->type_id = $request->financeType;
            $archive->name = $request->suppliername == '0' ? '' : $request->suppliername;
            $archive->model_name = $request->supplierType;
            if ($request->date) {
                $from = explode('/', ($request->date));
                $from = $from[2].'-'.$from[1].'-'.$from[0];
            } else {
                $from = "0000-00-00";
            }
            $archive->date = $from;
            $archive->title = $request->notes;
            $archive->type = $request->msgType;
            // $archive->serisal = $request->msgid;
            $archive->url = $request->url;
            // $archive->fileIDs = $request->AttahType;
            $archive->json_feild = json_encode($attach);
            $archive->add_by = Auth()->user()->id;
            $archive->connect_to = $connectTo;
            $archive->save();
            $prevFiles = File::where('model_name', "App\Models\Archive")->where('archive_id', $archive->id)->get();
            foreach ($prevFiles as $prevFile) {
                $prevFile->archive_id = 0;
                $prevFile->save();
            }

            $sum = 0;
            $countAttachments = 0;
            if ($attachFile_ids) {
                foreach ($attachFile_ids as $id) {
                    $file = File::find($id);
                    $file->archive_id = $archive->id;
                    $file->model_name = "App\Models\Archive";
                    if ($file && $file->size) {
                        $size = $file->size;
                        if ($size && $size != '0') {
                            $countAttachments++;
                        }
                        if (str_contains($size, 'mb')) {
                            $size = (float)$size * 1000;
                        }
                        $sum = $sum +  (float)$size;
                    }
                    $file->save();
                }
            }
            $archive->sizeAttachments = $sum;
            $archive->countAttachments = $countAttachments;
            $archive->save();
            /*
                
                CopyTo::where('archive_id',$archive->id)->delete();
                if ($request->copyToText[0] != null) {
    
                    for ($i = 0; $i < count($request->copyToText); $i++) {
    
                        $copyTo = new CopyTo();
    
                        $copyTo->archive_id =  $archive->id;
    
                        $copyTo->model_id =  $request->copyToID[$i];
    
                        $copyTo->name =  $request->copyToCustomer[$i];
    
                        $copyTo->model_name =  $request->copyToType[$i];
    
                        $copyTo->save();
    
                    }
    
                }
            */
        } else {
            $archive = new Archive();
            $archive->model_id = $request->supplierid;
            $archive->type_id = $request->financeType;
            $archive->name = $request->suppliername == '0' ? '' : $request->suppliername;
            $archive->model_name = $request->supplierType;
            if ($request->date) {
                $from = explode('/', ($request->date));
                $from = $from[2].'-'.$from[1].'-'.$from[0];
            } else {
                $from = "0000-00-00";
            }
            $archive->date = $from;
            $archive->title = $request->notes;
            $archive->type = $request->msgType;
            $archive->serisal = $request->msgid;
            $archive->url = $request->url;
            $archive->add_by = Auth()->user()->id;
            $archive->json_feild = json_encode($attach);
            $archive->connect_to = $connectTo;
            $archive->save();
            $sum = 0;
            $countAttachments = 0;
            if ($attachFile_ids) {
                foreach ($attachFile_ids as $id) {
                    $file = File::find($id);
                    $file->archive_id = $archive->id;
                    $file->model_name = "App\Models\Archive";
                    if ($file && $file->size) {
                        $size = $file->size;
                        if ($size && $size != '0') {
                            $countAttachments++;
                        }
                        if (str_contains($size, 'mb')) {
                            $size = (float)$size * 1000;
                        }
                        $sum = $sum +  (float)$size;
                    }
                    $file->save();
                }
            }
            $archive->sizeAttachments = $sum;
            $archive->countAttachments = $countAttachments;
            $archive->save();
            /*
            if ($request->copyToText[0] != null) {

                for ($i = 0; $i < count($request->copyToText); $i++) {

                    $copyTo = new CopyTo();

                    $copyTo->archive_id =  $archive->id;

                    $copyTo->model_id =  $request->copyToID[$i];

                    $copyTo->name =  $request->copyToCustomer[$i];

                    $copyTo->model_name =  $request->copyToType[$i];

                    $copyTo->save();

                }

            }
            */

        }

        if ($archive) {

            return response()->json(['success' => trans('admin.archive_added'), 'id' => $archive->id]);

        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function tradeArchive()
    {

        $type = 'tradeArchive';

        $attachment_type = Constant::where('parent', 106)->where('status', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();
        $license_type = Constant::where('parent', 105)->where('status', 1)->get();
        $tradeNo = TradeArchive::where('trade_archives.enabled', 1)->count() + 1;
        $url = "trade_archive";

        return view('dashboard.archive.tradeArchive',
                compact('tradeNo', 'type', 'archive_config', 'attachment_type', 'license_type', 'url'));

    }

    public function store_trade_archive(Request $request)
    {
        $connectTo = $this->preparconnectTo($request->connectedToID, $request->connectedToType);
        $attach = array();
        $attachName = $request->attachName;
        $attachFile = $request->attachFile;
        $attachIds = $request->attachIds;
        for ($i = 0; $i < sizeof($attachName); $i++) {
            $temp = array();
            $temp[$attachName[$i]] = $attachFile[$i];
            $attach[] = $temp;
        }

        $archive = TradeArchive::where('id', $request->ArchiveID)->first();
        if ($archive == null) {
            $archive = new TradeArchive();
        }

        $archive->trade_type = $request->tradeType;
        $archive->trade_no = $request->tradeNo;
        $archive->model_id = $request->supplierid;
        $archive->name = $request->supplierName;
        $archive->model_name = $request->supplierType;
        $archive->vehicle_name = $request->vehicleName;
        $archive->vehicle_no = $request->vehicleNo;
        $archive->vehicle_id = $request->vehicleId;
        $archive->document_place = $request->documentPlace;
        $archive->plateNo = $request->plateNo;
        $archive->driverName = $request->driverName;
        $archive->driverPhone = $request->driverPhone;
        $archive->url = $request->url;
        $archive->notes = $request->notes;
        $archive->connect_to = $connectTo;
        if ($request->attachIds == null) {
            $attachIds = array();
        }
        $archive->attach_ids = json_encode($attachIds);
        if ($request->date) {
            $from = explode('/', ($request->date));

            $from = $from[2].'-'.$from[1].'-'.$from[0];
        } else {
            $from = "0000-00-00";
        }
        $archive->date = $from;
        $archive->json_feild = json_encode($attach);
        $archive->add_by = Auth()->user()->id;
        $archive->save();

        if ($archive) {
            $vehicle = Vehicle::find($archive->vehicle_id);
            if ($vehicle != null) {
                $vehicle->currentOwner = $archive->name;
                $vehicle->save();
            }
            return response()->json(['success' => trans('admin.archive_added'), 'id' => $archive->id]);

        }

        return response()->json(['error' => $validator->errors()->all(), 'id' => $archive->id]);

    }

    public function archieveTrade_info_all(Request $request)
    {
        // dd($request->all());
        $type = $request['type'];
        $archive_config = ArchiveRole::where('type', $type)->get();
        $my_id = strval(Auth()->user()->id);
        $ids = [];
        $t = [];
        for ($i = 0; $i < count($archive_config); $i++) {
            $t = json_decode($archive_config[$i]->archiveroles);
            for ($j = 0; $j < count($t); $j++) {
                if ($t[$j] == $my_id) {
                    array_push($ids, $archive_config[$i]->empid);
                }
            }
        }
        array_push($ids, (int) $my_id);

        $archive = TradeArchive::select('trade_archives.*', 't_constant.name as trade_type_name')
                ->where('trade_archives.enabled', 1)->whereIn('add_by', $ids)
                ->leftJoin('t_constant', 't_constant.id', 'trade_archives.trade_type')
                ->with('Admin')
                ->orderBy('id', 'DESC')->get();

        // dd($archive);
        foreach ($archive as $row) {
            $row->connect_to=$this->getConnectedArchive($row->connect_to->connectToArchive,$row->connect_to->connectToTrade);
            if ($row->model_name) {
                $st = $row->model_name;
                $url = explode('\\', ($st));
                $url = Str::lower($url[2]);
                $url = $url."s";
                if ($url == 'specialassets') {
                    $url = 'special_assets';
                }
                //$row->files[]=$temp;
                $uu = DB::select('select url,name from '.$url.' where id='.$row->model_id);
                if ($uu != []) {
                    $uu = $uu[0];
                }
                $row->setAttribute('url', $uu);
            } else {
                $row->setAttribute('url', array());
            }
            $attach = json_decode($row->json_feild);
            $attachIds = json_decode($row->attach_ids) ?? array();
            $rawFiles = File::whereIn('id', $attachIds)->get();
            $count = sizeof($attachIds);
            $i = 0;
            $files = array();
            foreach ($attach as $key => $value) {
                // dd($value);
                foreach ((array) $value as $key => $val) {
                    $temp = array();
                    if ($i < $count) {
                        $temp['id'] = $attachIds[$i];
                        $temp['file_links'] = $rawFiles[$i]->file_links;
                        $i++;
                    } else {
                        $temp['id'] = 0;
                        $temp['file_links'] = [];
                    }
                    $temp['real_name'] = $key;
                    $temp['url'] = $val;

                }
                array_push($files, $temp);
                // dd($temp);
            }
            $row['arch_files'] = $files;
        }


        /*foreach ($archive as $row) {
            $attach = json_decode($row->json_feild);
            $attachIds = json_decode($row->attach_ids) ?? array();
            $rawFiles = File::whereIn('id', $attachIds)->get();
            $count = sizeof($attachIds);
            $i = 0;
            $files = array();
            foreach ($attach as $key => $value) {
                // dd($value);

                foreach ((array) $value as $key => $val) {
                    $temp = array();
                    if ($i < $count) {
                        $temp['id'] = $attachIds[$i];
                        $temp['file_links'] = $rawFiles[$i]->file_links;
                        $i++;
                    } else {
                        $temp['id'] = 0;
                        $temp['file_links'] = [];
                    }
                    $temp['real_name'] = $key;
                    $temp['url'] = $val;

                }
                array_push($files, $temp);
                // dd($temp);
            }
            $row['arch_files'] = $files;
        }*/

        return DataTables::of($archive)->addIndexColumn()->make(true);

    }

    public function tradeArchive_info(Request $request)
    {

        $archive['info'] = TradeArchive::where('id', $request['archive_id'])->first();
        $archive['connect_to'] = array();
        $archive['connect_to'] = $this->getConnectedArchive($archive['info']->connect_to->connectToArchive,$archive['info']->connect_to->connectToTrade);

        //dd($archive['info']);
//        foreach ($archive['info'] as $row) {
            $attach = json_decode($archive['info']->json_feild);
            $attachIds = json_decode($archive['info']->attach_ids) ?? array();
            $rawFiles = File::whereIn('id', $attachIds)->get();
            $count = sizeof($attachIds);
            $i = 0;
            foreach ($attach as $key => $value) {
                foreach ((array) $value as $key => $val) {
                    $temp = array();
                    if ($i < $count) {
                        $temp['id'] = $attachIds[$i];
                        $temp['file_links'] = $rawFiles[$i]->file_links;
                        $i++;
                    } else {
                        $temp['id'] = 0;
                        $temp['file_links'] = [];
                    }
                    $temp['real_name'] = $key;
                    $temp['url'] = $val;
                }
                //dd($temp);
                $archive['files'][] = $temp;
            }
//        }

        $type = $request['type'];
//        $archive['info'] = $archive['info'][0];

        return response()->json($archive);

    }

    public function tradeArchive_delete(Request $request)
    {

        $archive = TradeArchive::find($request['archive_id']);
        $archive->deleted_by = Auth()->user()->id;
        $archive->enabled = 0;
        $archive->save();
        if ($archive) {

            return response()->json(['success' => trans('admin.subscriber_added')]);

        }

        return response()->json(['error' => $validator->errors()->all()]);

    }

    public function jobLicArchive()

    {

        $type = 'jobLicArchive';

        $url = "jobLic_archieve";
        $archive_config = ArchiveRole::where('type', $type)->get();
        $craftType = Constant::where('parent', '103')->where('status', 1)->get();

        $limitNumber = LimitNumber::get();

        $licenseRating = Constant::where('parent', '104')->where('status', 1)->get();

        $attachment_type = AttachmentType::get();

        $setting = Setting::first();

        $regions = Constant::where('parent', '154')->where('status', 1)->get();

        return view('dashboard.archive.jobLicArchive',
                compact('type', 'attachment_type', 'archive_config', 'url', 'craftType', 'limitNumber', 'licenseRating',
                        'regions'));

    }

    public function reportArchive()

    {

        $type = 'reportArchive';

        $url = "report_archieve";
        $attachment_type = Constant::where('parent', 18)->where('status', 1)->get();
        $archive_type_mun = Constant::where('parent', 49)->where('status', 1)->get();
        $license_type = Constant::where('parent', 11)->where('status', 1)->get();
        // $attachment_type = AttachmentType::get();

        // $license_type = LicenseType::get();

        return view('dashboard.archive.rptArchive',
                compact('type', 'attachment_type', 'archive_type_mun', 'license_type', 'url'));

    }

    public function jalArchive()

    {

        $type = 'agArchive';

        $url = "jal_archieve";

        $archive_type = Constant::where('parent', 99)->where('status', 1)->get();
        $archive_config = ArchiveRole::where('empid', Auth()->user()->id)->where('type', $type)->first();
        return view('dashboard.archive.jalArchive', compact('type', 'archive_type', 'url', 'archive_config'));

    }

    public function agendaArchive()

    {

        $agendaExtention = AgendaExtention::where('enabled', 1)->get();
        foreach ($agendaExtention as $agenda) {
            if ($agenda->employee == null) {
                $agenda->employee = json_encode(array());
            }
        }
        $type = 'agenda_archieve';

        $url = "agenda_archieve";

        $archive_type = AgendaExtention::get();

        return view('dashboard.archive.agenda', compact('type', 'archive_type', 'url', 'agendaExtention'));

    }

    public function agenda_info_all()
    {
        $emp = Auth()->user()->id;
        $mymeetings = AgendaExtention::where('enabled', 1)->whereJsonContains('employee', strval($emp))->pluck('id');
        // dd($mymeetings);
        if (Auth()->user()->id == 74) {
            $agendas = AgendaDetail::where('enabled',
                    1)->with('AgendaTopic')->with('AgendaExtention')->orderBy('created_at', 'DESC')->get();
        } else {
            $agendas = AgendaDetail::where('enabled', 1)->whereIn('agenda_extention_id',
                    $mymeetings)->with('AgendaTopic')->with('AgendaExtention')->orderBy('created_at', 'DESC')->get();
        }
        foreach ($agendas as $agenda) {
            if ($agenda->file_ids != null) {
                $files = json_decode($agenda->file_ids);
                $fileArr = array();
                foreach ($files as $file) {
                    $temp = File::where('id', $file->attach_ids)->first();
                    if ($temp != null) {
                        array_push($fileArr, $temp);
                    }
                }
                $agenda->files = $fileArr;
                $agenda->file_ids = $files;
            }
        }
        return DataTables::of($agendas)->addIndexColumn()->make(true);
    }

    public function agendaReportArchive()

    {
        $agendaExtention = AgendaExtention::get();

        $type = 'agenda_report';

        $url = "agenda_report";

        $archive_type = ArchiveType::get();

        return view('dashboard.archive.agendaReport', compact('type', 'archive_type', 'agendaExtention', 'url'));

    }

    public function jobLicReport()

    {

        $type = 'jobLicReport';

        $url = "jobLic_report";

        $attachment_type = AttachmentType::get();

        $license_type = LicenseType::get();
        $regions = Region::get();

        return view('dashboard.archive.jobLicReport',
                compact('type', 'attachment_type', 'license_type', 'url', 'regions'));

    }

    public function printArchive($type = null, $id)
    {
        if ($type == 'archive') {
            $archive = Archive::where('id', $id)->with('archiveType')->with('Admin')->first();
        } else if ($type == 'trade') {
            $archive = TradeArchive::where('id', $id)->with('Admin')->first();
        }
        $urlfile = asset('');
        $archive->link = $urlfile.'ar/admin/'.$archive->url.'/?id='.$archive->id;
        return view('dashboard.archive.printArchive', compact('archive'));
    }

    public function archieve_info_all(Request $request)
    {

        $type = $request['type'];
        $archive_config = ArchiveRole::where('type', $type)->get();
        $my_id = strval(Auth()->user()->id);
        $ids = [];
        $t = [];
        for ($i = 0; $i < count($archive_config); $i++) {
            $t = json_decode($archive_config[$i]->archiveroles);
            for ($j = 0; $j < count($t); $j++) {
                if ($t[$j] == $my_id) {
                    array_push($ids, $archive_config[$i]->empid);
                }
            }
        }
        array_push($ids, (int) $my_id);

        $archive = Archive::select('archives.*')->where('type', $type)
                ->where('enabled', '1')->whereIn('add_by', $ids)->orderBy('id',
                        'DESC')->with('archiveType')->with('Admin')->with('copyTo')->with('files')->get();
        // dd($archive->all());
        foreach ($archive as $row) {
            $row->connect_to=$this->getConnectedArchive($row->connect_to->connectToArchive,$row->connect_to->connectToTrade);
            if ($row->model_name) {
                $st = $row->model_name;
                $url = explode('\\', ($st));
                $url = Str::lower($url[2]);
                $url = $url."s";
                if ($url == 'specialassets') {
                    $url = 'special_assets';
                }
                //$row->files[]=$temp;
                $uu = DB::select('select url,name from '.$url.' where id='.$row->model_id);
                if ($uu != []) {
                    $uu = $uu[0];
                }
                $row->setAttribute('url', $uu);
            } else {
                $row->setAttribute('url', array());
            }
        }

        return DataTables::of($archive)->addIndexColumn()
                ->editColumn('date', function ($archive) {
                    if ($archive->date) {
                        $actionBtn = " ";
                        $from = explode('-', ($archive->date));
                        $from = $from[2].'/'.$from[1].'/'.$from[0];
                        $actionBtn = $from;
                        return $actionBtn;
                    } else {
                        return '';
                    }
                })
                ->addColumn('copyTo', function ($archive) {
                    if ($archive->copyTo) {
                        $actionBtn = " ";
                        foreach ($archive->copyTo as $copyTo) {
                            if ($copyTo->enabled == 1) {
                                $actionBtn .= ' '.$copyTo->name.', ';
                            }
                        }
                        return $actionBtn;
                    } else {
                        return '';
                    }
                })->make(true);

    }

    public function jalArchieve_info_all(Request $request)
    {
        $archive = Archive::where('type', 'agArchive')->where('archives.enabled', 1)
                ->select('archives.*', 't_constant.name as type_id_name')
                ->leftJoin('t_constant', 't_constant.id', 'archives.type_id')
                ->orderBy('id', 'DESC')->with('relatedTo')->with('files');
        if ($request->search_Linked_to_id != 0 && $request->search_Linked_to_model != 0) {
            $linkedTo = linkedTo::where('model_name', $request->search_Linked_to_model)
                    ->where('model_id', $request->search_Linked_to_id)->where('enabled', 1)->first();
            if ($linkedTo) {
                $archive = $archive->where('archives.id', $linkedTo->archive_id)->get();
            }
        } else if (strlen(trim($request->search_Linked_to)) > 0) {
            $linkedTos = linkedTo::where('name', 'like', '%'.$request->search_Linked_to.'%')->where('enabled',
                    1)->get('archive_id');
            $archiveIds = [];
            foreach ($linkedTos as $linkedTo) {
                $archiveIds[] = $linkedTo->archive_id;
            }
            $archive = $archive->whereIn('archives.id', $archiveIds)->get();
        } else {
            $archive = $archive->get();
        }

        foreach ($archive as $row) {
            if ($row->relatedTo) {
                foreach ($row->relatedTo as $related_to) {
                    $st = $related_to->model_name;
                    if ($st != 0) {
                        $url = explode('\\', ($st));
                        $url = Str::lower($url[2]);
                        $url = $url."s";
                        if ($url == 'specialassets') {
                            $url = 'special_assets';
                        }
                        //$row->files[]=$temp;
                        $uu = DB::select('select url,name from '.$url.' where id='.$related_to->model_id);
                        if ($uu != []) {
                            $uu = $uu[0];
                        }
                        $related_to->setAttribute('url', $uu);
                    }

                }
            }
        }
        return DataTables::of($archive)->addIndexColumn()/*->addColumn('relatedTo', function ($archive) {

            if ($archive->relatedTo) {

                $actionBtn = " ";

                foreach ($archive->relatedTo as $related_to) {

                    $actionBtn .= ' ' . $related_to->name . ' ';

                }

                return $actionBtn;

            } else {

                return '';

            }

        })*/ ->make(true);

    }

    public function archievelic_info_all(Request $request)
    {
        // dd($request->all());
        $type = $request['type'];
        $archive_config = ArchiveRole::where('type', $type)->get();
        $my_id = strval(Auth()->user()->id);
        $ids = [];
        $t = [];
        for ($i = 0; $i < count($archive_config); $i++) {
            $t = json_decode($archive_config[$i]->archiveroles);
            for ($j = 0; $j < count($t); $j++) {
                if ($t[$j] == $my_id) {
                    array_push($ids, $archive_config[$i]->empid);
                }
            }
        }
        array_push($ids, (int) $my_id);

        $archive = ArchiveLicense::select('archive_licenses.*', 't_constant.name as license_type_name',
                'licenses.notes as notes')
                ->where('archive_licenses.type', $type)->where('archive_licenses.enabled', 1)->whereIn('add_by', $ids)
                ->leftJoin('t_constant', 't_constant.id', 'archive_licenses.license_id')
                ->leftJoin('licenses', 'licenses.fileNo', 'archive_licenses.fileNo')
                ->with('Admin')
                ->orderBy('id', 'DESC')->get();
        foreach ($archive as $row) {
            $attach = json_decode($row->json_feild);
            $files = array();
            foreach ($attach as $id) {
                $temp = (array) $id;
                $file = File::find($id->id);
                $file->real_name = array_search($file->url, $temp);
                $files[] = $file;
            }
            $row->files = $files;
        }

        return DataTables::of($archive)->addIndexColumn()->make(true);

    }

    public function financeArchive_info_all(Request $request)
    {
        // dd($request->all());
        // $type = $request['type'];
        $type = 'financeArchive';
        $archive_config = ArchiveRole::where('type', $type)->get();
        $my_id = strval(Auth()->user()->id);
        $ids = [];
        $t = [];
        for ($i = 0; $i < count($archive_config); $i++) {
            $t = json_decode($archive_config[$i]->archiveroles);
            for ($j = 0; $j < count($t); $j++) {
                if ($t[$j] == $my_id) {
                    array_push($ids, $archive_config[$i]->empid);
                }
            }
        }
        array_push($ids, (int) $my_id);

        $archive = Archive::select('archives.*')->where('type', 'financeArchive')
                ->where('enabled', '1')->orderBy('id',
                        'DESC')->with('archiveType')->with('Admin');
        if(Auth()->user()->id==74){
            $archive = $archive->get();
        }else{
            $archive = $archive->whereIn('add_by', $ids)->get();
        }
        foreach ($archive as $row) {
            $row->connect_to=$this->getConnectedArchive($row->connect_to->connectToArchive,$row->connect_to->connectToTrade);
            if ($row->model_name) {
                $st = $row->model_name;
                $url = explode('\\', ($st));
                $url = Str::lower($url[2]);
                $url = $url."s";
                //$row->files[]=$temp;
                $uu = DB::select('select url from '.$url.' where id='.$row->model_id);
                if ($uu != []) {
                    $uu = $uu[0];
                }
                $row->setAttribute('url', $uu);
            } else {
                $row->setAttribute('url', array());
            }
            $attach = json_decode($row->json_feild);
            $files = array();
            foreach ($attach as $id) {
                $temp = (array) $id;
                $file = File::find($id->id);
                $file->real_name = array_search($file->url, $temp);
                $files[] = $file;
            }
            $row->files = $files;
        }

        return DataTables::of($archive)->addIndexColumn()
                ->editColumn('date', function ($archive) {
                    if ($archive->date) {

                        $actionBtn = " ";
                        $from = explode('-', ($archive->date));

                        $from = $from[2].'/'.$from[1].'/'.$from[0];
                        $actionBtn = $from;
                        return $actionBtn;

                    } else {

                        return '';

                    }

                })->make(true);

    }

    public function archieveJoblic_info_all(Request $request)
    {

        // $archive = jobLicArchieve::select('job_lic_archieves.*', 'craft_types.name as craft_name', 'license_ratings.name as license_ratings_name')->leftJoin('craft_types', 'craft_types.id', 'job_lic_archieves.craft_type_id')->leftJoin('license_ratings', 'license_ratings.id', 'job_lic_archieves.license_rating_id')->where('job_lic_archieves.enabled',1)->orderBy('id', 'DESC')->with('files')->get();
        $type = 'jobLicArchive';
        $archive_config = ArchiveRole::where('type', $type)->get();
        $my_id = strval(Auth()->user()->id);
        $ids = [];
        $t = [];
        for ($i = 0; $i < count($archive_config); $i++) {
            $t = json_decode($archive_config[$i]->archiveroles);
            for ($j = 0; $j < count($t); $j++) {
                if ($t[$j] == $my_id) {
                    array_push($ids, $archive_config[$i]->empid);
                }
            }
        }
        array_push($ids, (int) $my_id);

        $archive = jobLicArchieve::select('job_lic_archieves.*')->whereIn('added_by',
                $ids)->where('job_lic_archieves.enabled', 1)->with('craftType')->with('licenseRating')->orderBy('id',
                'DESC')->with('files')->get();

        return DataTables::of($archive)->addIndexColumn()->addColumn('status', function ($archive) {

            $from = explode('/', ($archive->start_date));

            $from = $from[2].'-'.$from[1].'-'.$from[0];

            $to = explode('/', ($archive->expiry_ate));

            $to = $to[2].'-'.$to[1].'-'.$to[0];

            if ($from < $to) {

                return 'فعالة';

            }

            return 'منتهية';

        })->make(true);

    }

    public function getConnectedArchive($connectToArchiveIds,$connectToTradeIds): array
    {
        $connectToArchive = Archive::whereIn('id', $connectToArchiveIds)->where('type','!=','financeArchive')->get([
                'id', 'title', 'type','url'
        ]);

        $connectToTrade = TradeArchive::whereIn('trade_archives.id', $connectToTradeIds)
                ->select(DB::raw("CONCAT(trade_no ,' ',t_constant.name )AS title"), 'trade_archives.id',
                        'trade_no as serisal', DB::raw("CONCAT('trade_archive')AS type"),'url')
                ->leftJoin('t_constant', 't_constant.id', 'trade_archives.trade_type')->get();

        $financeArchive = Archive::whereIn('archives.id', $connectToArchiveIds)
                ->where('type','financeArchive')
                ->leftJoin('t_constant', 't_constant.id', 'archives.type_id')
                ->select("t_constant.name AS title", 'archives.id','serisal', 'type','url')->get();
        return ([...$connectToArchive, ...$connectToTrade,...$financeArchive]??[]);
    }

    public function archieve_info(Request $request)
    {
        $archive['info'] = Archive::find($request['archive_id']);
        $archive['connect_to'] = array();
        $archive['connect_to'] = $this->getConnectedArchive($archive['info']->connect_to->connectToArchive,$archive['info']->connect_to->connectToTrade);
        $archive['files'] = File::where('archive_id', '=', $request['archive_id'])->where('model_name',
                'App\Models\Archive')->get();
        $archive['CopyTo'] = CopyTo::where('archive_id', '=', $request['archive_id'])->where('enabled', 1)->get();
        return response()->json($archive);
    }

    public function financeArchive_info(Request $request)
    {
        $archive['info'] = Archive::where('id', $request['archive_id'])->first();
        $attach = json_decode($archive['info']->json_feild);
        $files = array();
        foreach ($attach as $id) {
            $temp = (array) $id;
            $file = File::find($id->id);
            $file->real_name = array_search($file->url, $temp);
            $files[] = $file;
        }
        $archive['files'] = $files;
        $archive['connect_to'] = array();
        $archive['connect_to'] = $this->getConnectedArchive($archive['info']->connect_to->connectToArchive,$archive['info']->connect_to->connectToTrade);
        return response()->json($archive);
    }

    public function archieve_report(Request $request)
    {
        // dd($request->all());
        if ($request->get('arcType') == "licArchive" || $request->get('arcType') == "licFileArchive") {

            $archive['type'] = "lic";

            $archive['result'] = ArchiveLicense::query()->with('Admin');

            if ($request->get('customerid')) {

                $archive['result']->where('model_id', $request['customerid'])
                        ->where('model_name', $request->get('customerType'));
            }

            if ($request->get('arcType')) {

                $archive['result']->where('type', '=', $request->get('arcType'));

            }

            if ($request->get('BuildingData')) {

                if ($request->get('BuildingData') == "-1") {

                } else {

                    $archive['result']->where('license_type', '=', $request->get('BuildingData'));

                }

            }

            if ($request->get('BuildingTypeData')) {

                if ($request->get('BuildingTypeData') == "-1") {

                } else {

                    $archive['result']->where('license_id', '=', $request->get('BuildingTypeData'));

                }

            }

            if ($request->get('archNo')) {

                $archive['result']->where('licNo', '=', $request->get('archNo'));

            }

            if ($request->get('start') && $request->get('end')) {

                $from = date_create(($request->get('start')));

                $from = explode('/', ($request->get('start')));

                $from = $from[2].'-'.$from[1].'-'.$from[0];

                $to = date_create(($request->get('end')));

                $to = explode('/', ($request->get('end')));

                $to = $to[2].'-'.$to[1].'-'.$to[0];

                $archive['result']->whereRaw('CAST(archive_licenses.created_at AS DATE) between ? and ?', [$from, $to]);

            }
            $archive['result'] = $archive['result']->select('archive_licenses.*',
                    't_constant.name as license_type_name')
                    ->selectRaw('DATE_FORMAT(archive_licenses.created_at, "%Y-%m-%d") as date')
                    ->leftJoin('t_constant', 't_constant.id', 'archive_licenses.license_id')
                    ->get();
            foreach ($archive['result'] as $row) {
                $attach = json_decode($row->json_feild);
                $files = array();
                foreach ($attach as $id) {
                    $temp = (array) $id;
                    $file = File::find($id->id);
                    $file->real_name = array_search($file->url, $temp);
                    $files[] = $file;
                }
                $row->files = $files;
            }
//            foreach ($archive['result'] as $row) {
//                $attach = json_decode($row->json_feild);
//                foreach ($attach as $key => $value) {
//                    foreach ((array) $value as $key => $val) {
//                        $temp = array();
//                        $temp['id'] = 0;
//                        $temp['real_name'] = $key;
//                        $temp['url'] = $val;
//                    }
//                    //dd($temp);
//                    $row->files[] = $temp;
//                }
//            }

        } else {

            $archive['type'] = "all";

            $archive['result'] = Archive::query()->with('Admin');

            if ($request->get('customerid')) {

                $archive['result']->where('model_id', $request['customerid'])->where('enabled', 1)
                        ->where('model_name', $request->get('customerType'));
            }

            if ($request->get('arcType')) {

                if ($request->get('arcType') == "all" && $request->get('msgType') != "taskArchiveReport") {

                } else if ($request->get('arcType') == "all" && $request->get('msgType') == "taskArchiveReport") {
                    $archive['result']->whereIn('archives.type', ['taskArchive', 'certArchive'])->where('enabled', 1);
                } else {

                    $archive['result']->where('archives.type', '=', $request->get('arcType'))->where('enabled', 1);
                    // dd($archive['result']->get());
                }

            }
            if ($request->get('orgType')) {

                if ($request->get('orgType') == "-1" || $request->get('orgType') == "" || $request->get('orgType') == null) {

                } else {

                    $archive['result']->where('archives.type_id', '=', $request->get('orgType'))->where('enabled', 1);
                    // dd($archive['result']->get());
                }

            }
            /*
                if ($request->get('archNo')) {

                    $archive['result']->where('serisal', '=', $request->get('archNo'));

                }*/

            if ($request->get('start') && $request->get('end')) {

                $from = date_create(($request->get('start')));

                $from = explode('/', ($request->get('start')));

                $from = $from[2].'-'.$from[1].'-'.$from[0];

                $to = date_create(($request->get('end')));

                $to = explode('/', ($request->get('end')));

                $to = $to[2].'-'.$to[1].'-'.$to[0];

                $archive['result']->whereBetween('date', [$from, $to])->where('enabled', 1);

            }

            $archive['result'] = $archive['result']->where('enabled', 1)->with('copyTo')->with('files')->get();

        }

        return response()->json($archive);

    }

    public function jobLic_reports(Request $request)
    {

        $archive = jobLicArchieve::query();

        if ($request->get('customerId') && $request->get('model')) {

            $archive->where('model_id', '=', $request->get('customerId'))->where('model_name', '=',
                    $request->get('model'))->where('enabled', 1);

        } else {

        }

        $archive = $archive->select('job_lic_archieves.*')->where('job_lic_archieves.enabled',
                1)->with('craftType')->with('licenseRating')->orderBy('id', 'DESC')->with('files')->get();

        return DataTables::of($archive)->addIndexColumn()->addColumn('status', function ($archive) {

            $from = explode('/', ($archive->start_date));

            $from = $from[2].'-'.$from[1].'-'.$from[0];

            $to = explode('/', ($archive->expiry_ate));

            $to = $to[2].'-'.$to[1].'-'.$to[0];

            if ($from < $to) {

                return 'فعالة';

            }

            return 'منتهية';

        })->make(true);

        return DataTables::of($archive)->addIndexColumn()->make(true);

    }

    public function archieveLic_info(Request $request)
    {
        $archive['info'] = ArchiveLicense::where('id', $request['archive_id'])->first();
        //dd($archive['info']);
        $attach = json_decode($archive['info']->json_feild);
        $files = array();
        foreach ($attach as $id) {
            $temp = (array) $id;
            $file = File::find($id->id);
            $file->real_name = array_search($file->url, $temp);
            $files[] = $file;
        }
        $archive['files'] = $files;
        return response()->json($archive);
    }

    public function job_Lic_info(Request $request)
    {

        $archive['info'] = jobLicArchieve::where('job_lic_archieves.id',
                $request['archive_id'])->where('job_lic_archieves.enabled',
                1)->select('job_lic_archieves.*')->where('job_lic_archieves.enabled',
                1)->with('craftType')->with('licenseRating')->get();

        $archive['info'] = $archive['info'][0];

        $archive['files'] = File::where('archive_id', '=', $request['archive_id'])->where('model_name',
                'App\Models\jobLicArchieve')->get();

        return response()->json($archive);

    }

    public function uploadAttach(Request $request)
    {

        if ($request->hasFile('formDataaaUploadFile')) {

            $files = $request->file('formDataaaUploadFile');

            foreach ($files as $file) {
                // dd($file);
                $url = AttatchmentManager::upload_image($file, 'quipent_');
                // dd($url);

                if ($url) {
                    $size = $url['size'];
                    if ($size > (1024 * 1024))
                        $size = round($size / 1000000, 3) . 'mb';
                    else
                        $size = round($size / 1000, 1) . 'kb';
                    $file = new File();
                    $file->url = $url['path'];
                    $file->real_name = $url['name'];
                    $file->extension = $url['extension'];
                    $file->size = $size;
                    $file->file_links = $url['fileLinks'];
                    $file->type = 2;
                    $file->save();
                    $uploaded_files['files'] = $file;
                }
                $data[] = $uploaded_files;
            }

            foreach ($data as $row) {

                $files_ids[] = $row['files']->id;

            }

            Session::put('files_ids', $files_ids);

            $all_files['all_files'] = File::whereIn('id', $files_ids)->get();

            return response()->json($all_files);

        }

    }

    public function getArchiveForConnect(Request $request)
    {
        $archive = Archive::where(function ($query) use ($request) {
            $query->where('title', 'like', '%'.$request->term.'%')
                    ->orWhere('serisal', 'like', '%'.$request->term.'%');
        })
                ->where('enabled', 1)->whereNotIn('type', ['taskArchive', 'WarningArchive', 'certArchive','financeArchive','agArchive','specialEmpArchive'])
                ->select('title', 'id', 'serisal', 'type','url', DB::raw("title AS label"));
        $tradeArchive = TradeArchive::where('trade_no', $request->term)->where('enabled', 1)->with('Type')
                ->select(DB::raw("CONCAT(trade_no ,' ',t_constant.name )AS title"), 'trade_archives.id',
                        'trade_no as serisal', DB::raw("CONCAT('trade_archive')AS type"),'url',
                        DB::raw("CONCAT(trade_no ,' ',t_constant.name )AS label"))
                ->leftJoin('t_constant', 't_constant.id', 'trade_archives.trade_type');
        $financeArchive = Archive::where('t_constant.name','like', '%'.$request->term.'%')
                ->where('type','financeArchive')->where('enabled', 1)
                ->select("t_constant.name AS title", 'archives.id','serisal', 'type','url',"t_constant.name AS label")
                ->leftJoin('t_constant', 't_constant.id', 'archives.type_id');
        $archives = $archive->unionAll($tradeArchive)->unionAll($financeArchive)->get();
        return response()->json($archives);
    }

}

