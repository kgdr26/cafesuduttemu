<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Carbon;
use App\Models\user;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Auth;
use Hash;
use Redirect;
use DB;

class MainController extends Controller
{
    function idnusr(){
        $arr    = DB::table('users')->select('users.*', 'b.name as role_name')
                    ->leftJoin('mst_role AS b', 'b.id', '=', 'users.role_id')
                    ->where('users.id', auth::user()->id)->first();
        return $arr;
    }

    function dasbor(): object {
        $start  = Carbon::now()->subDays(5);
        $end    = Carbon::now()->addDays(5);
        $data = array(
            'idnusr' => $this->idnusr(),
            'title' => 'Dashboard',
            'start' => Carbon::parse($start),
            'end' => Carbon::parse($end)
        );

        return view('Dashboard.list')->with($data);
    }

    // Upload Image
    function upload_profile(Request $request) : object {

        if($request->hasFile('add_foto')){
            $fourRandomDigit = rand(10,99999);
            $photo      = $request->file('add_foto');
            $fileName   = $fourRandomDigit.'.'.$photo->getClientOriginalExtension();

            $path = public_path().'/assets/img/profiles/';

            File::makeDirectory($path, 0777, true, true);

            $request->file('add_foto')->move($path, $fileName);

            return response($fileName);
        }elseif($request->hasFile('add_image')){
            $fourRandomDigit = rand(10,99999);
            $photo      = $request->file('add_image');
            $fileName   = $fourRandomDigit.'.'.$photo->getClientOriginalExtension();

            $path = public_path().'/assets/img/products/';

            File::makeDirectory($path, 0777, true, true);

            $request->file('add_image')->move($path, $fileName);

            return response($fileName);
        }elseif($request->hasFile('add_file')){
            $fourRandomDigit = rand(10,99999);
            $photo      = $request->file('add_file');
            $fileName   = $fourRandomDigit.'.'.$photo->getClientOriginalExtension();

            $path = public_path().'/assets/file/';

            File::makeDirectory($path, 0777, true, true);

            $request->file('add_file')->move($path, $fileName);

            return response($fileName);
        }else{
            return response('Failed');
        }

    }

    // Action Add
    function actionadd(Request $request) : object {
        $table      = $request['table'];
        $dt         = $request['data'];
        if($table == 'users'){
            $data   = array(
                'username'  => $dt['username'],
                'password'  => Hash::make($dt['password']),
                'pass'      => $dt['password'],
                'role_id'   => $dt['role_id'],
                'name'      => $dt['name'],
                'email'     => $dt['email'],
                'no_tlp'    => $dt['no_tlp'],
                'foto'      => $dt['foto'],
                'is_active' => 1,
                'update_by' => auth::user()->id,
            );
        }else{
            $data   = $request['data'];
        }
        // $data       = $request['data'];
        DB::table($table)->insert([$data]);
        return response('success');
    }

    // Action Edit
    function actionedit(Request $request) : object {
        $table      = $request['table'];
        $id         = $request['id'];
        $whr        = $request['whr'];
        $dt         = $request['dats'];
        if($table == 'users'){
            $data   = array(
                'username'  => $dt['username'],
                'password'  => Hash::make($dt['password']),
                'pass'      => $dt['password'],
                'role_id'   => $dt['role_id'],
                'name'      => $dt['name'],
                'email'     => $dt['email'],
                'no_tlp'    => $dt['no_tlp'],
                'foto'      => $dt['foto'],
                'update_by' => auth::user()->id,
            );
        }else{
            $data   = $request['dats'];
        }

        DB::table($table)->where($whr, $id)->update($data);
        return response('success');
    }

    function actioneditwmulti(Request $request) : object {
        $table      = $request['table'];
        $id1        = $request['id1'];
        $whr1       = $request['whr1'];
        $id2        = $request['id2'];
        $whr2       = $request['whr2'];
        $data       = $request['dats'];

        DB::table($table)->where($whr1, $id1)->where($whr2, $id2)->update($data);
        return response('success');
    }

