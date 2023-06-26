<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class InvoiceCreate extends Notification
{
    use Queueable;

    private  $invoices;

    public function __construct(Invoice $invoices)
    {
        //
        $this->invoices = $invoices;
        
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
        $url = route('invoices.show', $this->invoices->id);
        return (new MailMessage)
            ->subject('فاتورة جديدة')
            ->from('PayInvoice@gmail.com', 'PayInvoice')
            ->greeting('مرحبا' . Auth::user()->name)
            ->line('تم اضافة فاتورة جديدة برقم:' . $this->invoices->invoice_number)
            ->action('عرض الفاتورة', $url)
            ->line('payinvoice لادارة الفواتير');
    }

    public function toDataBase($notifiable)
    {

        return [
            'id' => $this->invoices->id,
            'title' =>   'تم اضافة فاتورة جديدة برقم:' . $this->invoices->invoice_number,
            'url' => route('invoices.show', $this->invoices->id),
            'user' => Auth::user()->name,
            'date' => date("Y-m-d H:i:s"),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->invoices->id,
            'title' =>   'تم اضافة فاتورة جديدة برقم:' . $this->invoices->invoice_number,
            'url' => route('invoices.show', $this->invoices->id),
            'user' => Auth::user()->name,
            'date' => date("Y-m-d H:i:s"),

        ]);
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
