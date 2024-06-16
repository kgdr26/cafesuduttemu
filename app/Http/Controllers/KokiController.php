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

class KokiController extends Controller
{
    function idnusr(){
        $arr    = DB::table('users')->select('users.*', 'b.name as role_name')
                    ->leftJoin('mst_role AS b', 'b.id', '=', 'users.role_id')
                    ->where('users.id', auth::user()->id)->first();
        return $arr;
    }

    function listpesanan(): object {
        $arr    = DB::table('trx_ordering')->select('trx_ordering.*', 'b.name', 'b.kode', 'b.qr_code')
                    ->leftJoin('mst_table as b', 'b.id', '=', 'trx_ordering.id_table')
                    ->where('trx_ordering.is_active', 1)
                    ->where('trx_ordering.status', 2)->get();

        $data = array(
            'title' => 'List Pesanan',
            'idnusr' => $this->idnusr(),
            'arr'   => $arr
        );

        return view('Koki.listpesanan')->with($data);
    }

    function actioncheklist(Request $request): object {
        $id_order   = $request['id_order'];
        $id         = $request['id'];

        $dt         = DB::table('trx_ordering')->where('id', $id_order)->first();
        $data       = json_decode($dt->orderan);

        $list_order = '';
        foreach($data as $key => $val){
            $list_order .= '{';
            $list_order .= '"id_product": "'.$val->id_product.'",';
            $list_order .= '"qty": "'.$val->qty.'",';
            $list_order .= '"price": "'.$val->price.'",';
            $list_order .= '"dine_in": "'.$val->dine_in.'",';
            $list_order .= '"take_away": "'.$val->take_away.'",';
            $list_order .= '"total": "'.$val->total.'",';

            if($key == $id){
                $list_order .= '"status": "2"';
            }else{
                $list_order .= '"status": "'.$val->status.'"';
            }

            $list_order .= '},';
        }

        $orderan    = '['.substr($list_order, 0, -1).']';
        DB::table('trx_ordering')->where('id', $id_order)->update(['orderan'=>$orderan]);

        return response('success');
    }

    function actdoneorder(Request $request): object {
        $id         = $request['id'];

        $dt         = DB::table('trx_ordering')->where('id', $id)->first();
        $data       = json_decode($dt->orderan);

        $list_order = '';
        foreach($data as $key => $val){
            $list_order .= '{';
            $list_order .= '"id_product": "'.$val->id_product.'",';
            $list_order .= '"qty": "'.$val->qty.'",';
            $list_order .= '"price": "'.$val->price.'",';
            $list_order .= '"dine_in": "'.$val->dine_in.'",';
            $list_order .= '"take_away": "'.$val->take_away.'",';
            $list_order .= '"total": "'.$val->total.'",';
            $list_order .= '"status": "2"';
            $list_order .= '},';
        }

        $orderan    = '['.substr($list_order, 0, -1).']';
        DB::table('trx_ordering')->where('id', $id)->update(['orderan'=>$orderan,'status'=>3]);

        return response('success');
    }

}
