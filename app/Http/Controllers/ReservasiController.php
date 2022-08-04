<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasiController extends Controller
{
    //check a vailability of a table by time and date
    public function cekMeja(Request $request)
    {
        //mendapatkan tanggal dari request json / ajax
        $tanggal = $request->tanggal;
        //mendapatkan id_meja dari request json / ajax
        $id_meja = $request->id_meja;
        //validasi euy
        if ($tanggal == "NaN-NaN-NaN" && !$id_meja) {
            return ResponseController::response(false, '', null);
        }
        if ($tanggal == "NaN-NaN-NaN") {
            return ResponseController::response(false, 'Mohon isi tanggal dahulu', null);
        }
        if (!$id_meja) {
            return ResponseController::response(false, 'Mohon isi meja dahulu', null);
        }
        //mendapatkan total jam dari WaktuController kelas getJam
        //untuk mengubah jam nya ke WaktuController kelas getJam
        $jam = WaktuController::getJam();
        $jam = $jam->original['data'];
        //inisialisasi meja_tersedia dengan array kosong
        $meja_tersedia = [];
        //looping total jam
        foreach ($jam as $j) {
            $meja = self::queryJam($tanggal . ' ' . $j, $id_meja);
            $meja_tersedia[] = [
                'jam' => $j,
                'status' => $meja
            ];
        }
        return ResponseController::response(true, 'Sukses', $meja_tersedia);
    }

    public function queryJam($date, $id)
    {
        //query cek database jam
        return DB::table('reservasi')
            ->whereRaw('"' . $date . '" BETWEEN waktu_awal AND DATE_ADD(waktu_akhir,interval -1 hour)')
            ->where('id_meja', '=', $id)
            ->where('status', '!=', 2)
            ->get()
            ->count();
    }

    public function index()
    {
        //get meja all ~> (SELECT * FROM meja)
        $meja = Meja::all();
        //ini di file resources/views/home.blade.php
        //compact tuh artine ngebawa parameter contone parameter $meja dilempar ke view home.blade.php
        //jadi nanti di home.blade.php kita bisa mengambil data meja dari $meja
        return view('home', compact('meja'));
    }
}

// $os = array("07:00", "08:00", "09:00", "10:00", "11:00", "12:00");
// $ex = array("08:00", "10:00");
// $index = 0;
// $i = 0;
// $news = array_keys(array_diff($os, $ex));
// $cnt = count($news);

// foreach ($news as $key => $value) {
//     $done = strtotime("2022-06-05" . $value . ":00");
//     if (++$i === $cnt) {
//         // echo "last index!";
//     } else {
//         $dtwo = strtotime("2022-06-05" . $news[$key + 1] . ":00");
//         echo round(abs($done - $dtwo) / 60, 2) . " minute";
//     }
//     $key++;
// }

// $os = array("07:00", "08:00", "09:00", "10:00", "11:00", "12:00");
// $ex = array("08:00", "10:00");
// $res = [];
// foreach($ex as $o){
// 	if (!in_array($o, $os)) {
// 	    $res[] = $o;
// 	}
// }

// $tmp = [];
// $index = 0;
// $i = 0;
// $news = array_keys(array_diff($os,$ex));
// $cnt = count($news);

// foreach($news as $key => $value){
// 	$done = strtotime("2022-06-05" . $value . ":00");
// 	if(++$i === $cnt) {
//     	// echo "last index!";
// 	}else{
// 		$dtwo = strtotime("2022-06-05" . $news[$key+1] . ":00");
// 		$check = round(abs($done - $dtwo) / 60,2);
// 		// echo $check;
// 		if($check == 60){
// 			$tmp[] = $news[$key];
// 		}
// 	}
// 	// if($key == $cnt){
// 	// 	$dtwo = strtotime("2022-06-05" . $news[$key] . ":00");
// 	// }else{
// 	// 	$dtwo = strtotime("2022-06-05" . $news[$key+1] . ":00");
// 	// 	echo round(abs($done - $dtwo) / 60,2). " minute";
// 	// }
// 	$key++;
// }

// var_dump($tmp);

// // print_r(array_diff($os, $ex));
// // echo round(abs($to_time - $from_time) / 60,2). " minute";

// // var_dump($res);
// // $to_time = strtotime("2008-12-13 10:42:00");
// // $from_time = strtotime("2008-12-13 10:21:00");
// // echo round(abs($to_time - $from_time) / 60,2). " minute";
