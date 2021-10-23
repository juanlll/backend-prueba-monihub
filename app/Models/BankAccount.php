<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    public $table = 'bank_accounts';

    public $timestamps = true;

    public $fillable = [
        'account_name',
        'account_number',
        'account_currency',
        'bank_name',
        'initial_account_balance',
        'status',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts                = [
        'account_name'              => 'string',
        'account_number'            => 'string',
        'account_currency'          => 'string',
        'bank_name'                 => 'string',
        'initial_account_balance'   => 'string',
        'status'                    => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'account_name'              => 'required|min:2|max:50',
        'account_number'            => 'required|min:20|max:20|unique:bank_accounts',
        'account_currency'          => 'required|min:3|max:3',
        'bank_name'                 => 'required|min:2|max:50',
        'initial_account_balance'   => 'required|min:2|max:11',
        'status'                    => 'required',
    ];

    /**
     * Get all of the movements for the BankAccount
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function movements()
    {
        return $this->hasMany(Movement::class, 'bank_account_id', 'id')->limit(5)->orderByDesc('id');
    }

}
