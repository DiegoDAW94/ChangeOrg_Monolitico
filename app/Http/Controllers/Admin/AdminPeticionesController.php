<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminPeticionesController extends Controller
{

    public function index()
    {
        $peticiones = Peticione::paginate(5);
        return view('peticiones.admin.index', compact('peticiones'));
    }

    public function listMine()
    {
        try{
            $userId = Auth::id();
            $peticiones = Peticione::where('user_id', $userId)->paginate(5);
        } catch(\Exception $exception){
            return back() -> withError($exception -> getMessage())->withInput();
        }
        return view('peticiones.mine', ['peticiones' => $peticiones]);
    }


    public function create(){
        $categorias = Categoria::all();
        return view('peticiones.edit-add', compact('categorias'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'destinatario' => 'required',
            'categoria'=>'required',
            'file' => 'required',
        ]);

        $input = $request->all();

        try {
            $categoria = Categoria::findOrFail($input['categoria']);
            $user = Auth::user(); //asociarlo al usuario authenticado
            $peticion = new Peticione($input);
            $peticion->categoria()->associate($categoria);
            $peticion->user()->associate($user);
            $peticion->firmantes = 0;
            $peticion->estado = 'pendiente';
            $res=$peticion->save();
            if ($res) {
                $res_file = $this->fileUpload($request, $peticion->id);
                if ($res_file) {
                    return redirect('/mispeticiones');
                }
                return back()->withError( 'Error creando la peticion')->withInput();
            }
        }catch (\Exception $exception){
            return back()->withError( $exception->getMessage())->withInput();
        }

    }

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



    public function firmar(Request $request, $id){
        try {
            $peticion = Peticione::findOrFail($id);
            $user = Auth::user();
            $firmas = $peticion->firmas;
            foreach ($firmas as $firma) {
                if ($firma->id == $user->id) {
                    return back()->withError( "Ya has firmado esta petición")->withInput();
                }
            }
            $user_id = [$user->id];
            $peticion->firmas()->attach($user_id);
            $peticion->firmantes = $peticion->firmantes + 1;
            $peticion->save();
        }catch (\Exception $exception){
            return back()->withError( $exception->getMessage())->withInput();
        }
        return redirect()->back();
    }


    public function peticionesFirmadas(Request $request)
    {
        try {
            $user = Auth::user();
            $peticiones = $user->firmas;  // Firmas es una relación en el modelo User
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }

        return view('peticiones.peticionesfirmadas', compact('peticiones'));
    }

    public function edit(Request $request, $id)
    {
        try{
            $peticion = Peticione::findOrFail($id);
        } catch (\Exception $exception){
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('peticiones.edit-add', compact('peticion'));
    }

    public function update(Request $request, $id)
    {
        try{
            $peticion = Peticione::findOrFail($id);
            $peticion = update($request->all());
        } catch (\Exception $exception){
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->back();
    }

    public function delete(Request $request, $id)
    {
        try{
            $peticion = Peticione::findOrFail($id);
            $peticion->delete();
        } catch (\Exception $exception){
            return back()->withError($exception->getMessage())->withInput();
        }
        return redirect()->back();
    }
}
