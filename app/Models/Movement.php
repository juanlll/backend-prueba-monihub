<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    public $table = 'movements';

    public $timestamps = true;

    public $fillable = [
        'type',
        'bank_account_id',
        'amount',
        'old_money',
        'current_money',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts                 = [
        'type'                       => 'string',
        'bank_account_id'            => 'integer',
        'amount'                     => 'integer',
        'old_money'                  => 'integer',
        'current_money'              => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type'                       => 'required|string',
        'bank_account_id'            => 'required|integer|exists:bank_accounts',
        'amount'                     => 'required|integer|digits_between:20',
        'old_money'                  => 'required|integer|digits_between:20',
        'current_money'              => 'required|integer|digits_between:20',
    ];

    /**
     * Get the bank_account that owns the Movement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank_account()
    {
        return $this->belongsTo(BankAccount::class);
    }

}
