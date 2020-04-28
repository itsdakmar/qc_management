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
 * @property string $status
 * @property string $drawing
 * @property string $remark
 * @property string $created_at
 * @property string $closed_date
 * @property string $closed_remark
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
    protected $fillable = ['defect_type', 'latitude', 'longitude', 'responsibility_by', 'name', 'pic', 'datetime_issue', 'defect_desc', 'priority', 'status', 'drawing', 'remark', 'created_at', 'updated_at','closed_date','close_remark'];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

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

    public function setDatetimeIssueAttribute($date)
    {
        $this->attributes['datetime_issue'] = Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d H:i:s');
    }

    public function getDatetimeIssueAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d / m / Y');
    }

    public function getImageAttribute($value)
    {
        return Storage::disk('public_uploads')->url($value);
    }

    public function getPriorityAlertAttribute()
    {
        if ($this->priority === 1) {

            $alert = '<div class="alert alert-primary" role="alert"><strong>Low</strong> This report is on low priority mode!.</div>';
        } elseif ($this->priority === 2) {
            $alert = '<div class="alert alert-info" role="alert"><strong>Medium</strong> This report is on Medium priority mode!.</div>';
        } elseif ($this->priority === 3) {
            $alert = '<div class="alert alert-warning" role="alert"><strong>High</strong> This report is on High priority mode!.</div>';
        } elseif ($this->priority === 4) {
            $alert = '<div class="alert alert-danger" role="alert"><strong>Urgent</strong> This report is on Urgent priority mode!.</div>';
        } else {
            return false;
        }
        return $alert;
    }

    public function getPriorityBadgeAttribute()
    {
        if ($this->priority === 1) {
            $badge = '<span class="badge badge-primary">Low</span>';
        } elseif ($this->priority === 2) {
            $badge = '<span class="badge badge-info">Medium</span>';
        } elseif ($this->priority === 3) {
            $badge = '<span class="badge badge-warning">High</span>';
        } elseif ($this->priority === 4) {
            $badge = '<span class="badge badge-danger">Urgent</span>';
        } else {
            return false;
        }
        return $badge;
    }

    public function getStatusPillAttribute()
    {
        if ($this->status == 1) {
            $status = ' <span class="badge badge-info">Created</span>';
        } elseif ($this->status == 2) {
            $status = ' <span class="badge badge-primary">Low</span>';
        } else {
            $status = ' <span class="badge badge-success">Closed</span>';
        }
        return $status;
    }

    public function getStatusBadgeAttribute()
    {
        if ($this->status == 1) {
            $status = ' <span class="badge badge-dot mr-4"><i class="bg-info"></i><span class="status">Created</span></span>';
        } elseif ($this->status == 2) {
            $status = ' <span class="badge badge-dot mr-4"><i class="bg-primary"></i><span class="status">In Progress</span></span>';
        } else {
            $status = ' <span class="badge badge-dot mr-4"><i class="bg-green"></i><span class="status">Closed</span></span>';
        }
        return $status;
    }

    public function getDrawingPathAttribute()
    {
        return Storage::disk('public_uploads')->url($this->drawing);
    }

    public function getPriorityTitleAttribute()
    {
        if ($this->priority === 1) {
            $title = 'Low';
        } elseif ($this->priority === 2) {
            $title = 'Medium';
        } elseif ($this->priority === 3) {
            $title = 'High';
        } elseif ($this->priority === 4) {
            $title = 'Urgent';
        } else {
            return false;
        }
        return $title;
    }

    public function getStatusTitleAttribute()
    {
        if ($this->status == 1) {
            $title = 'Created';
        } elseif ($this->status == 2) {
            $title = 'In Progress';
        } elseif ($this->status == 3) {
            $title = 'Closed';
        } else {
            return false;
        }
        return $title;
    }
}
