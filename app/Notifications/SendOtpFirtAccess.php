<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use MVC\Models\FirstAccess\FirstAccess;
use MVC\Models\User\User;

class SendOtpFirtAccess extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $newCode;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, FirstAccess $newCode)
    {
        $this->user    = $user;
        $this->newCode = $newCode;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                ->subject(Lang::get('assunto_primeiro_acesso'))
                ->greeting(Lang::get('ola_nome', ['nome' => $this->user->name]))
                ->line(Lang::get('linha_primeiro_acesso_1'))
                ->line(Lang::get('linha_primeiro_acesso_2'))
                ->action($this->newCode->otp, config('erp.front_url') . '/first-access/' . $this->newCode->user_uuid)
                ->line(Lang::get('linha_primeiro_acesso_3'))
                ->salutation(Lang::get('saudacao_email'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
