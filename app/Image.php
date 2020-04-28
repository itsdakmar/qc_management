<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $url
 * @property integer $is_closed
 * @property integer $imageable_id
 * @property string $imageable_type
 * @property string $created_at
 * @property string $updated_at
 */
class Image extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['url', 'imageable_id', 'is_closed', 'imageable_type', 'created_at', 'updated_at'];

    public function imageable()
    {
        $this->morphTo();
    }

}
