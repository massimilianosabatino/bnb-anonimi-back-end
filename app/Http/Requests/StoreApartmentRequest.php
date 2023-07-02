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
            "title.required" => 'Il nome dell`appartamento è obbligatorio.',
            "title.max" => 'Il nome dell`appartamento non può essere lungo più di 255 caratteri.',

            "rooms.required" => 'Il numero di stanze è obbligatorio.',
            "rooms.min" => 'Deve essere minimo una stanza.',
            "rooms.numeric" => 'Il numero di stanze può contenere solo numeri interi. Es. 1 2 3 ecc.',

            "bathrooms.required" => 'Il numero di bagni è obbligatorio.',
            "bathrooms.min" => 'Deve essere minimo un bagno.',
            "bathrooms.numeric" => 'Il numero di bagni può contenere solo numeri interi. Es. 1 2 3 ecc.',

            "beds.required" => 'Il numero di letti è obbligatorio.',
            "beds.min" => 'Deve essere un minimo un letto.',
            "beds.numeric" => 'Il numero di letti può contenere solo numeri interi. Es. 1 2 3 ecc.',

            "square_meters.required" => 'Il numero di metri quadri è obbligatorio.',
            "square_meters.min" => 'Il numero di metri quadri deve essere minimo di 28',
            "square_meters.numeric" => 'Il numero di metri quadri può contenere solo numeri interi. Es. 1 2 3 ecc.',

            
            "cover_image.required" => 'L`immagine di copertina è obbligatoria.',

            "address.required" => 'L`indirizzo dell`appartamento è obbligatorio.',

            "price.required" => 'Il prezzo dell`appartamento è obbligatorio.',
            "price.min" => 'Il prezzo non può essere inferiore di 20.',
            "price.numeric" => 'Il numero di metri quadri può contenere solo numeri interi. Es. 20,30,100 ecc.',

            "service.required" => 'Nessun servizio selezionato. Seleziona il servizio (o i servizi) che offre il tuo appartamento per continuare.'
        ];
    }
}