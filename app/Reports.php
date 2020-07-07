<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    /**
     * Get the type of abuse for this report.
     */
    public function abuse_type()
    {
        return $this->belongsTo('App\AbuseTypes');
    }
}
