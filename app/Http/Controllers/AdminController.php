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
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Carbon;
use App\Models\user;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Auth;
use Hash;
use Redirect;
use DB;

class AdminController extends Controller
{
    function idnusr(){
        $arr    = DB::table('users')->select('users.*', 'b.name as role_name')
                    ->leftJoin('mst_role AS b', 'b.id', '=', 'users.role_id')
                    ->where('users.id', auth::user()->id)->first();
        return $arr;
    }

    function users(): object {
        $arr    = DB::table('users')->select('users.*', 'mst_role.name as level')
                ->leftJoin('mst_role', 'mst_role.id', '=', 'users.role_id')
                ->where('users.is_active', 1)
                ->whereIn('users.role_id', [1,2,3])->get();
        $role   = DB::table('mst_role')->where('is_active', 1)->get();
        $data = array(
            'title' => 'Users',
            'idnusr' => $this->idnusr(),
            'arr'   => $arr,
            'role'  => $role
        );

        return view('Admin.users')->with($data);
    }

    function category(): object {
        $arr    = DB::table('mst_category')->where('is_active', 1)->get();
        $data = array(
            'title' => 'Category',
            'idnusr' => $this->idnusr(),
            'arr'   => $arr,
        );

        return view('Admin.category')->with($data);
    }

    function table(): object {
        $arr    = DB::table('mst_table')->where('is_active', 1)->get();
        $data = array(
            'title' => 'Category',
            'idnusr' => $this->idnusr(),
            'arr'   => $arr,
        );

        return view('Admin.table')->with($data);
    }

    function addtable(Request $request) : object {
        $kode   = $request['kode'];
        $name   = $request['name'];
        $cek    = DB::table('mst_table')->where('kode', $kode)->where('is_active', 1)->get();
        if(count($cek) <= 0){
            $data   = array(
                'kode'      => $kode,
                'name'      => $name,
                'qr_code'   => $kode.'.svg',
                'status'    => 0,
                'is_active' => 1,
                'update_by' => auth::user()->id,
            );
            DB::table('mst_table')->insert([$data]);
            $qrCode = QrCode::size(300)->generate($kode);
            $filePath = 'assets/img/qrcode/'.$kode.'.svg';
            file_put_contents(public_path($filePath), $qrCode);
            return response('success');
        }else{
            return response('error');
        }
    }

    function edittable(Request $request) : object {
        $id     = $request['id'];
        $kode   = $request['kode'];
        $name   = $request['name'];
        $cek    = DB::table('mst_table')->where('kode', $kode)->where('is_active', 1)->get();
        if(count($cek) <= 0){
            $data   = array(
                'kode'      => $kode,
                'name'      => $name,
                'qr_code'   => $kode.'.svg',
                'update_by' => auth::user()->id,
            );
            DB::table('mst_table')->where('id', $id)->update($data);
            $qrCode = QrCode::size(300)->generate($kode);
            $filePath = 'assets/img/qrcode/'.$kode.'.svg';
            file_put_contents(public_path($filePath), $qrCode);

            return response('success');
        }else{
            $ce = DB::table('mst_table')->where('id', $id)->first();
            if($ce->kode == $kode){
                $data   = array(
                    'name'      => $name,
                    'update_by' => auth::user()->id,
                );
                DB::table('mst_table')->where('id', $id)->update($data);
                return response('success');
            }else{
                return response('error');
            }
        }
    }

    function product(): object {
        $arr    = DB::table('trx_product')->select('trx_product.*', 'mst_category.name as cat_name')
                ->leftJoin('mst_category', 'mst_category.id', '=', 'trx_product.category_id')
                ->whereIn('trx_product.is_active', [1,2])->get();
        $cat    = DB::table('mst_category')->where('is_active', 1)->get();
        $data = array(
            'title' => 'Users',
            'idnusr' => $this->idnusr(),
            'arr'   => $arr,
            'cat'  => $cat
        );

        return view('Admin.product')->with($data);
    }

}
