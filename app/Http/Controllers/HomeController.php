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


        $data = array(
            'title'     => 'Home',
            'product'   => $product,
            'category'  => $category,
            'identitasperangkat' => $identitasperangkat
        );

        return view('Home.list')->with($data);
    }


}
