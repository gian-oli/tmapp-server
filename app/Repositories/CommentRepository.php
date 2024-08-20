<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Contracts\CommentContract;

class CommentRepository extends BaseRepository implements CommentContract {
    protected $model;

    public function __construct(Comment $model){
        $this->model = $model;
    }
}