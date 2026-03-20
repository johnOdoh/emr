<?php

namespace App\Filament\Resources\Invoices\Pages;

use App\Filament\Resources\Invoices\InvoiceResource;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;

class CreateInvoice extends CreateRecord
{
    protected static string $resource = InvoiceResource::class;
    protected static bool $canCreateAnother = false;

    protected function beforeCreate()
    {
        $data = $this->data;
        $data['invoice_id'] = rand(100000, 999999);
        $data['date'] = Carbon::now()->format('d-m-Y');
        $data['invoice_due_date'] = Carbon::parse($data['invoice_due_date'])->format('d-m-Y');
        $data['items'] = array_values($data['items'] ?? []);
        $data['taxes'] = array_values($data['taxes'] ?? []);
        $data['item_total'] = array_sum(array_column($data['items'], 'total_amount'));
        $data['tax_total'] = array_sum(array_column($data['taxes'], 'tax_amount'));
        $data['grand_total'] = $data['item_total'] + $data['tax_total'];
        // dd($this->data, $data);
        session()->flash('payload', $data);
        $this->reset();
        $this->redirect('/invoice/download');
        $this->halt();
    }
}