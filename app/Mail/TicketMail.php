<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction;

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    public function build()
    {
        // 1. PERHATIKAN DI SINI: Sudah diubah menjadi 'emails.ticket'
        $pdf = Pdf::loadView('emails.ticket', ['transaction' => $this->transaction]);

        // 2. Kirim email dengan lampiran PDF tersebut
        return $this->subject('E-Ticket Resmi: ' . $this->transaction->event->name)
                    ->view('emails.ticket') // Ini isi teks emailnya
                    ->attachData($pdf->output(), 'E-Ticket-' . $this->transaction->id . '.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
