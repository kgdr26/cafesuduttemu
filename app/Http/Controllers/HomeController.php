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

class HomeController extends Controller
{

    function home(Request $request): object {
        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');
        $identitasperangkat = hash('sha256', $ipAddress . $userAgent);

        $category_id    = $request['category_id'];
        if(isset($category_id)){
            $product    = DB::table('trx_product')->select('trx_product.*', 'mst_category.name as cat_name')
                ->leftJoin('mst_category', 'mst_category.id', '=', 'trx_product.category_id')
                ->whereIn('trx_product.is_active', [1])
                ->where('trx_product.category_id', $category_id)->get();
        }else{
            $product    = DB::table('trx_product')->select('trx_product.*', 'mst_category.name as cat_name')
                ->leftJoin('mst_category', 'mst_category.id', '=', 'trx_product.category_id')
                ->whereIn('trx_product.is_active', [1])->get();
        }

        $category   = DB::table('mst_category')->where('is_active', 1)->get();

        $cek_order  =  DB::table('trx_ordering')->select('trx_ordering.*', 'b.kode as kode_table')
                        ->leftJoin('mst_table as b', 'b.id', '=', 'trx_ordering.id_table')
                        ->where('trx_ordering.perangkat', $identitasperangkat)
                        ->where('trx_ordering.is_active', 1)->first();

        if(isset($cek_order->id)){
            $id_ordering = $cek_order->id;
        }else{
            $id_ordering = 0;
        }

        $data = array(
            'title'     => 'Home',
            'product'   => $product,
            'category'  => $category,
            'identitasperangkat' => $identitasperangkat,
            'cek_order' => $cek_order,
            'id_ordering'   => $id_ordering
        );

        return view('Home.list')->with($data);
    }

    function actbooking(Request $request): object {
        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');
        $identitasperangkat = hash('sha256', $ipAddress . $userAgent);

        $kode       = $request['kode'];
        $dt_table   = DB::table('mst_table')->where('kode', $kode)->first();

        $id_table   = $dt_table->id;
        $perangkat  = $identitasperangkat;

        $data   = array(
            'id_table'  => $id_table,
            'perangkat' => $perangkat,
            'orderan'   => '[]',
            'status'    => 1,
            'is_active' => 1
        );

        $dt     = DB::table('trx_ordering')->where('id_table', $id_table)->where('is_active', 1)->first();
        if(isset($dt)){
            return response('error');
        }else{
            DB::table('trx_ordering')->insert([$data]);
            DB::table('mst_table')->where('id', $id_table)->update(['status'=>1]);
            return response('success');
        }
    }

    function showdataorder(Request $request): object {
        $id         = $request['id'];
        $dt         = DB::table('trx_ordering')->where('id', $id)->first();

        if($id == 0){
            $data       = [];
        }else{
            $data       = json_decode($dt->orderan);
        }

        $qty        = count($data);
        $total      = 0;
        $list       = '';
        foreach($data as $key => $val){
            $total += $val->total;
            $prd    = DB::table('trx_product')->where('id', $val->id_product)->first();
            $list .= '<li class="list-group-item px-0 py-3">';
            $list .= '<div class="row align-items-center g-0">';
            $list .= '<div class="col-lg-3 text-center">';
            $list .= '<img src="'.asset("assets/img/products/".$prd->foto).'" alt="Ecommerce" class="icon-xxl">';
            $list .= '</div>';
            $list .= '<div class="col-lg-7">';
            $list .= '<a href="#" class="text-inherit">';
            $list .= '<h6 class="mb-0">'.$prd->name.'</h6>';
            $list .= '</a>';
            $list .= '<small class="text-muted">'.$val->qty.' X Rp. '.number_format($val->price, 0, ',', '.').'</small><br>';
            $list .= '<small class="text-muted">Dine In : '.$val->dine_in.'</small><br>';
            $list .= '<small class="text-muted">Take Away : '.$val->take_away.'</small>';
            $list .= '</div>';
            $list .= '</div>';
            $list .= '</li>';
        }

        $arr['qty']     = $qty;
        $arr['total']   = number_format($total, 0, ',', '.');
        $arr['list']    = $list;
        return response($arr);
    }

    function showprod(Request $request): object {
        $id         = $request['id'];
        $dt         = DB::table('trx_product')->select('trx_product.*', 'mst_category.name as cat_name')
                        ->leftJoin('mst_category', 'mst_category.id', '=', 'trx_product.category_id')
                        ->where('trx_product.id', $id)->first();

        $arr['cat']     = $dt->cat_name;
        $arr['name']    = $dt->name;
        $arr['price']   = number_format($dt->price, 0, ',', '.');
        $arr['stock']   = $dt->qty;
        $arr['foto']    = $dt->foto;
        return response($arr);
    }

    function addcart(Request $request): object {
        $id_product = $request['id_product'];
        $dine_in    = $request['dine_in'];
        $take_away  = $request['take_away'];
        $id_order   = $request['id_order'];

        $prod       = DB::table('trx_product')->where('id', $id_product)->first();
        $price_prod = $prod->price;

        $dt         = DB::table('trx_ordering')->where('id', $id_order)->first();
        $data       = json_decode($dt->orderan);
        $list_order = '';

        if(count($data) == 0){
            $list_order .= '{';
            $list_order .= '"id_product": "'.$id_product.'",';
            $list_order .= '"qty": "'.$dine_in+$take_away.'",';
            $list_order .= '"price": "'.$price_prod.'",';
            $list_order .= '"dine_in": "'.$dine_in.'",';
            $list_order .= '"take_away": "'.$take_away.'",';
            $list_order .= '"total": "'.$price_prod*($dine_in+$take_away).'",';
            $list_order .= '"status": "1"';
            $list_order .= '}';
        }else{
            foreach($data as $key => $val){
                $list_order .= '{';
                $list_order .= '"id_product": "'.$val->id_product.'",';
                $list_order .= '"qty": "'.$val->qty.'",';
                $list_order .= '"price": "'.$val->price.'",';
                $list_order .= '"dine_in": "'.$val->dine_in.'",';
                $list_order .= '"take_away": "'.$val->take_away.'",';
                $list_order .= '"total": "'.$val->total.'",';
                $list_order .= '"status": "'.$val->status.'"';
                $list_order .= '},';
            }

            $list_order .= '{';
            $list_order .= '"id_product": "'.$id_product.'",';
            $list_order .= '"qty": "'.$dine_in+$take_away.'",';
            $list_order .= '"price": "'.$price_prod.'",';
            $list_order .= '"dine_in": "'.$dine_in.'",';
            $list_order .= '"take_away": "'.$take_away.'",';
            $list_order .= '"total": "'.$price_prod*($dine_in+$take_away).'",';
            $list_order .= '"status": "1"';
            $list_order .= '}';

        }

        $orderan    = '['.$list_order.']';
        DB::table('trx_ordering')->where('id', $id_order)->update(['orderan'=>$orderan]);

        $qty_upd_prod   = $prod->qty-($dine_in+$take_away);
        if($qty_upd_prod <= 0){
            DB::table('trx_product')->where('id', $id_product)->update(['qty'=>$qty_upd_prod,'is_active'=>2]);
        }else{
            DB::table('trx_product')->where('id', $id_product)->update(['qty'=>$qty_upd_prod]);
        }

        return response('success');
    }

    function actcheckout(Request $request): object {
        $id = $request['id'];
        DB::table('trx_ordering')->where('id', $id)->update(['status'=>2]);
        return response('success');
    }



}