    // Action Delete
    function actiondelete(Request $request) : object {
        $table      = $request['table'];
        $id         = $request['id'];
        $whr        = $request['whr'];
        $data   = array(
            'is_active' => 0,
            'update_by' => auth::user()->id,
        );
        DB::table($table)->where($whr, $id)->update($data);
        return response('success');
    }

    // Action Show Data
    function actionshowdata(Request $request) : object {
        $id     = $request['id'];
        $field  = $request['field'];
        $table  = $request['table'];
        $arr['data']    = DB::table($table)->where($field, $id)->first();
        return response($arr);
    }

    function actionshowdatawmulti(Request $request) : object {
        $id1     = $request['id1'];
        $field1  = $request['field1'];
        $id2     = $request['id2'];
        $field2  = $request['field2'];
        $table   = $request['table'];
        $arr['data']    = DB::table($table)->where($field1, $id1)->where($field2, $id2)->first();
        return response($arr);
    }

    // Action List Data
    function actionlistdata(Request $request) : object {
        if($request['id'] == 0 || $request['id'] == null){
            $id     = 1;
        }else{
            $id     = $request['id'];
        }
        $field  = $request['field'];
        $table  = $request['table'];
        $arr    = DB::select("SELECT * FROM $table WHERE $field=$id AND is_active=1 ");
        return response($arr);
    }

    function showdatadashboard(Request $request) : object {
        $date   = $request['date'];
        $prd    = DB::table('trx_product')->select('trx_product.*', 'mst_category.name as cat_name')
                    ->leftJoin('mst_category', 'mst_category.id', '=', 'trx_product.category_id')
                    ->whereIn('trx_product.is_active', [1,2])->get();

        $product    = [];
        $table      = '';
        $stock      = 0;
        $soldout    = 0;
        foreach($prd as $key => $val){
            $nameproduct    = $val->name;
            $catname        = $val->cat_name;
            $stock += $val->qty;

            $sold   = 0;
            $amount = 0;
            $listorder = DB::table('trx_ordering')->whereDate('date_order', $date)->get();
            foreach($listorder as $k => $v){
                $list = json_decode($v->orderan);
                if(isset($list)){
                    foreach($list as $a => $b){
                        if($b->id_product == $val->id){
                            $sold += $b->qty;
                            $amount += $b->total;
                            $soldout += $b->qty;
                        }
                    }
                }
            }

            $table .= '<tr>';
            $table .= '<th>'.$nameproduct.'</th>';
            $table .= '<th>'.$catname.'</th>';
            $table .= '<th>'.$sold.'</th>';
            $table .= '<th>Rp. '.number_format($amount, 0, ',', '.').'</th>';
            $table .= '</tr>';

        }

        $arr['c_product']   = count($prd);
        $arr['c_stock']     = $stock;
        $arr['c_sold']      = $soldout;
        $arr['table']       = $table;
        return response($arr);
    }

    function showchartdashboard(Request $request) : object {
        $start  = $request['start'];
        $end    = $request['end'];

        if($start == null || $end == null){
            $start  = Carbon::now()->subDays(5);
            $end    = Carbon::now()->addDays(5);
        }else{
            $start  = $request['start'];
            $end    = $request['end'];
        }

        $startDate  = Carbon::parse($start);
        $endDate    = Carbon::parse($end);

        $categories = [];
        $series     = [];
        $loop       = 0;
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dtloop = $loop++;
            $categories[$dtloop] = Carbon::parse($date->toDateString())->isoFormat('DD MMM YYYY');

            $amount = 0;
            $listorder = DB::table('trx_ordering')->whereDate('date_order', $date->toDateString())->get();
            if(count($listorder) == 0){
                $series[$dtloop] = 0;
            }else{
                foreach($listorder as $k => $v){
                    $list = json_decode($v->orderan);
                    if(isset($list)){
                        foreach($list as $a => $b){
                            $amount += $b->total;
                        }
                        $series[$dtloop] = $amount;
                    }else{
                        $series[$dtloop] = 0;
                    }
                }
            }


        }

        $arr['categories']  = $categories;
        $arr['series']      = $series;

        return response($arr);
    }

}
