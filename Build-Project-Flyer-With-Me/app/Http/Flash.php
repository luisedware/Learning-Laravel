<?php

namespace App\Http;

class Flash
{
    public function create($title, $message, $level, $type="flash_message")
    {
        return session()->flash($type, [
            'title'=>$title,
            'message'=>$message,
            'level'=>$level,
            ]);
    }

    public function info($title, $message)
    {
        return $this->create($title, $message, 'info');
    }

    public function success($title, $message)
    {
        return $this->create($title, $message, 'success');
    }

    public function error($title, $message)
    {
        return $this->create($title, $message, 'error');
    }

    public function warning($title, $message)
    {
        return $this->create($title, $message, 'warning');
    }

    public function overlay($title, $message, $level='message')
    {
        return $this->create($title, $message, $level, 'flash_message_overlay');
    }

    // public function __call($level, $argument)
    // {
    //     session()->flash('flash_message', [
    //         'title'=>$argument[0],
    //         'message'=>$argument[1],
    //         'level'=>$level
    //     ]);
    // }
}
