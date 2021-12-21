<?php

namespace App\Http\Controllers;

use App\Models\komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class KomentarController extends Controller
{
    public function tambahkomentar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'posting_id' => ['required'],
            'user_id' => ['required'],
            'komentar' => ['required']]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }
        $user = komentar::create($request->all());
        $response = [
            'message' => 'berhasil di insert',
            'data' => 1
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function getkomentar($posting_id)
    {
        $komentar = DB::table('komentars')
        ->join('users', 'komentars.user_id', '=', 'users.id')
        ->join('postings', 'komentars.posting_id', '=', 'postings.id')
        ->select('komentars.*', 'users.name', 'postings.judul')
        ->where('posting_id', $posting_id)
        ->orderBy('created_at', 'desc')->get();
        $response = [
            'message' => 'data komentar',
            'data' => $komentar
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function getkomentarall()
    {
        $komentar = DB::table('komentars')
        ->join('users', 'komentars.user_id', '=', 'users.id')
        ->join('postings', 'komentars.posting_id', '=', 'postings.id')
        ->select('komentars.*', 'users.name', 'postings.judul')
        ->orderBy('created_at', 'desc')->get();
        $response = [
            'message' => 'data komentar',
            'data' => $komentar
        ];
        return response()->json($response, Response::HTTP_OK);
    }

    public function hapuskomentar($id)
    {
        $book = komentar::find($id);
        $book->delete();
        $response = [
            'message' => 'hapus komentar berhasil',
            'data' => $book
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function jumlahkomentar()
    {
        $komentar = DB::table('komentars')->count();
        $response = [
            'message' => 'data komentar',
            'jumlahkomentar' => $komentar
        ];
        return response()->json($response, Response::HTTP_OK);
    }

}
