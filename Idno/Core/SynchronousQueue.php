<?php

namespace Idno\Core;

class SynchronousQueue extends EventQueue
{

    private $results = array();

    function enqueue($queueName, $eventName, array $eventData)
    {
        $id     = md5(microtime(true) . mt_rand() . $eventName);
        $result = Idno::site()->triggerEvent($eventName, $eventData);
        $this->results[$id] = $result;
        return $id;
    }

    function isComplete($id)
    {
        return isset($this->results[$id]);
    }

    function getResult($id)
    {
        return $this->results[$id];
    }

}