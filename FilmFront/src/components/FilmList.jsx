import React, { useState, useEffect } from 'react';
import axios from 'axios';

function FilmList() {
    // 1. Dati dei film: Inizializzato come array vuoto, perché ci aspettiamo una lista
    const [films, setFilms] = useState([]);

    // 2. Stato di caricamento: Inizializzato a true, perché la richiesta API parte subito
    const [loading, setLoading] = useState(true);

    // 3. Stato di errore: Inizializzato a null, perché non ci sono errori all'inizio
    const [error, setError] = useState(null);

    useEffect(() => {
        axios.get(import.meta.env.VITE_API_URL + '/films')
            .then(response => {
                const { data: filmArray } = response.data; // Ottiene l'intera LISTA
                setFilms(filmArray);                      // Imposta l'intera LISTA nello stato
                setLoading(false);
            })
            .catch(error => {
                setError(error);
                setLoading(false);
            });
    }, []);

    return (
        <div>
            <h2>Lista Film</h2>
            {loading && <p>Loading...</p>}
            {error && <p>Error: {error.message}</p>}
            {films.length > 0 && (
                <ul>
                    {films.map(film => (
                        <li key={film.id}>{film.title}</li>
                    ))}
                </ul>
            )}
        </div>
    );
}

export default FilmList;