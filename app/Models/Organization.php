<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Organization extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address_id',
        'theme_id',
        'type',
        'logo',
    ];

    protected $appends = [
        'logo_url',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * Accessor pour générer une URL temporaire pour le logo.
     *
     * @return string|null
     */
    protected function getLogoUrlAttribute(): ?string
    {
        // Si le champ logo n'est pas défini, retourner null
        if (!$this->attributes['logo']) {
            return null;
        }

        // Génère une URL temporaire avec une durée de 1 heure
        return Storage::disk('minio')
            ->temporaryUrl($this->attributes['logo'], now()->addHour());
    }
}
