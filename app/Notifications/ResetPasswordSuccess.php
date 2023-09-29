<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use MVC\Models\User\User;

class ResetPasswordSuccess extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
                ->subject(Lang::get('assunto_sucesso_redefinir_senha'))
                ->greeting(Lang::get('ola_nome', ['nome' => $this->user->name]))
                ->line(Lang::get('linha_sucesso_redefinir_senha_1'))
                ->line(Lang::get('linha_sucesso_redefinir_senha_2'))
                ->action(Lang::get('recuperar_conta'), config('erp.front_url') . '/forgot-password')
                ->line(Lang::get('linha_sucesso_redefinir_senha_3'))
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
