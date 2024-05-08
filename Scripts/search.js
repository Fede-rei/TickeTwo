document.addEventListener("DOMContentLoaded", function() {
    // Ottieni il pulsante di invio della ricerca
    var searchQuerySubmit = document.getElementById("searchQuerySubmit");

    // Aggiungi un gestore di eventi al click del pulsante di invio
    searchQuerySubmit.addEventListener("click", function(event) {
        // Impedisce il comportamento predefinito del pulsante di invio
        event.preventDefault();
        // Ottieni il valore dell'input di ricerca
        var searchQueryInput = document.getElementById("searchQueryInput").value;
        // Effettua una qualsiasi operazione di ricerca qui (es. reindirizzamento a una pagina di ricerca)
        console.log("Ricerca eseguita per: " + searchQueryInput);
    });
});