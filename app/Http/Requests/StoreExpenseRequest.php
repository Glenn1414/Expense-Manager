<?php

namespace App\Http\Requests;

use App\Models\Expense;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('expense_create');
    }

    public function rules()
    {
        return [
            'expenses_category' => [
                'required',
            ],
            'amount' => [
                'required',
            ],
            'entrydate' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'create_at' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}