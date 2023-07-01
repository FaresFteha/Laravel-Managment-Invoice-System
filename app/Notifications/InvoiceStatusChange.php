<?php

namespace App\Notifications;

use App\Models\Invoice_statu;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class InvoiceStatusChange extends Notification
{
    use Queueable;

    private $invoice_statu;

    public function __construct(Invoice_statu $invoice_statu)
    {
        //
        $this->invoice_statu = $invoice_statu;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $via = ['database', 'mail', 'broadcast'];
        if ($notifiable->notify_mail) {
            $via[] = 'mail';
        }
        if ($notifiable->notify_sms) {
            $via[] = 'nexmo';
        }

        return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }


    public function toDataBase($notifiable)
    {

        return [
            'id' => $this->invoice_statu->id,
            'title' =>   'تم تغيير حالة الفاتورة التي برقم:' . $this->invoice_statu->invoices->invoice_number . ' الى ' .  $this->invoice_statu->status ,
            'url' => route('invoicesstatus.show', $this->invoice_statu->id),
            'user' => Auth::user()->name,
            'date' => date("Y-m-d H:i:s"),
        ];
    }


    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->invoice_statu->id,
            'title' =>   'تم تغيير حالة الفاتورة التي برقم:' . $this->invoice_statu->invoices->invoice_number . ' الى ' .  $this->invoice_statu->status ,
            'url' => route('invoicesstatus.show', $this->invoice_statu->id),
            'user' => Auth::user()->name,
            'date' => date("Y-m-d H:i:s"),
        ]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
