<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Http\Requests\ProdutoRequest as Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tempo = \Carbon\Carbon::now()->addDays(1);
        $produtos = \Cache::remember('api::produtos', $tempo, function(){
            return Produto::all();
        });
        return $produtos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Cadastra produto e Retorna o Id do mesmo
        \Cache::forget('api::produtos');
        $data = $request->all();
        $data['id_usuario'] = \Auth::user()->id;
        return Produto::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return $produto;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        \Cache::forget('api::produtos');
        $produto->update($request->all());
        return $produto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        \Cache::forget('api::produtos');
        $this->authorize('delete', $produto);
        $produto->delete();
        return $produto;
    }
}
