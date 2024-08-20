<?php

namespace App\Services;
use App\Repositories\Contracts\CommentContract;

class CommentService
{
    protected $comment_contract;

    public function __construct(CommentContract $comment_contract)
    {
        $this->comment_contract = $comment_contract;
    }
    public function store($data)
    {
        return $this->comment_contract->store($data);
    }

}