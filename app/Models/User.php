<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\UploadedFile;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'firstName',
        'lastName',
        'birthday',
        'name',
        'email',
        'password',
        'address',
        'phoneNumber',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profileImgUrl',
        'fullName',
    ];

    public function getFullNameAttribute()
    {
        return $this->attributes['firstName'] . "  " . $this->attributes['lastName'];
    }

    public function getProfileImgUrlAttribute()
    {
        return $this->getProfilePhotoUrlAttribute();
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->attributes['profileImgUrl']
            ? Storage::disk($this->profilePhotoDisk())->url($this->attributes['profileImgUrl'])
            : $this->defaultProfilePhotoUrl();
    }

    public function updateProfilePhoto(UploadedFile $photo)
    {
        tap($this->profileImgUrl, function ($previous) use ($photo) {
            $this->forceFill([
                'profileImgUrl' => $photo->storePublicly(
                    'profile-photos',
                    ['disk' => $this->profilePhotoDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->profilePhotoDisk())->delete($previous);
            }
        });
    }

    protected function defaultProfilePhotoUrl()
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->fullName) . '&color=7F9CF5&background=EBF4FF';
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
