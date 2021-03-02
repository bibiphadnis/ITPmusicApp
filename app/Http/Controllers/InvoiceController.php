<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index() {
        
        // $invoices = Invoice::all(); N+! problem
        $invoices = Invoice::with(['customer'])->get();
        
        
        // $invoices = DB::table('invoices') //SELECT * FROM invoices
        // ->join('customers', 'invoices.customer_id', '=', 'customers.id')
        // ->get([
        //     'invoices.id AS id',
        //     'invoice_date',
        //     'first_name',
        //     'last_name',
        //     'total'
        // ]);
       
        return view('invoice.index', [
            'invoices' => $invoices
        ]);

    }

    public function show($id) 
    {
       
        // $invoice = DB::table('invoices')
        // ->where('id', '=', $id)
        // ->first();

        // $invoiceItems = DB::table('invoice_items')
        //     ->where('invoice_id', '=', $id)
        //     ->join('tracks', 'invoice_items.track_id', '=', 
        //     'tracks.id')
        //     ->join('albums', 'tracks.album_id', '=', 'albums.id')
        //     ->join(
        //         'artists', 'albums.artist_id', '=', 'artists.id')
        //     ->get([
        //         'invoice_items.unit_price',
        //         'tracks.name AS track',
        //         'albums.title AS album',
        //         'artists.name AS artist',
        //     ]);

        $invoice = Invoice::with([
            'invoiceItems.track',
            'invoiceItems.track.album',
            'invoiceItems.track.album.artist'
        ])
        ->find($id);

        return view('invoice.show', [
            'invoice' => $invoice,
            // 'invoiceItems' => $invoiceItems,
        ]);
    }


}
