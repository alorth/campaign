<?php namespace Jenssegers\AB;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FRequest;
use Illuminate\Support\Facades\Log as Logger;

use Ramsey\Uuid\Uuid;

use Jenssegers\AB\Session\SessionInterface;
use Jenssegers\AB\Models\Experiment;
use Jenssegers\AB\Models\Goal;
use Jenssegers\AB\Models\Log;
use Jenssegers\Agent\Agent;

class Tester {

    /**
     * The Session instance.
     *
     * @var SessionInterface
     */
    protected $session;

    /**
     * Constructor.
     *
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Track clicked links and form submissions.
     *
     * @param  Request $request
     * @return void
     */
    public function track(Request $request)
    {
        // Don't track if there is no active experiment.
        if ( ! $this->session->get('experiment/' . $this->prefix())) return;


        // Since there is an ongoing experiment, increase the pageviews.
        // This will only be incremented once during the whole experiment.
        $this->pageview();

        // Check current and previous urls.
        $root = $request->root();
        $from = ltrim(str_replace($root, '', $request->headers->get('referer')), '/');
        $to = ltrim(str_replace($root, '', $request->getPathInfo()), '/');

        // Don't track refreshes.
        if ($from == $to) return;

        // Because the visitor is viewing a new page, trigger engagement.
        // This will only be incremented once during the whole experiment.
        $this->interact();

        $goals = $this->getGoals();

        // Detect goal completion based on the current url.
        if (in_array($to, $goals) or in_array('/' . $to, $goals))
        {
            $this->complete($to);
        }

        // Detect goal completion based on the current route name.
        if ($route = Route::currentRouteName() and in_array($route, $goals))
        {
            $this->complete($route);
        }
    }

    /**
     * Get or compare the current experiment for this session.
     *
     * @param  string  $target
     * @return bool|string
     */
    public function experiment($target = null)
    {
        // Get the existing or new experiment.
        $experiment = $this->session->get('experiment/' . $this->prefix()) ?: $this->nextExperiment();
        // $experiment = $this->nextExperiment();
        if (is_null($target))
        {
            return $experiment;
        }

        return $experiment == $target;
    }

    /**
     * Increment the pageviews for the current experiment.
     *
     * @return void
     */
    public function pageview()
    {
	// If it is bot, refuse it
	$agent = new Agent();
	if (!$agent->device() or $agent->device() == 'Bot') return;

        // Only interact once per experiment.        
        if ($this->session->get('pageview/' . $this->prefix())) return;        
        $experiment = Experiment::firstOrNew(['name' => $this->experiment()]);
        $experiment->visitors++;        
        $experiment->save();

        $goal = Goal::firstOrCreate(['name' => 'all', 'experiment' => $this->experiment()]);
        $deviceInfo = $this->getDeviceInfo($goal);
        Goal::where('name', 'all')->where('experiment', $this->experiment())
            ->update(array_merge(['count' => ($goal->count + 1)], $deviceInfo));
        
        $this->logAll('all');        

        // Mark current experiment as interacted.
        $this->session->set('pageview/' . $this->prefix(), 1);
    }

    /**
     * Increment the engagement for the current experiment.
     *
     * @return void
     */
    public function interact()
    {
        // Only interact once per experiment.
        if ($this->session->get('interacted')) return;

        $experiment = Experiment::firstOrNew(['name' => $this->experiment()]);
        $experiment->engagement++;
        $experiment->save();

        // Mark current experiment as interacted.
        $this->session->set('interacted', 1);
    }

    /**
     * Mark a goal as completed for the current experiment.
     *
     * @return void
     */
    public function complete($name)
    {
        // Only complete once per experiment.
        $experiment = $this->experiment();
        $prefix = $this->prefix();
        Logger::info('Complete : ' . "completed_" . $prefix . "_" . $name);
        if ($this->session->get("completed_" . $prefix . "_" . $name)) return;

        $goal = Goal::firstOrCreate(['name' => $name, 'experiment' => $experiment]);
        $deviceInfo = $this->getDeviceInfo($goal);
        Goal::where('name', $name)->where('experiment', $experiment)
            ->update(array_merge(['count' => ($goal->count + 1)], $deviceInfo));
        $this->logAll($name);

        // Mark current experiment as completed.
        $this->session->set("completed_" . $prefix . "_" . $name, 1);
    }


