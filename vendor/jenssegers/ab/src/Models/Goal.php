<?php namespace Jenssegers\AB\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Goal extends Eloquent {

    protected $primaryKey = 'name';

    public $timestamps = false;

    protected $fillable = ['name', 'experiment', 'count', 
            'isDesktop', 'isMobile', 'isTablet', 'isIphone', 'isAndroidOS'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        // Set the connection based on the config.
        $this->connection = Config::get('ab::connection');
    }

    public function scopeActive($query)
    {
        if ($experiments = Config::get('ab::experiments'))
        {
            return $query->whereIn('experiment', Config::get('ab::experiments'));
        }

        return $query;
    }

}
