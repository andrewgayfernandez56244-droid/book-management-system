<?php

namespace App\Models;

use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'author', 'genre', 'publication_year'])]
class Book extends Model
{
    /** @use HasFactory<BookFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $appends = ['published_year', 'year_published', 'year'];

    public function getPublishedYearAttribute(): ?int
    {
        return $this->publication_year;
    }

    public function getYearPublishedAttribute(): ?int
    {
        return $this->publication_year;
    }

    public function getYearAttribute(): ?int
    {
        return $this->publication_year;
    }
}
