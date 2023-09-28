<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'article_id',
        'user_id',
        'comments',
    ];

    protected $dates =['deleted_at'];


    public function articles()
    {
        return $this->belongsTo(Article::class, 'article_id', 'id' );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id' );
    }


}
