<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Services\CommentService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use ResponseTrait;
    protected $comment_service;
    public function __construct(CommentService $comment_service)
    {
        $this->comment_service = $comment_service;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        $result = $this->successResponse('Comment Stored Successfully');
        try {
            $data = [
                "comment" => $request->comment,
                "task_id" => $request->task_id,
                "user_id" => $request->user_id
            ];
            $result['data'] = $this->comment_service->store($data);
        } catch (\Exception $e) {
            $result = $this->errorResponse($e);
        }
        return $this->returnResponse($result);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
