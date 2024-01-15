<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Material",
 *     title="Material",
 *     description="Material object",
 *     @OA\Property(property="id", type="integer", description="ID of the material"),
 *     @OA\Property(property="name", type="string", description="Name of the material"),
 *     @OA\Property(property="id_type", type="integer", description="ID of the material type"),
 *     @OA\Property(property="id_env_impact", type="integer", description="ID of the environmental impact"),
 *     @OA\Property(property="id_supplier", type="integer", description="ID of the supplier"),
 *     @OA\Property(property="cost", type="string", description="Cost of the material"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Creation timestamp"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Update timestamp"),
 * )
 */
class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_type',
        'id_env_impact',
        'id_supplier',
        'cost'
    ];

    public function env_impact()
    {
        return $this->belongsTo(Envioramental_impact::class);
    }

    public function types()
    {
        return $this->belongsTo(Type::class);
    }

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class);
    }
}
