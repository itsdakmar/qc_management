<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @property integer $id
 * @property integer $defect_type
 * @property integer $responsibility_by
 * @property string $name
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
    protected $fillable = ['defect_type', 'latitude', 'longitude', 'responsibility_by', 'name', 'pic', 'datetime_issue', 'defect_desc', 'priority', 'image', 'remark', 'created_at', 'updated_at'];

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

    public function setDatetimeIssueAttribute($date) {
        $this->attributes['datetime_issue'] = Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d H:i:s');
    }

    public function getDatetimeIssueAttribute($date) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d / m / Y');
    }

    public function getImageAttribute($value) {
        return Storage::disk('public_uploads')->url($value);
    }

    public function getPriorityBadgeAttribute(){
        if ($this->priority === 1){
            $badge = '<span class="badge badge-secondary">Low</span>';
        }elseif ($this->priority === 2){
            $badge = '<span class="badge badge-success">Medium</span>';
        }elseif ($this->priority === 3){
            $badge = '<span class="badge badge-warning">High</span>';
        }elseif($this->priority === 4){
            $badge = '<span class="badge badge-danger">Urgent</span>';
        }else {
            return false;
        }
        return $badge;
    }

    public function getPriorityTitleAttribute(){
        if ($this->priority === 1){
            $title = 'Low';
        }elseif ($this->priority === 2){
            $title = 'Medium';
        }elseif ($this->priority === 3){
            $title = 'High';
        }elseif($this->priority === 4){
            $title = 'Urgent';
        }else {
            return false;
        }
        return $title;
    }
}
