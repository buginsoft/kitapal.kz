<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MailResetPasswordNotification extends Notification
{
    use Queueable;
    protected $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token=$token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail( $notifiable ) {
        $link = url( "/password/reset/$this->token");

        if(app()->getLocale()=='kz'){
            return ( new MailMessage )
                ->from('kitapall18@gmail.com','kitapall')
                ->subject( 'Сброс пароля' )
                ->line( "Біз сізден құпиясөзді қалпына келтіруге сұраныс алдық." )
                ->action( 'Қалпына келтіру', $link )
                ->line( 'Бұл құпиясөзді қалпына келтіру сілтемесінің мерзімі 60 минуттан кейін аяқталады. Құпия сөзді қалпына келтіруді сұрамасаңыз, қосымша әрекет қажет емес.' );
        }
        else{
            return ( new MailMessage )
                ->from('kitapall18@gmail.com','kitapall')
                ->subject( 'Сброс пароля' )
                ->line( "Вы получили это письмо, потому что мы получили запрос на сброс пароля для вашей учетной записи." )
                ->action( 'Сбросить пароль', $link )
                ->line( 'Срок действия этой ссылки для сброса пароля истекает через 60 минут.Если вы не запрашивали сброс пароля, никаких дальнейших действий не требуется.' );
        }
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
            //
        ];
    }
}
