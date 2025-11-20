<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TripFilter
{
    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->request->all() as $method => $value) {
            if (method_exists($this, $method) && !empty($value)) {
                $this->$method($value);
            }
        }

        return $this->builder;
    }

    /**
     * Filter by status - uses index: ['status', 'departure_date']
     */
    public function status($status)
    {
        return $this->builder->where('status', $status);
    }

    /**
     * Filter by representative - uses index: ['representative_id', 'status', 'departure_date']
     */
    public function representative($representativeId)
    {
        return $this->builder->where('representative_id', $representativeId);
    }

    /**
     * Filter by source airport - uses index: ['source_airport_id', 'destination_airport_id', 'departure_date']
     */
    public function source($airportId)
    {
        return $this->builder->where('source_airport_id', $airportId);
    }

    /**
     * Filter by destination airport - uses index: ['source_airport_id', 'destination_airport_id', 'departure_date']
     */
    public function destination($airportId)
    {
        return $this->builder->where('destination_airport_id', $airportId);
    }

    /**
     * Filter by route (source + destination) - uses index: ['source_airport_id', 'destination_airport_id', 'departure_date']
     */
    public function route($route)
    {
        if (isset($route['source']) && isset($route['destination'])) {
            return $this->builder
                ->where('source_airport_id', $route['source'])
                ->where('destination_airport_id', $route['destination']);
        }

        return $this->builder;
    }

    /**
     * Filter by departure date range - uses index: ['status', 'departure_date']
     */
    public function departure_date($dateRange)
    {
        if (isset($dateRange['from'])) {
            $this->builder->where('departure_date', '>=', $dateRange['from']);
        }
        if (isset($dateRange['to'])) {
            $this->builder->where('departure_date', '<=', $dateRange['to']);
        }

        return $this->builder;
    }

    /**
     * Filter by arrival date range - uses index: ['departure_date', 'arrival_date']
     */
    public function arrival_date($dateRange)
    {
        if (isset($dateRange['from'])) {
            $this->builder->where('arrival_date', '>=', $dateRange['from']);
        }
        if (isset($dateRange['to'])) {
            $this->builder->where('arrival_date', '<=', $dateRange['to']);
        }

        return $this->builder;
    }

    /**
     * Filter by date range (both departure and arrival) - uses multiple indexes
     */
    public function date_range($range)
    {
        if (isset($range['start']) && isset($range['end'])) {
            return $this->builder->where(function ($query) use ($range) {
                $query->whereBetween('departure_date', [$range['start'], $range['end']])
                    ->orWhereBetween('arrival_date', [$range['start'], $range['end']]);
            });
        }

        return $this->builder;
    }

    /**
     * Filter by capacity - uses index on capacity columns if added
     */
    public function capacity($capacity)
    {
        if (isset($capacity['weight_min'])) {
            $this->builder->where('capacity_weight', '>=', $capacity['weight_min']);
        }
        if (isset($capacity['weight_max'])) {
            $this->builder->where('capacity_weight', '<=', $capacity['weight_max']);
        }
        if (isset($capacity['value_min'])) {
            $this->builder->where('capacity_value', '>=', $capacity['value_min']);
        }
        if (isset($capacity['value_max'])) {
            $this->builder->where('capacity_value', '<=', $capacity['value_max']);
        }

        return $this->builder;
    }

    /**
     * Filter upcoming trips - uses index: ['status', 'departure_date']
     */
    public function upcoming($value)
    {
        if ($value) {
            return $this->builder->where('departure_date', '>=', now());
        }

        return $this->builder;
    }

    /**
     * Filter active trips (in_progress) - uses index: ['status', 'departure_date']
     */
    public function active($value)
    {
        if ($value) {
            return $this->builder->where('status', 'in_progress');
        }

        return $this->builder;
    }

    /**
     * Complex filter: representative + status - uses index: ['representative_id', 'status', 'departure_date']
     */
    public function representative_status($params)
    {
        if (isset($params['representative_id']) && isset($params['status'])) {
            return $this->builder
                ->where('representative_id', $params['representative_id'])
                ->where('status', $params['status']);
        }

        return $this->builder;
    }

    /**
     * Complex filter: route + date range - uses index: ['source_airport_id', 'destination_airport_id', 'departure_date']
     */
    public function route_departure($params)
    {
        if (isset($params['source']) && isset($params['destination']) && isset($params['date'])) {
            return $this->builder
                ->where('source_airport_id', $params['source'])
                ->where('destination_airport_id', $params['destination'])
                ->whereDate('departure_date', $params['date']);
        }

        return $this->builder;
    }
}