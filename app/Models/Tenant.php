<?php
namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
use HasDatabase, HasDomains;

protected $fillable = [
'id',
'name',
'domain',
'status',
'plan',
'owner_id',
'settings',
];

protected $casts = [
'settings' => 'array',
];

// Tenant can have many users
public function users()
{
return $this->hasMany(User::class);
}

// Tenant belongs to an owner (user)
public function owner()
{
return $this->belongsTo(User::class, 'owner_id');
}
}
