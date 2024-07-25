<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BudgetLimitApproaching extends Notification
{
    use Queueable;

    public $amountSpent;

    public function __construct($amountSpent)
    {
        $this->amountSpent = $amountSpent;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You are approaching your budget limit.')
                    ->line('You have spent ' . $this->amountSpent . ' this month.')
                    ->action('View Transactions', url('/transactions'))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'amount_spent' => $this->amountSpent,
        ];
    }
}