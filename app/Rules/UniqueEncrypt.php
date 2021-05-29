<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueEncrypt implements Rule
{
    private $table;
    private $exceptionValue;
    private $exceptionColumn;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($table, $exceptionValue = null, $exceptionColumn = null)
    {
        $this->table = $table;
        $this->exceptionValue = $exceptionValue;
        $this->exceptionColumn = $exceptionColumn;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $exceptionValue = $this->exceptionValue;
        $exceptionColumn = $this->exceptionColumn;

        $encrypted = encryption($value);
        $count = DB::table($this->table)->where(function ($query) use ($attribute, $value, $encrypted) {
                                                $query->where($attribute, $value)
                                                ->orWhere($attribute, $encrypted);
                                            })
                                        ->when(($exceptionValue && $exceptionColumn), function ($query) use ($exceptionValue, $exceptionColumn) {
                                                return $query->where($exceptionColumn, '!=', $exceptionValue);
                                            })->count();

        return ($count > 0) ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.unique');
    }
}
