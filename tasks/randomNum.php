<?php

namespace tasks;

use Amp\Cancellation;
use Amp\Parallel\Worker\Task;
use Amp\Sync\Channel;

class randomNum implements Task
{
    private $increment;

    public function __construct($increment)
    {
        $this->increment = $increment;
    }

    /**
     * @inheritDoc
     */
    public function run(Channel $channel, Cancellation $cancellation): mixed
    {
        $randomNumber = rand(0,100);
        //We have an if statement in place to set certain workers to sleep for 3 seconds to demonstrate that functions are not run synchronously and that parallel processing
        // is taking place
        //This will be noted once we review all results
        if($randomNumber > 50)
        {
            sleep(3);
            $test = array(
                $this->increment => $randomNumber
            );
            return $test;
        }
        else
        {
            $test = array(
                $this->increment => $randomNumber
            );
            return $test;
        }
    }
}