<?php

namespace Cygnet\Cache;

class CygnetCache
{
    /**
     * Is Cache Exists
     * 
     * @var bool
     */
    public $check = false;

    /**
     * Is Debug Mode
     * 
     * @var bool
     */
    public $isDebug = false;

    /**
     * Cache Keys
     * 
     * @var string
     */
    public $cacheKey = false;

    /**
     * Init Cygnet Cache
     */
    public function __construct($debug = false)
    {
        $this->isDebug = $debug;
    }
    
    /**
     * Set key
     * 
     * @param array $keys
     */
    public function setKey($keys = [])
    {
        if(isset($keys) && is_array($keys) && count($keys))
        {
            $this->generateKey($keys);
        }
        
        return $this;
    }

    /**
     * Check
     * 
     * @param array $keys
     * @return $this
     */
    public function check($keys = [])
    {
        return $this->check = \Cache::Has($this->cacheKey) ? true : false;
    }

    /**
     * Get 
     * 
     * @return Object|bool
     */
    public function get()
    {
        return \Cache::Has($this->cacheKey) ? \Cache::Get($this->cacheKey) : false;
    }

    /**
     * Set
     * 
     * @param array $keys
     * @param int $duration
     * @param array $result
     * @return array
     */
    public function set($keys = [], $duration = 60, $result = [])
    {
        \Cache::put($this->generateKey($keys), $result, $duration);

        return $result;
    }

    /**
     * Generate Key
     * 
     * @param array $input
     * @return string
     */
    protected function generateKey($input = [])
    {
        if(is_array($input) && isset($input) && count($input))
        {
            $this->cacheKey = implode("_", $input);
            return true;
        }

        $this->cacheKey = 'cache_key';
        
        return true;
    }

    /**
     * Log Cache
     * 
     * @param string $message
     * @return void
     */
    public function log($message = null)
    {
        if(isset($message) && !empty($message) && $this->isDebug)
        {
            \Log::debug($message);
        }
        
        return $this;
    }
}
?>