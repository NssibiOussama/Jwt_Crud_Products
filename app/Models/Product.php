<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Product",
 *     required={"name", "description", "price", "stock"},
 *     @OA\Property(
 *         property="id",
 *         description="ID unique du produit",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         description="Nom du produit",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         description="Description du produit",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="price",
 *         description="Prix du produit",
 *         type="number",
 *         format="float"
 *     ),
 *     @OA\Property(
 *         property="stock",
 *         description="Stock du produit",
 *         type="integer"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         description="Date de création du produit",
 *         type="string",
 *         format="date-time"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         description="Date de mise à jour du produit",
 *         type="string",
 *         format="date-time"
 *     )
 * )
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
    ];




}
