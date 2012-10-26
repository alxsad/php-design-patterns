<?php

class AuthService implements SplSubject
{
    /**
     * @var array
     */
    private $observers = array();

    /**
     * @var bool
     */
    private $isAuthenticated = false;

    /**
     * @return void
     */
    public function __construct ()
    {
        $this->observers = new SplObjectStorage();
    }

    /**
     * @param SplObserver $observer
     * @return AuthService
     */
    public function attach (SplObserver $observer)
    {
        $this->observers->attach($observer);
        return $this;
    }

    /**
     * @param SplObserver $observer
     * @return AuthService
     */
    public function detach (SplObserver $observer)
    {
        $this->observers->detach($observer);
        return $this;
    }

    /**
     * @return void
     */
    public function notify ()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * @return void
     */
    public function authentication ()
    {
        $this->isAuthenticated = false;
        $this->notify();
    }

    /**
     * @return bool
     */
    public function isAuthenticated ()
    {
        return $this->isAuthenticated;
    }
}

class SecurityMonitor implements SplObserver
{
    /**
     * @param SplSubject $subject
     * @return void
     */
    public function update (SplSubject $subject)
    {
        $isAuthenticated = $subject->isAuthenticated();
        if (false === $isAuthenticated) {
            echo 'Send error to system administrator';
        }
    }

}

// Example
$authService = new AuthService();
$authService->attach(new SecurityMonitor());
$authService->authentication();