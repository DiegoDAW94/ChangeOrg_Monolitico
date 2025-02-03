<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\File;
use App\Models\Peticione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PharIo\Version\Exception;

class AdminPeticionesController extends Controller
{

    public function index()
    {
        $peticiones = Peticione::with('user')->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.peticiones.index', compact('peticiones'));
    }

    public function edit($id)
    {
        try {
            $peticion = Peticione::findOrFail($id);
            $categorias = Categoria::all(); // Obtiene todas las categorías
        } catch (\Exception $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }

        return view('admin.peticiones.edit-add', compact('peticion', 'categorias'));
    }


    public function delete($id){
        try{
            $peticion=Peticione::query()->findOrFail($id);
            if($peticion->firmas()->count() > 0){
                return back()->withErrors('no puedes eliminar peticiones firmadas')->withInput();
            }
            $peticion->delete();
            return redirect()->route('admin.home');
        }catch (Exception $exception){
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }

    public function cambiarEstado($id){
        try{
            $peticion=Peticione::query()->findOrFail($id);
            if($peticion->estado=="aceptada"){
                $peticion->estado="pendiente";
            }else{
                $peticion->estado="aceptada";
            }
            $peticion->save();
        }catch (Exception $exception){
            return back()->withErrors($exception->getMessage())->withInput();
        }
        return redirect()->route('admin.home');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'destinatario' => 'required|string|max:255',
            'categoria' => 'required|exists:categorias,id',
            'file' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user = Auth::user();
            $peticion = new Peticione($request->only(['titulo', 'descripcion', 'destinatario']));
            $peticion->categoria()->associate($request->categoria);
            $peticion->user()->associate($user);
            $peticion->firmantes = 0;
            $peticion->estado = 'pendiente';

            if ($peticion->save()) {
                $resFile = $this->fileUpload($request, $peticion->id);
                if ($resFile) {
                    // Redirige a la vista index del administrador
                    return redirect()->route('admin.home')->with('success', 'Petición creada correctamente.');
                }

                return back()->withErrors('Error subiendo la imagen de la petición.')->withInput();
            }
        } catch (\Exception $exception) {
            return back()->withErrors($exception->getMessage())->withInput();
        }
    }


    public function create(){
        $categorias = Categoria::all();
        return view('admin.peticiones.edit-add', compact('categorias'));
    }

    function update(request $request, $id){
        try{
            $peticion=Peticione::query()->findOrFail($id);
            $res=$peticion->update($request->all());
            if($request->file('image')){
                $peticion->file()->delete();
                if($res){
                    $res_file=$this->fileUpload($request,$peticion->id);
                    if($res_file){
                        return redirect()->route('admin.peticiones.show',$id);
                    }
                    return back()->withErrors('Error actualizando peticion')->withInput();
                }
            }

        }catch (Exception $exception){
            return back()->withErrors($exception->getMessage())->withInput();
        }
        return redirect()->route('admin.peticiones.show',$id);
    }

    public function show($id){
        try{
            $peticion=Peticione::query()->findOrFail($id);
            $categoria=Categoria::find($peticion['categoria_id']);
            return view('admin.peticiones.show',compact('peticion','categoria'));
        }catch (\Exception $exception){
            return back()->withError( $exception->getMessage())->withInput();
        }}

    public function fileUpload(Request $req, $peticione_id = null)
    {
        $file = $req->file('file');
        $fileModel = new File;
        $fileModel->peticione_id = $peticione_id;
        if ($req->file('file')) {
            //return $req->file('file');

            $filename = $fileName = time() . '_' . $file->getClientOriginalName();
            //      Storage::put($filename, file_get_contents($req->file('file')->getRealPath()));
            $file->move('peticiones', $filename);

            //  Storage::put($filename, file_get_contents($request->file('file')->getRealPath()));
            //   $file->move('storage/', $name);


            //$filePath = $req->file('file')->storeAs('/peticiones', $fileName, 'local');
            //    $filePath = $req->file('file')->storeAs('/peticiones', $fileName, 'local');
            // return $filePath;
            $fileModel->name = $filename;
            $fileModel->file_path = $filename;
            $res = $fileModel->save();
            return $fileModel;
            if ($res) {
                return 0;
            } else {
                return 1;
            }
        }
        return 1;
    }

}
