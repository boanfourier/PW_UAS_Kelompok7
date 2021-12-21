<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data,[
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nama' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string','min:8', 'confirmed'],

        ]);
    }

    protected function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'max:1000',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'email_verified_at' => ['required'],
            'password' => ['required', 'string','min:5']
                ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        } 

        $imagename = null;
        if ($request->foto!=null && $request->hapusfoto!=null) {
            $imagename = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('img'),$imagename);

        }else if ($request->foto!=null && $request->hapusfoto==null) {

            $imagename = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('img'),$imagename);

        }
        
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['foto'] = $imagename;
        $user = User::create($input);
        $response = [
            'user' => $user,
            'token' => $user->createToken('remember_token')->accessToken,
        ];
       
        return response()->json($response, 200);
     
    }

    public function login(Request $request)
    {
        $detailakun = DB::table('users')->where('email',$request->email)->first();
        $emailverif = $detailakun->email_verified_at;
        $role = $detailakun->role;
        $id = $detailakun->id;
        if ($detailakun && Hash::check($request->password, $detailakun->password)) {
            if ($emailverif!=null) {
                $response = [
                    'data' => 1,
                    'message' => 'sukses',  
                    'role' => $role,  
                    'id' => $id,  
                ];
                return response()->json($response, 200);
            }else{
                $response = [
                    'data' => 2,
                    'message' => 'belum di verifikasi'  
                ];
                return response()->json($response, 200);
            }
        }else{
            $response = [
                'data' => 0,
                'message' => 'Username dan password salah'  
            ];
            return response()->json($response, 200);
        }


        // $credentials = $request->validate([
        //     'email' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);

        // $status = 401;
        // $response = [
        //     'error' => 'Proses masuk gagal!. Silahkan coba kembali.', 
        // ]; 

        // if (Auth::attempt($credentials)) {
        //     $detailakun = DB::table('users')->where('email',$request->email)->first();
        //     $status = 200;
        //     $token = $request->user()->createToken('access_token')->plainTextToken; 
        //     $response = [
        //         'access_token' => $token,
        //         'token_type' => 'Bearer',
        //         'data' => 1,
        //         'role' => $detailakun->role
        //     ];
        // }else{
        //     $status = 200;
        //     $response = [
        //         'access_token' => null,
        //         'token_type' => null,
        //         'data' => 0,
        //         'role' =>null
        //     ];

        // }
         
        // return response()->json($response, $status);
    }

    public function logout(Request $request)
    {

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        $response = [
            'message' => 'sedang logout',
            'data' =>1
        ];

               return response()->json($response, 200);

        // Auth::logout();
        
        // $status = 200;
        // $response = [
        //     'message' => 'sedang logout',
        //     'data' =>1
        // ];
        // return response()->json($response, $status);

    }

    public function readall()
    {
        $readposting = DB::table('users')->get();
        $response = [
            'message' => ' get akun all',
            'data' => $readposting
        ];

        if($readposting==null){
            $response = [
                'message' => 'get akun all',
                'data' => null
            ];
            return response()->json($response,Response::HTTP_OK);   
        }
        return response()->json($response,Response::HTTP_OK);
 
    }

    public function delete($id)
    {
        $book = User::find($id);
        $book->delete();

        return response()->json('The book successfully deleted');
    }

    public function readbyid($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255']
                ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        } 
        $detailakun = DB::table('users')->where('id',$request->id)->first();
        $email = $detailakun->email;

        $imagename = $detailakun->foto;
        if ($request->foto!=null && $request->hapusfoto!=null) {
            $imagename = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('img'),$imagename);
            File::delete(public_path('img'),$request->hapusfoto);

        }else if ($request->foto!=null && $request->hapusfoto==null) {
            $imagename = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('img'),$imagename);

        }

        if ($email == $request->email) {
                    //update tanpa ubah email
                $updateakun = DB::table('users')->where('id',$request->id)->update([
                'name'=> $request->name,
                'role' => $request->role,
                'foto' => $imagename
                    ]);

                $response = [
                    'message' => 'berhasil update',
                    'data' => 1
                ];
                return response()->json($response,Response::HTTP_OK);
    
        }else {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 401);
            } 

            //update dengan ubah email
            $updateakun = DB::table('users')->where('id',$request->id)->update([
                'name'=> $request->name,
                'role' => $request->role,
                'email' => $request->email,
                'foto' => $imagename
                    ]);

                $response = [
                    'message' => 'berhasil update',
                    'data' => 1
                ];
                return response()->json($response,Response::HTTP_OK);
        }

        
    }

    public function updatepassword(Request $request)
    {

        $input = $request->password;
        $input = Hash::make($input);

        $updatepassword = DB::table('users')->where('id',$request->id)->update([
            'password'=> $input                ]);

            $response = [
                'message' => 'berhasil update',
                'data' => 1
            ];
            return response()->json($response,Response::HTTP_OK);
    }

    public function jumlahusers()
    {
        $jumlahusers = DB::table('users')->count();
        $response = [
            'message' => 'data posting',
            'jumlahusers' => $jumlahusers
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
