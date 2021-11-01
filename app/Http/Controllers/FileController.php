<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

/**
 * @group File
 *
 * Gerenciamento de documentos
 */
class FileController extends Controller
{
    /**
     * 
     * Listagem de documentos
     * 
     * Lista os documentos cadastrados do usuário
     *
     * @authenticated
     * 
     * @response {
     *   "result": true,
     *   "data": [{
     *     "id": 1,
     *     "description": "PADRÃO",
     *     "category": "TERMO DE USO",
     *     "url": "http:\/\/127.0.0.1:8000\/storage\/files\/1\/6XuZiqUlIVqsuPC9aXZSaV7d7cvmltxWg79izMTS.pdf",
     *     "created_at": "2021-10-15T22:02:34.000000Z"
     *   },
     *   {
     *     "id": 2,
     *     "description": "ANAMNESE NOVO ALUNO",
     *     "category": "ANAMNESE",
     *     "url": "http:\/\/127.0.0.1:8000\/storage\/files\/1\/6XuZiqUlIVqsuPC9aXZSaV7d7cvmltxWg79izMTS.pdf",
     *     "created_at": "2021-10-15T22:02:34.000000Z"
     *   }]
     * }
     */
    public function index()
    {
        $user = auth('api')->user();
        $_files = File::where('id_user', $user->id)->get();

        if (!$_files) {
            return response()->json(['result' => false, 'message' => "Não foram encontrados documentos para este usuário!"]);
        }

        $dados = array();

        foreach ($_files as $file) {
            $dados[] = array(
                "id" => $file->id,
                "description" => $file->description,
                "category" => $file->category,
                "url" => env('APP_URL').'storage/'.$file->path,
                "created_at" => $file->created_at
            );
        }

        return response()->json(['result' => true, 'data' => $dados]);
    }

    /**
     * 
     * Cadastrar novo documento
     * 
     * Salva um arquivo em PDF através de upload. Exemplos: Anamnese, Contrato, Prescrição Médica
     *
     * @authenticated
     * 
     * @bodyParam  category string required O nome da categoria do documento. Ver endpoint de exibição de categorias
     * @bodyParam  description string required Uma descrição para o documento. No-example
     * @bodyParam  file file required Deve ser um arquivo com maximo de 2048 kb. No-example
     * 
     * @response {
     *   "result": true,
     *   "data": {
     *     "url": "http:\/\/127.0.0.1:8000\/storage\/files\/1\/6XuZiqUlIVqsuPC9aXZSaV7d7cvmltxWg79izMTS.pdf"
     *   }
     *   "message": "Mensagem de erro se houver"
     * }
     */
    public function store(Request $request)
    {
        $user = auth('api')->user();

        $validation = Validator::make($request->all(), [
            'category' => 'required|in:'.implode(",", File::$categories),
            'description' => 'required|min:6|max:35',
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        if ($validation->fails()) {
            return response()->json(['result' => false, 'message' => "Campos incorretos!", 'data' => $validation->errors()]);
        }
        
        // Storage::disk('public')->delete($_term->path);

        $document = $request->file('file');
        $_file = File::create([
            'id_user' => $user->id,
            'description' => $request->input('description'),
            'category' => $request->input('category'),
            'path' => $document->store('files/'.$user->id, 'public'),
            'type' => $document->getMimeType(),
        ]);

        return response()->json(['result' => true, 'data' => ['url' => env('APP_URL').'storage/'.$_file->path]]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 
     * Remover documento
     * 
     * Remove um arquivo do usuário da base de dados
     *
     * @authenticated
     * 
     * @queryParam id required O ID do documento a ser removido.
     * 
     * @response {
     *   "result": true,
     *   "message": "Documento removido com sucesso!"
     * }
     */
    public function destroy($id)
    {
        $user = auth('api')->user();

        $_file = File::findOrFail($id);

        if ($_file->id_user != $user->id) {
            abort(404);
        }

        Storage::disk('public')->delete($_file->path);
        $_file->delete();

        return response()->json(['result' => true, 'message' => "Documento removido com sucesso!"]);
    }

    /**
     * 
     * Listagem de categorias
     * 
     * Lista as categorias possíveis para upload de documentos
     *
     * @authenticated
     * 
     * @response {
     *   "result": true,
     *   "data": [
     *     "ANAMNESE", "TERMO DE USO", "PRESCRIÇÃO MÉDICA"
     *   ]
     * }
     */
    public function ShowCategory()
    {
        return response()->json(['result' => true, 'data' => File::$categories]);
    }
}
