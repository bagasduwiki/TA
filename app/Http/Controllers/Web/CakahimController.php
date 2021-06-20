<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\cakahim;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class cakahimController extends Controller
{
    public function adminindex()
    {
        $cakahims = cakahim::orderBy('id', 'ASC')->get();
        return view('admin.cakahim.index', compact('cakahims'));
    }

    public function tambah_agenda()
    {

    }

    public function store_agenda(Request $request)
    {

    }

    public function detailcakahim($id)
    {
        $data = cakahim::find($id);
        $idcakahim = $id;
        return view('admin.cakahim.edit_cakahim', compact('data', 'idcakahim'));
    }

    public function update_cakahim(Request $request, $id)
    {
      switch ($request->submitbutton) {
          case 'LULUS':
              cakahim::where("id", $id)->update(['status' => "LULUS"]);
//                return redirect()->route('editmultiimages', $product->id)->with('success', 'Product, ' . $product->title . ' updated, now you can edit images.');
              return redirect()->route('cakahim')->with('success', 'Verifikasi LULUS cakahim berhasil');
              break;
          case 'GAGAL':
              cakahim::where("id", $id)->update(['status' => "GAGAL"]);
//                Session::flash('success', 'Product, ' . $product->title . ' updated successfully.');
//                return redirect()->route('products.index', $product->id);
              return redirect()->route('cakahim')->with('error', 'Verifikasi GAGAL cakahim berhasil');
              break;
          case 'BACK':
              return redirect()->route('cakahim');
              break;
      }
    }

    public function hapus_cakahim(Request $request)
    {
        cakahim::where('id',$request->id)->delete();
        return redirect()->route('cakahim');
    }

    public function getcakahim(){
      $data = cakahim::all();
      return response()->json(
        $data
      );
    }
}
