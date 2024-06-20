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

class KasirController extends Controller
{
    function idnusr(){
        $arr    = DB::table('users')->select('users.*', 'b.name as role_name')
                    ->leftJoin('mst_role AS b', 'b.id', '=', 'users.role_id')
                    ->where('users.id', auth::user()->id)->first();
        return $arr;
    }

    function pembayaran(): object {
        $arr    = DB::table('mst_table')->where('is_active', 1)->get();

        $data = array(
            'title' => 'Pembayaran',
            'idnusr' => $this->idnusr(),
            'arr'   => $arr
        );

        return view('Kasir.pembayaran')->with($data);
    }

    function showprintorder(Request $request): object {
        $id     = $request['id'];
        $mj     = DB::table('mst_table')->where('id', $id)->first();
        $dt     = DB::table('trx_ordering')->where('id_table', $id)->where('is_active', 1)->first();
        $data   = json_decode($dt->orderan);

        $total  = 0;
        $list_orderan   = '';
        $no = 1;
        foreach($data as $key => $val){
            $list_orderan .= '<tr>';
            $list_orderan .= '<td>'.$no++.'</td>';
            $prd    = DB::table('trx_product')->select('trx_product.*', 'b.name as name_cat')
                    ->leftJoin('mst_category as b', 'b.id', '=', 'trx_product.category_id')
                    ->where('trx_product.id', $val->id_product)->first();
            $list_orderan .= '<td>'.$prd->name_cat.'</td>';
            $list_orderan .= '<td>'.$prd->name.'</td>';
            $list_orderan .= '<td class="text-center">'.$val->dine_in.'</td>';
            $list_orderan .= '<td class="text-center">'.$val->take_away.'</td>';
            $list_orderan .= '<td class="text-center">'.$val->qty.'</td>';
            $list_orderan .= '<td>Rp. '.number_format($val->price, 0, ',', '.').'</td>';
            $list_orderan .= '<td>Rp. '.number_format(($val->price*$val->qty), 0, ',', '.').'</td>';
            $list_orderan .= '</tr>';
            $total += $val->price*$val->qty;
        }

        $arr['show_name']   = $mj->name;
        $arr['foto']        = $mj->qr_code;
        $arr['total']       = 'Rp. '.number_format(($total), 0, ',', '.');
        $arr['list']        = $list_orderan;

        return response($arr);
    }

    function endorder(Request $request): object {
        $id     = $request['id'];
        $dt     = DB::table('trx_ordering')->where('id_table', $id)->where('is_active', 1)->first();
        DB::table('trx_ordering')->where('id', $dt->id)->update(['is_active'=>0,'status'=>4]);
        DB::table('mst_table')->where('id', $id)->update(['status'=>0]);

        return response('success');
    }


}
