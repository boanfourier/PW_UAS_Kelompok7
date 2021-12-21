<?php

namespace App\Http\Controllers;

use App\Models\posting;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class PostingController extends Controller
{
    public function posting(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'judul' => ['required', 'string','max:255'],
            'deskripsi' => ['required', 'string', 'max:255'],
                ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        } 

        $imagename = null;
        if ($request->foto!=null) {
            $imagename = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('img'),$imagename);

        }
        
        $posting =  DB::table('postings')->insert([
                    'gambar' => $imagename,
                    'judul' => $request->judul,
                    'deskripsi' => $request->deskripsi,
                    'status' => 'unfinished',
                    'createdby' => $request->createdby
                ]);
                $response = [
                    'message' => 'posting kelahiran berhasil',
                    'data' => 1
                ];
    
                return response()->json($response, Response::HTTP_CREATED);

    }

    public function readposting($id)
    {
        $readposting = DB::table('postings')->where('createdby',$id)->get();
        $response = [
            'message' => 'posting akun',
            'data' => $readposting
        ];

        if($readposting==null){
            $response = [
                'message' => 'posting akun',
                'data' => null
            ];
            return response()->json($response,Response::HTTP_OK);   
        }
        return response()->json($response,Response::HTTP_OK);

    }

    public function postingdetail($id)
    {
        $readposting = DB::table('postings')->where('id',$id)->first();
        $response = [
            'message' => 'posting akun',
            'data' => $readposting
        ];

        if($readposting==null){
            $response = [
                'message' => 'posting akun',
                'data' => null
            ];
            return response()->json($response,Response::HTTP_OK);   
        }
        return response()->json($response,Response::HTTP_OK);

    }

    public function readpostingall(Request $request)
    {

        $readposting = DB::table('postings')
        ->join('users', 'postings.createdby', '=', 'users.id')
        ->select('postings.*', 'users.name','users.foto')
        ->orderBy('created_at','desc')
        ->get();
                $response = [
            'message' => 'posting akun',
            'data' => $readposting
        ];

        if($readposting==null){
            $response = [
                'message' => 'posting akun',
                'data' => null
            ];
            return response()->json($response,Response::HTTP_OK);   
        }
        return response()->json($response,Response::HTTP_OK);

    }


    public function hapusposting($id)
    {
        $book = posting::find($id);
        $book->delete();

        return response()->json('The book successfully deleted');
    }

    public function updateposting(Request $request)
    {
            
            $validator = Validator::make($request->all(), [
                'judul' => ['required', 'string','max:255'],
                'deskripsi' => ['required', 'string', 'max:255'],
                    ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 401);
            } 
            $postings = DB::table('postings')->where('id',$request->id)->first();
            $foto = $postings->gambar;

            $imagename = $foto;
            if ($request->foto!=null && $request->hapusfoto!=null) {
                $imagename = time().'.'.$request->foto->extension();
                $request->foto->move(public_path('img'),$imagename);
                File::delete(public_path('img'),$request->hapusfoto);

            }else if ($request->foto!=null && $request->hapusfoto==null) {

                $imagename = time().'.'.$request->foto->extension();
                $request->foto->move(public_path('img'),$imagename);

            }

                $updateakun = DB::table('postings')->where('id',$request->id)->update([
                'judul'=> $request->judul,
                'deskripsi' => $request->deskripsi,
                'status' => $request->status,
                'gambar' => $imagename,
                    ]);

                $response = [
                    'message' => 'berhasil update',
                    'data' => 1
                ];
                return response()->json($response,Response::HTTP_OK);

    
    }

    public function jumlahposting()
    {
        $posting = DB::table('postings')->count();
        $response = [
            'message' => 'data posting',
            'jumlahpostings' => $posting
        ];
        return response()->json($response, Response::HTTP_OK);
    }

}
