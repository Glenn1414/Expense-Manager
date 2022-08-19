<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const EXPENSES_CATEGORY_SELECT = [
        '1' => 'Travel',
        '2' => 'Entertainment',
    ];

    public $table = 'expenses';

    protected $dates = [
        'entrydate',
        'create_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'expenses_category',
        'amount',
        'entrydate',
        'create_at',
        'expenses_categories',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getEntrydateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEntrydateAttribute($value)
    {
        $this->attributes['entrydate'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getCreateAtAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setCreateAtAttribute($value)
    {
        $this->attributes['create_at'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}