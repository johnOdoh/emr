<?php

namespace App\Filament\Resources\Payslips\Pages;

use App\Filament\Resources\Payslips\PayslipResource;
use App\Models\Staff;
use Carbon\Carbon;
use Filament\Resources\Pages\CreateRecord;
use NumberFormatter;

class CreatePayslip extends CreateRecord
{
    protected static string $resource = PayslipResource::class;
    protected static bool $canCreateAnother = false;

    public function mount(): void
    {
        parent::mount();
        $staff = Staff::findOrFail(request()->query('id'));

        $this->form->fill([
            'name' => $staff->fullname,
            'job_title' => $staff->job_title,
            'department' => $staff->department
        ]);
    }

    protected function beforeCreate()
    {
        $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);
        $date = Carbon::parse($this->data['date']);
        $this->data['date'] = $date->format('F, Y');
        $this->data['earnings'] = array_values($this->data['earnings'] ?? []);
        $this->data['deductions'] = array_values($this->data['deductions'] ?? []);
        $this->data['total_earnings'] = array_sum(array_column($this->data['earnings'], 'amount'));
        $this->data['total_deductions'] = array_sum(array_column($this->data['deductions'], 'amount'));
        $this->data['net_pay'] = $this->data['total_earnings'] - $this->data['total_deductions'];
        $num_array = explode('.', $this->data['net_pay']);
        if (isset($num_array[1])) {
            $this->data['net_pay_figure'] = $formatter->format($num_array[0]) . ' naira, ' . $formatter->format($num_array[1] ?? 0) . ' kobo';
        } else {
            $this->data['net_pay_figure'] = $formatter->format($num_array[0]) . ' naira';
        }
        // dd($this->data, $num_array);
        session()->flash('payload', $this->data);
        $name = $this->data['name'] ?? null;
        $jobTitle = $this->data['job_title'] ?? null;
        $department = $this->data['department'] ?? null;

        $this->reset('data');

        $this->data['name'] = $name;
        $this->data['job_title'] = $jobTitle;
        $this->data['department'] = $department;
        $this->redirect(route('payslip.download'));
        $this->halt();
    }
}