<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $url;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $url)
    {
        $this->url = $url;
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
                    ->subject(Lang::get('assunto_redefinir_senha'))
                    ->greeting(Lang::get('linha_redefina_sua_senha_1'))
                    ->line(Lang::get('linha_redefina_sua_senha_2'))
                    ->line(Lang::get('linha_redefina_sua_senha_3'))
                    ->action(Lang::get('linha_redefina_sua_senha_4'), $this->url)
                    ->line(Lang::get('linha_redefina_sua_senha_5'))
                    ->line(Lang::get('linha_redefina_sua_senha_6'))
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
