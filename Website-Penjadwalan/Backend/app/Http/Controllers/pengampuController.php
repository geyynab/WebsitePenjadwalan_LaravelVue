<?php

namespace App\Http\Controllers;

use App\Models\pengampu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class pengampuController extends Controller
{
    public function getPengampu()
    {
        $getpengampu=pengampu::get();
        return response()->json($getpengampu);
    }
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'kode_mk'=>'required',
            'kode_dosen'=>'required',
            'kelas'=>'required',
            'tahun_akademik'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $save = pengampu::create([
            'kode_mk'    =>$req->kode_mk,
            'kode_dosen' =>$req->kode_dosen,
            'kelas'    =>$req->kelas,
            'tahun_akademik' =>$req->tahun_akademik
        ]);
        if($save){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }

    public function update(Request $req, $kode)
    {
        $validator = Validator::make($req->all(),[
            'kode_mk'=>'required',
            'kode_dosen'=>'required',
            'kelas'=>'required',
            'tahun_akademik'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=pengampu::where('kode',$kode)->update([
            'kode_mk'    =>$req->kode_mk,
            'kode_dosen' =>$req->kode_dosen,
            'kelas'    =>$req->kelas,
            'tahun_akademik' =>$req->tahun_akademik
        ]);
        if($ubah){
            return Response()->json(['status'=>1]);
        } else {
            return Response()->json(['status'=>0]);
        }
    }
        public function getdetail($kode)
        {
            $getdetailpengampu=pengampu::where('kode',$kode)->first();
            return Response()->json($getdetailpengampu);
        }
        public function destroy($kode)
        {
            $hapus=pengampu::where('kode',$kode)->delete();
            if($hapus){
                return Response()->json(['status'=>true, 'message' =>'Sukses Hapus Pengampu']);
            } else {
                return Response()->json(['status'=>false, 'message' =>'Gagal Hapus Pengampu']);
            }
        }
    }

    

