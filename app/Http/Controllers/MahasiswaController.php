<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\MahasiswaExport;
// use App\Imports\MahasiswaImport;
use App\Imports\KehadiranImport;
use App\mahasiswa;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;


class MahasiswaController extends Controller
{
    public function index(){
        $data = mahasiswa::get();
        // dd($data);
        return view('mahasiswa', ['data' => $data]);
    }

    public function export(){
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    public function import(Request $request) {
			// validasi
		// $this->validate($request, [
		// 	'file' => 'required|mimes:csv,xls,xlsx'
		// ]);
	
		// menangkap file excel
		$file = $request->file('file');
	
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
	
		// upload ke folder file_siswa di dalam folder public
		$file->move('file_upload',$nama_file);
	
		// import data
		$data = Excel::toArray(new KehadiranImport, public_path('/file_upload/'.$nama_file));
		$dataTgl = [];
		$dataMahasiswa = [];
		$dataKehadiran = [];
		$kelas = "";

		foreach($data as $value){
			// get data kelas belum fix tinggal pake get table kelas aja
			// get data yang ada di colom 2 baris ke 8
			$kelas = $value[7][1];

			
			// get data tanggal
			for($i = 3; $i <= 7; $i++){
				array_push($dataTgl, $value[10][$i]);
			}

			for($j = 11; $j <= count($value)-9; $j++){
				$ktemp = []; //temp data untuk menampung data kehadiran
				$temp = [];  //temp data untuk menampung data mahasiswa
				
				for($n = 1 ; $n <= 7 ; $n++){
					array_push($temp, $value[$j][$n]);
				}

				for($k = 3 ; $k <= 7 ; $k++){
					array_push($ktemp, $value[$j][$k]);
				}

				array_push($dataMahasiswa, $temp);
				array_push($dataKehadiran, $ktemp);
				$temp = [];
				$ktemp = [];


			}
			
		}

		// dd($dataKehadiran[1]);
		
		foreach($dataTgl as $tglKey => $tgl){
			foreach($dataMahasiswa as $key => $getDataMahasiswa){

				// echo $dataKehadiran[$tglKey];
				DB::table('kehadiran')->insert([
					'nim' => $getDataMahasiswa[1],
					'ket_id' => $dataKehadiran[$key][$tglKey],
					'smt_id' => 5,
					'kelas_id' => 3,
					'tanggal' => $this->convertTgl($tgl),
					'waktu' => date('D-M-Y')
				]);
			}
		}
		// alihkan halaman kembali
		// return redirect('/siswa');
		// dd($this->convertTgl($dataTgl[1]));
	}

	private function convertTgl($date){
		$data = explode('-',$date);
		return $data[2].'-'.$data[1].'-'.$data[0];
	}
	
}
