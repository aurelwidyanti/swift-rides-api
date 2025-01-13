<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBookings extends ListRecords
{
    protected static string $resource = BookingResource::class;

    // public ?float $totalRevenue = null;

    // public function mount(): void
    // {
    //     parent::mount();

    //     $this->totalRevenue = BookingResource::calculateTotalRevenue('monthly');
    // }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // public function render(): \Illuminate\Contracts\View\View
    // {
    //     return view('filament.resources.booking.list', [
    //         'totalRevenue' => $this->totalRevenue,
    //     ]);
    // }
}
