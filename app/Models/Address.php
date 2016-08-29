<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Address
 *
 * Model for Address
 *
 * @package App\Models
 */
class Address extends Model
{
    /** @var string $table */
    protected $table = 'address';

    /** @var array $guarded */
    protected $guarded = ['id'];
}
