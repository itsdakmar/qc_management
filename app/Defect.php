<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $defect_type
 * @property integer $responsibility_by
 * @property string $pic
 * @property string $datetime_issue
 * @property string $defect_desc
 * @property integer $priority
 * @property string $image
 * @property string $remark
 * @property string $created_at
 * @property string $updated_at
 * @property DefectType $defectType
 * @property Responsibility $responsibility
 */
class Defect extends Model
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
    protected $fillable = ['defect_type', 'responsibility_by', 'pic', 'datetime_issue', 'defect_desc', 'priority', 'image', 'remark', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function defectType()
    {
        return $this->belongsTo('App\DefectType', 'defect_type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function responsibility()
    {
        return $this->belongsTo('App\Responsibility', 'responsibility_by');
    }
}
