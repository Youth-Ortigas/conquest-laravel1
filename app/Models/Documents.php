<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Documents
 * @author Marylyn Lajato <flippie.cute@gmail.com>
 * @since May 20, 2025
 */
class Documents extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'documents';

    /**
     * The attributes that are mass assignable.
     * @var list<string>
     */
    protected $fillable = [
        'doc_type',
        'doc_user_id',
        'doc_signed_at',
        'doc_gdrive_resource_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'doc_user_id', 'id');
    }

}
