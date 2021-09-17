<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'id_user' => 'exists:App\Models\User,id',
                'name' => ['required', 'min:6', 'max:35'],
                'resume' => ['nullable', 'min:6', 'max:35'],
                'content' => 'required',
                'status' => 'required|size:1',
            ]);

            if ($validation->fails()) {
                return response()->json(['result' => false, 'message' => "Campos incorretos!", 'data' => $validation->errors()]);
            }

            $template = Template::create([
                'id_user' => $request->input('id_user'),
                'name' => $request->input('name'),
                'resume' => $request->input('resume'),
                'content' => $request->input('content'),
                'status' => $request->input('status'),
            ]);
    
            return response()->json(['result' => true, 'data' => $template]);
        } catch(Exception $ex) {
            return response()->json([
                'result' => false, 
                'message' => "Erro ao inserir novo template!", 
                'ex' => $ex->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show(Template $template)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = Template::findOrFail($id);
            
            $validation = Validator::make($request->all(), [
                'id_user' => 'exists:App\Models\User,id',
                'name' => ['required', 'min:6', 'max:35'],
                'resume' => ['nullable', 'min:6', 'max:35'],
                'content' => 'required',
                'status' => 'required|size:1',
            ]);

            if ($validation->fails()) {
                return response()->json(['result' => false, 'message' => "Campos incorretos!", 'data' => $validation->errors()]);
            }

            $data->update($request->all());
    
            return response()->json(['result' => true, 'data' => $data]);
        } catch(Exception $ex) {
            return response()->json([
                'result' => false, 
                'message' => "Erro ao atualizar o template!", 
                'ex' => $ex->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy(Template $template)
    {
        //
    }
}
