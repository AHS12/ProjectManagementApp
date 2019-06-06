<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProjectWasCreated
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $project;
    public function __construct($project)
    {
        //
        $this->project = $project;
    }

    /* #region Dont need Broadcast */
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    // public function broadcastOn()
    // {
    //     return new PrivateChannel('channel-name');
    // }

    /* #endregion */
}
