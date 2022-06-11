<?php

namespace App\Exports;

use App\Models\Priority;
use App\Models\User;
use App\Models\Wish;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Facades\DB;


class DistributionExport implements FromArray
{
    public function array(): array
    {
        return $this->tableDataArray();
    }

    public function tableDataArray(): array
    {
        $stockholders = DB::table('priorities')
            ->join('users', 'priorities.user_id', '=', 'users.id')
            ->select(
                'users.id as id',
                'priorities.priority as priority',
                'users.name as user_name',
            )
            ->where('users.is_admin', '=', 0)
            ->orderBy('priorities.priority')
            ->get();
        
        foreach($stockholders as $stockholder) {
            $counter = 1;
            foreach ($this->getWishes($stockholder->id, 1) as $wish) {
                $property = 'property_' . $counter;
                $week = 'week_' . $counter;
                $status = 'status_' . $counter;
                $stockholder->$property = $wish->property_name;
                $stockholder->$week = $wish->week_number;
                $stockholder->$status = $wish->wish_status;
                $counter++;
            }
        }
        return $stockholders->toArray();
    }

    public function getWishes($user_id, $round_id) {
        return DB::table('wishes')
            ->join('weeks', 'wishes.week_id', '=', 'weeks.id')
            ->join('properties', 'wishes.property_id', '=', 'properties.id')
            ->select('wishes.id as wish_id',
                'weeks.number as week_number',
                'properties.name as property_name',
                'wishes.status as wish_status'
            )
            ->where('wishes.user_id', $user_id)
            ->where('weeks.round_id', $round_id)
            ->get();
    }
}
