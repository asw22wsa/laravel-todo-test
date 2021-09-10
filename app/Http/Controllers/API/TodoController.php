<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Resources\TodoResource;
use App\Http\Requests\TodoRequest;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TodoResource::collection(Todo::orderBy('updated_at','desc')->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        Todo::create($request->all());

        return new TodoResource(Todo::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Todo::where('id',$id)->exists()){
            return new TodoResource(Todo::find($id));
        }else{
            return response()->json([
                "message" => "해당파일이 존재하지 않습니다."
            ],Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(TodoRequest $request, $id)
    {
        if(Todo::where('id',$id)->exists()){
            Todo::find($id)->update($request->all());

            return new TodoResource(Todo::find($id));
        }else{
            return response()->json([
                "message" => "해당파일이 존재하지 않습니다."
            ],Response::HTTP_NOT_FOUND);
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
        if(Todo::where('id',$id)->exists()){
            Todo::find($id)->delete();

            return response()->json([
                "message" => "해당파일이 삭제되었습니다."
            ],Response::HTTP_NO_CONTENT);
        }else{
            return response()->json([
                "message" => "해당파일이 존재하지 않습니다."
            ],Response::HTTP_NOT_FOUND);
        }
    }
}
