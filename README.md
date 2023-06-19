# BnB Anonimi
Questo progetto è un'applicativo web back-end sviluppato in Laravel 9 che mira a simulare il comportamento di un strumento back-office, ispirato al famoso servizio AirBnB. L'applicazione consente agli utenti registrati di gestire gli appartamenti,le statistiche e le sponsorizzazioni, fornendo un'interfaccia intuitiva e facile da usare.  

## Funzionalità
L'applicazione offre le seguenti funzionalità principali:

### Gestione degli alloggi:
- Aggiunta, modifica ed eliminazione degli alloggi disponibili per la prenotazione.
- Caricamento e gestione di immagini associate agli alloggi.
- Visualizzazione dei dettagli degli alloggi, inclusi prezzi, disponibilità e informazioni generali.

### Gestione delle sponsorizzazioni:
- Acquisto di una sponsorizzazione che permette di rende il proprio annuncio visualizzato nei primi nella lista delle ricerche

### Gestione dei messaggi:
- Visualizzazione ed eliminazione dei messaggi per ogni singolo alloggio.

### Gestione del profilo:
- Eliminazione degli utenti dal sistema.

## Per utilizzare questo progetto
- composer install
- Copiare il file di configurazione di ambiente: cp .env.example .env
- Generare la chiave dell'applicazione: php artisan key:generate
- Configurare il file .env con le credenziali del database la chiave API per TomTom e altre impostazioni di configurazione necessarie.

- Eseguire le migrazioni del database e popolare il database con i dati di esempio: php artisan migrate --seed 

- Avviare il server di sviluppo locale: php artisan serve 
- Avviare anche il server di sviluppo locale node: npm run dev
- Accedere all'applicazione tramite il browser all'indirizzo http://localhost:8000/ (modificare la porta in base alle proprie impostazioni)


Contatti se hai domande, suggerimenti o feedback!  

Speriamo che questa documentazione ti sia stata utile! In caso di ulteriori domande, non esitare a contattarci.  

---
#### Team di sviluppo
[Alberto Gioia](https://github.com/albertogioia93)  
[Leonardo Sallustio](https://github.com/LeoSallu)  
[Luca Zanfrisco](https://github.com/LucaZanfrisco)  
[Massimiliano Sabatino](https://github.com/massimilianosabatino)  
[Mattia Fezzardi](https://github.com/Fez06)