    private function getDeviceInfo($goal)
    {
        $agent = new Agent();
        return [
            'isDesktop' => $goal->isDesktop + ($agent->isDesktop() ? 1 : 0),
            'isMobile' => $goal->isMobile + ($agent->isMobile() ? 1 : 0),
            'isTablet' => $goal->isTablet + ($agent->isTablet() ? 1 : 0),
            'isIphone' => $goal->isIphone + ($agent->isIphone() ? 1 : 0),
            'isAndroidOS' => $goal->isAndroidOS + ($agent->isAndroidOS() ? 1 : 0)
        ];
    }

    private function logAll($name)
    {
        $uuid = $this->session->get('uuid')? 
            $this->session->get('uuid') : Uuid::uuid1()->toString();
        
        $ip = FRequest::ip();
        Logger::info("log all, ip = " . $ip . ", uuid = " . $uuid);

        $agent = new Agent();
        $log = new Log(['experiment' => $this->experiment(), 'goal' => $name]);
        $log->device = $agent->device();
        $log->platform = $agent->platform();
        $log->browser = $agent->browser();
        $log->uuid = $uuid;
        $log->ip = $ip;
        $log->save();   

        $this->session->set('uuid', $uuid);
    }

    public function logYoutube($time)
    {
        if(!$this->session->get('uuid')) {
            Logger::warning('cannot find session uuid');
            return;  
        } 
        $uuid = $this->session->get('uuid');
        $log = Log::where('uuid', $uuid)->firstOrFail();
        $log->youtube_time = $log->youtube_time > $time ? $log->youtube_time : $time;
        $log->save();
    }

    public function getUuid()
    {
        return $this->session->get('uuid');
    }

    /**
     * Set the current experiment for this session manually.
     *
     * @param string $experiment
     */
    public function setExperiment($experiment)
    {
        if ($this->session->get('experiment/' . $this->prefix()) != $experiment)
        {
            $this->session->set('experiment/' . $this->prefix(), $experiment);

            // Increase pageviews for new experiment.
            $this->nextExperiment($experiment);
        }
    }

    /**
     * Get all experiments.
     *
     * @return array
     */
    public function getExperiments()
    {
        return Config::get('ab::experiments', []);
    }

    /**
     * Get all goals.
     *
     * @return array
     */
    public function getGoals()
    {
        return Config::get('ab::goals', []);
    }

    /**
     * Get the session instance.
     *
     * @return SessionInterface
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set the session instance.
     *
     * @param $session SessionInterface
     */
    public function setSession(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Prepare an experiment for this session.
     *
     * @return string
     */
    protected function nextExperiment($experiment = null)
    {
        // Verify that the experiments are in the database.
        $this->checkExperiments();

        if ($experiment)
        {
            $experiment = Experiment::active()->findOrfail($experiment);
        }
        else
        {
            $experiment = Experiment::active()->orderBy('visitors', 'asc')->firstOrFail();
        }

        $this->session->set('experiment/' . $this->prefix(), $experiment->name);

        // Since there is an ongoing experiment, increase the pageviews.
        // This will only be incremented once during the whole experiment.
        $this->pageview();

        return $experiment->name;
    }

    /**
     * Add experiments to the database.
     *
     * @return void
     */
    protected function checkExperiments()
    {
        // Check if the database contains all experiments.
        if (Experiment::active()->count() != count($this->getExperiments()))
        {
            // Insert all experiments.
            foreach ($this->getExperiments() as $experiment)
            {
                Experiment::firstOrCreate(['name' => $experiment]);
            }
        }
    }

    private function prefix()
    {
        // The path will look like '/product/{prefix}', we need to get the prefix
        strtok(FRequest::path(), '/');
        return strtok('/');
    }

}
