<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        // dd($service);
        return [
            "title" => 'required|string|max:255',
            "rooms" => 'required|numeric|min:1',
            "bathrooms" => 'required|numeric|min:1',
            "beds" => 'required|numeric|min:1',
            "square_meters" => 'required|numeric|min:28',
            "cover_image" => 'required|dimensions:min_width=400,min_height=300',
            "address" => 'required',
            "visible" => 'required|boolean',
            "price" => 'required|numeric|min:20',
            "service" => "required|exists:services,id"
        ];
    }
    public function messages()
    {
        return [
            "title.required" => 'Il campo che deve contenere il nome dell`appartamento non può essere vuoto. Inserisci il nome dell`appartamento per continuare.',
            "title.max" => 'il nome dell`appartamento non può essere lungo più di 255 caratteri.',

            "rooms.required" => 'Il campo che deve contenere il numero di stanze non può essere vuoto o uguale a zero. Inserisci il numero di stanze per continuare.',
            "rooms.min" => 'Il campo che deve contenere il numero di stanze non può essere vuoto o uguale a zero. Inserisci il numero di stanze per continuare.',
            "rooms.numeric" => 'Il campo che deve contenere il numero di stanze può contenere solo numeri interi. Inserisci il numero di stanze per continuare.',

            "bathrooms.required" => 'Il campo che deve contenere il numero dei bagni non può essere vuoto o uguale a zero. Inserisci il numero dei bagni per continuare.',
            "bathrooms.min" => 'Il campo che deve contenere il numero dei bagni non può essere vuoto o uguale a zero. Inserisci il numero dei bagni per continuare.',
            "bathrooms.numeric" => 'Il campo che deve contenere il numero dei bagni può contenere solo numeri interi. Inserisci il numero dei bagni per continuare.',

            "beds.required" => 'Il campo che deve contenere il numero di letti disponibili non può essere vuoto o uguale a zero. Inserisci il numero di letti disponibili per continuare.',
            "beds.min" => 'Il campo che deve contenere il numero di letti disponibili non può essere vuoto o uguale a zero. Inserisci il numero di letti disponibili per continuare.',
            "beds.numeric" => 'Il campo che deve contenere il numero di letti disponibili può contenere solo numeri interi. Inserisci il numero di letti disponibili per continuare.',

            "square_meters.required" => 'Il campo che deve contenere il numero dei metri quadri non può essere vuoto o minore di 28. Inserisci il numero dei metri quadri per continuare.',
            "square_meters.min" => 'Il campo che deve contenere il numero dei metri quadri non può essere vuoto o minore di 28. Inserisci il numero dei metri quadri per continuare.',
            "square_meters.numeric" => 'Il campo che deve contenere il numero dei metri quadri può contenere solo numeri interi. Inserisci il numero dei metri quadri per continuare.',

            
            "cover_image.required" => 'Il campo che deve contenere l`immagine di copertina non può essere vuoto. Inserisci un`immagine per continuare',

            "address.required" => 'Il campo che deve contenere l`indirizzo non può essere vuoto. Inserisci un indirizzo esistente per continuare',

            "price.required" => 'Il campo che deve contenere il prezzo non può essere vuoto o minore di 20. Inserisci il prezzo per continuare.',
            "price.min" => 'Il campo che deve contenere il prezzo non può essere vuoto o minore di 20. Inserisci il prezzo per continuare.',
            "price.numeric" => 'Il campo che deve contenere il prezzo può contenere solo numeri interi. Inserisci il prezzo per continuare.',

            "service.required" => 'Nessun servizio selezionato. Seleziona il servizio (o i servizi) che offre il tuo appartamento per continuare.'
        ];
    }
}