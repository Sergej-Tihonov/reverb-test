<?php

namespace App\Models;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperAttendee
 */
class Attendee extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'ticket_cost' => 'integer',
        'is_paid' => 'boolean',
    ];

    public function conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class);
    }

    public static function getForm(): array
    {
        return [
            Group::make()->columns(2)->schema([
                TextInput::make('name')
                    ->required()->maxLength(255),
                TextInput::make('email')
                    ->email()->required()->maxLength(255),
            ]),
        ];
    }
}
