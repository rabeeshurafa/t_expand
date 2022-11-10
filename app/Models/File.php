<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable=['url', 'thumbnail', 'real_name', 'extension', 'archive_id', 'type','file_links'];
    public function archive()
    {
        return $this->belongsTo(Archive::class);
    }
    public function fileLinks(): Attribute
    {
        return new Attribute(
                get: fn($value) => json_decode($value),
                set: fn($value) => json_encode($value),
        );
    }
    public function copy_to()
    {
        return $this->belongsTo(CopyTo::class,'archive_id');
    }
}
