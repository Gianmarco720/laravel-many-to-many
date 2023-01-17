<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'slug', 'cover_image', 'type_id'];

    public static function generateSlug($title)
    {
        $project_slug = Str::slug($title);
        return $project_slug;
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * The tecnologies that belong to the Project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tecnologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }
}
