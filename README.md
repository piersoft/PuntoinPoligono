# PuntoinPoligono

Questo semplice file invia la propria posizione GPS e controlla se è inscritta in un poligono Geojson caricato.
Nell'esempio ci sono le aree per Sosta Tariffata del Comune di Lecce, rilasciate con licenza CC-BY sul portale dati.comune.lecce.it
Se la propria posizione è dentro una delle aree tariffate, appare la descrizione con il costo orario ect 

Si può anche usare in modalità get inviano lat e lon.
Esempio: www.piersoft.it/ztl/?lat=40.3550&lon=18.1816

Il file index.php se non trova le variabili GET abilita il GPS del dispositivo inserendo il marker nella posizione rilevata dell'utente

Cambiare la riga 81 :   L.mapbox.accessToken inserendo il proprio API Token

Lic. MIT @piersoft
