<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tarefa;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{

            $tarefas = Tarefa::all();    
            return response()->json(['tarefas'=>$tarefas], 200);
        } catch (\Exception $e){
            return response()->json('Ocorreu um erro no servidor', 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = $request->only(['titulo', 'descricao']);
            if($data){
                $tarefa = Tarefa::create($data);
                if($tarefa){
                    return response()->json(['data'=> $tarefa], 201);
                }else{
                    return response()->json(['message'=>'Erro ao criar a tarefa', 'data'=> $tarefa], 201);
                }
            }else{
                return response()->json(['message'=>'Dados inválidos'], 400);
            }     
        }catch (\Exception $e){
            return response()->json('Ocorreu um erro no servidor', 500);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            if($id < 0){
                return response()->json(['message'=>'ID menor que zero, por favor, informe um ID válido'], 400);
            }
            $tarefa = Tarefa::find($id);
            if($tarefa){
                return response()->json([$tarefa], 200);
            }else{
                return response()->json(['message'=>'A tarefa com id '.$id.' não existe'], 404);
            }
        }catch (\Exception $e){
                return response()->json('Ocorreu um erro no servidor', 500);
            }
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
        try{
            $data = $request->only(['titulo', 'descricao']);
            if($data){
                $tarefa = Tarefa::find($id);
                if($tarefa){
                    $tarefa->update($data);
                    return response()->json(['data'=> $tarefa], 200);
                }else{
                    return response()->json(['message'=>'A tarefa com id '.$id.' não existe'], 400);
                }
            }else{
                return response()->json(['message'=>'Dados inválidos'], 400);
            }
        }catch (\Exception $e){
                return response()->json('Ocorreu um erro no servidor', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            if($id < 0){
                return response()->json(['message'=>'ID menor que zero, por favor, informe um ID válido'], 400);
            }
            $tarefa = Tarefa::find($id);
            if($tarefa){
                $tarefa->delete();
                return response()->json([], 204);
            }else{
                return response()->json(['message'=>'A tarefa com id '.$id.' não existe'], 404);
            }
        }catch (\Exception $e){
                return response()->json('Ocorreu um erro no servidor', 500);
        }
    }
}
