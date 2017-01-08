<?php

namespace App\Notifications;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
class CommentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $comment;
    protected $post;
    protected $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Post $post, Comment $comment)
    {
        $this->comment = $comment;
        $this->user = $user;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast', 'database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->user->id, // id of the commented uesr
            'user' => $this->user->name, // name of the commented user
            'user_image' => $this->user->image, // image of the commented user
            'post_user_id' => $this->post->user_id, // id of the user that posted the status
            'post_user' => $this->post->user->name, // name of the user that posted the status
            'post_id' => $this->post->id, // actual post id
            'post_link' => route('posts.show', [$this->post->user->employee_id, $this->post->id]), // the post link
        ];
    }
}
