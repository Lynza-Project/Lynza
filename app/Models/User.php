<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Exception;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Panel;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements HasName, FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, softDeletes;

    public function getFilamentName(): string
    {
        return $this->getAttributeValue('first_name');
    }

    public function initials(): string
    {
        return strtoupper($this->first_name[0] . $this->last_name[0]);
    }

    /**
     * @throws Exception
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'superadmin') {
            return auth()->user()->role === 'super-admin';
        }
        return false;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'role',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = [
        'profile_picture_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    /**
     * Accessor pour générer une URL temporaire pour profile_picture.
     *
     * @return string|null
     */
    protected function getProfilePictureUrlAttribute(): ?string
    {
        // Si le champ profile_picture n'est pas défini, retourner null
        if (!$this->attributes['profile_picture']) {
            return null;
        }

        // Génère une URL temporaire avec une durée de 1 heure
        return Storage::disk('minio')
            ->temporaryUrl($this->attributes['profile_picture'], now()->addHour());
    }
}
