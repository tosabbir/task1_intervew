<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;
use Illuminate\Mail\Mailables\Attachment;

class ProductAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $product_info;

    /**
     * Create a new message instance.
     */
    public function __construct($id)
    {
       $this->product_info = Product::find($id);

    }












    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Product Added',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.product_add_mail',
            with: [
                'name' => $this->product_info->product_name,
                'category' => $this->product_info->categoryInfo->category_name,
                'price' => $this->product_info->product_sel_price,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // Attachment::fromPath('uploads/products/'.$this->product_info->product_thumbnail)->as('product_thumbnail.jpeg')
            // ->withMime('image/jpeg'),
        ];
    }
}
