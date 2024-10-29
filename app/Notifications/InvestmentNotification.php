<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Investment;
use App\Models\User;

class InvestmentNotification extends Notification
{
    use Queueable;

    public $investment;
    public $user;

    public function __construct(Investment $investment, User $user)
    {
        $this->investment = $investment;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Se ha realizado una nueva inversión: ' . $this->investment->title,
            'investment_id' => $this->investment->id,
            'amount' => $this->investment->amount,
            'investor_name' => $this->user->name,
            'investment_image' => $this->investment->image
        ];
    }
    public function destroy($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->delete();
    
        return back()->with('success', 'Notificación eliminada con éxito.');
    }
    
    public function deleteAll()
    {
        auth()->user()->notifications()->delete();
    
        return back()->with('success', 'Todas las notificaciones han sido eliminadas.');
    }
    
}
