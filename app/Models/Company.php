<?php

namespace App\Models;

use App\Models\Traits\Presentable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;
    use Presentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];

    /**
     * The model presenter full class path.
     *
     * @var string
     */
    public string $presenter = Presenters\CompanyPresenter::class;

    public function updateLogo(UploadedFile $logo)
    {
        tap($this->logo, function ($previous) use ($logo) {
            $this->forceFill([
                'logo' => $logo->store('companies', ['disk' => 'public']),
            ])->save();

            if ($previous) {
                Storage::disk('public')->delete($previous);
            }
        });
    }
}
