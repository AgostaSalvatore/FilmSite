import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import './FilmList.css';

function FilmList() {
    const navigate = useNavigate();

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
                console.log('Films ricevuti:', filmArray);
                console.log('Primo film:', filmArray[0]);
                setFilms(filmArray);                      // Imposta l'intera LISTA nello stato
                setLoading(false);
            })
            .catch(error => {
                console.error('Errore API:', error);
                setError(error);
                setLoading(false);
            });
    }, []);

    return (
        <div className="film-list-container">
            <h1 className="film-list-title">Catalogo Film</h1>

            {loading && (
                <div className="loading-container">
                    <div className="loading-spinner"></div>
                    <p>Caricamento...</p>
                </div>
            )}

            {error && (
                <div className="error-container">
                    <p>Errore: {error.message}</p>
                </div>
            )}

            {films.length > 0 && (
                <div className="films-grid">
                    {films.map(film => (
                        <div key={film.id} className="film-card">
                            <div className="film-card-image">
                                <img
                                    src={film.poster_url || `https://picsum.photos/seed/${film.id}/400/600`}
                                    alt={film.title}
                                    onError={(e) => {
                                        e.target.onerror = null;
                                        e.target.style.display = 'none';
                                        e.target.nextSibling.style.display = 'flex';
                                    }}
                                />
                                <div className="film-placeholder" style={{ display: 'none' }}>
                                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="1.5">
                                        <rect x="2" y="3" width="20" height="18" rx="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <path d="M14.5 14l-3.5-3.5-5 5" />
                                        <path d="M21 15l-3.5-3.5L14 15" />
                                    </svg>
                                    <span>Nessuna immagine</span>
                                </div>
                                <span className="film-year-badge">{new Date(film.release_date).getFullYear()}</span>
                            </div>

                            <div className="film-card-inner">
                                <div className="film-card-header">
                                    <h2 className="film-title">{film.title}</h2>
                                </div>

                                <div className="film-card-body">
                                    <p className="film-director">
                                        <span className="label">Regia:</span> {film.director?.name || 'N/D'}
                                    </p>
                                    {film.genres && film.genres.length > 0 && (
                                        <div className="film-genres">
                                            <span className="label">Generi:</span>
                                            <div className="genres-list">
                                                {film.genres.map(genre => (
                                                    <span key={genre.id} className="genre-badge">{genre.name}</span>
                                                ))}
                                            </div>
                                        </div>
                                    )}
                                    <p className="film-rating">
                                        <span className="label">Rating:</span> ⭐ {film.rating}/10
                                    </p>
                                </div>

                                <div className="film-card-footer">
                                    <button
                                        className="view-details-btn"
                                        onClick={() => navigate(`/films/${film.id}`)}
                                    >
                                        Vedi Dettagli
                                    </button>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
}

export default FilmList;