<?php namespace Jenssegers\AB\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Log extends Eloquent {

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['experiment', 'goal', 'device', 'platform', 'browser'];

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
