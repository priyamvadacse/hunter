<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPackageDetails extends Model
{
    use HasFactory;

    protected $table = 'subscription_package_details';

    protected $fillable = [
        'package_id',
        'package_duration',
        'price',
    ];

    public function subscription_package()
    {
        return $this->belongsTo(SubscriptionPackage::class, 'package_id', 'id');
    }
}
