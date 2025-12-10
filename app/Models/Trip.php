<?php

namespace App\Models;

use App\Filters\TripFilter;
use App\Policies\TripPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'representative_id',
        'source_airport_id',
        'destination_airport_id',
        'departure_date',
        'arrival_date',
        'capacity_weight',
        'capacity_value',
        'status'
    ];

    protected $casts = [
        'departure_date' => 'datetime',
        'arrival_date' => 'datetime',
    ];

    public function scopeFilter(Builder $builder, $request): Builder
    {
        return (new TripFilter($request))->apply($builder);
    }

    public function representative(): BelongsTo
    {
        return $this->belongsTo(Representative::class);
    }

    public function sourceAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'source_airport_id');
    }

    public function destinationAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }

    public function fullTitle(): Attribute
    {
        return Attribute::get(fn() => $this->getAttribute('representative')->fullname.' :: '.$this->getAttribute('sourceAirport')->code .' -> '.$this->getAttribute('destinationAirport')->code);
    }
}
