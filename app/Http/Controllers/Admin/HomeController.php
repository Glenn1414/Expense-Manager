<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title'           => 'My Expenses',
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Expense',
            'group_by_field'        => 'entrydate',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'filter_days'           => '30',
            'group_by_field_format' => 'Y-m-d',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'fields'                => [
                'amount'              => '',
                'expenses_categories' => '',
            ],
            'translation_key' => 'expense',
        ];

        $settings1['data'] = [];
        if (class_exists($settings1['model'])) {
            $settings1['data'] = $settings1['model']::latest()
                ->take($settings1['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings1)) {
            $settings1['fields'] = [];
        }

        $settings2 = [
            'chart_title'           => 'Dashboard',
            'chart_type'            => 'pie',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Expense',
            'group_by_field'        => 'entrydate',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'sum',
            'aggregate_field'       => 'amount',
            'filter_field'          => 'created_at',
            'filter_days'           => '30',
            'group_by_field_format' => 'Y-m-d',
            'column_class'          => 'col-md-4',
            'entries_number'        => '5',
            'translation_key'       => 'expense',
        ];

        $chart2 = new LaravelChart($settings2);

        return view('home', compact('chart2', 'settings1'));
    }
}