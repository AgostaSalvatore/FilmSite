import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import './FilmList.css';

function FilmList() {
    const navigate = useNavigate();


    // 1. Dati dei film
    const [films, setFilms] = useState([]);
    // 2. Stato di caricamento
    const [loading, setLoading] = useState(true);
    // 3. Stato di errore
    const [error, setError] = useState(null);

    // Stati per la ricerca
    const [searchTitle, setSearchTitle] = useState('');
    const [searchGenre, setSearchGenre] = useState('');

    // Lista generi disponibili per il dropdown
    const [availableGenres, setAvailableGenres] = useState([]);

    const fetchFilms = () => {
        setLoading(true);
        // Costruiamo i parametri di query solo se hanno valore
        const params = {};
        if (searchTitle) params.title = searchTitle;
        if (searchGenre) params.genre = searchGenre;

        axios.get(import.meta.env.VITE_API_URL + '/films', { params })
            .then(response => {
                const { data: filmArray } = response.data;
                setFilms(filmArray);
                setLoading(false);
            })
            .catch(error => {
                console.error('Errore API:', error);
                setError(error);
                setLoading(false);
            });
    };

    // Caricamento iniziale
    useEffect(() => {
        fetchFilms();

        // Carica anche i generi
        axios.get(import.meta.env.VITE_API_URL + '/genres')
            .then(response => {
                setAvailableGenres(response.data.data);
            })
            .catch(err => console.error('Errore caricamento generi:', err));

        // eslint-disable-next-line react-hooks/exhaustive-deps
    }, []);

    const handleSearch = (e) => {
        e.preventDefault();
        fetchFilms();
    };

    return (
        <div className="film-list-container">
            <h1 className="film-list-title">Catalogo Film</h1>

            {/* Search Bar */}
            <div className="search-container" style={{ marginBottom: '2rem', display: 'flex', justifyContent: 'center', gap: '1rem' }}>
                <form onSubmit={handleSearch} style={{ display: 'flex', gap: '1rem', flexWrap: 'wrap', justifyContent: 'center' }}>
                    <input
                        type="text"
                        placeholder="Cerca per titolo..."
                        value={searchTitle}
                        onChange={(e) => setSearchTitle(e.target.value)}
                    />
                    <select
                        value={searchGenre}
                        onChange={(e) => setSearchGenre(e.target.value)}
                        style={{ width: '200px' }}
                    >
                        <option value="">Tutti i generi</option>
                        {availableGenres.map(genre => (
                            <option key={genre.id} value={genre.name}>
                                {genre.name}
                            </option>
                        ))}
                    </select>
                    <button
                        type="submit"
                        className="view-details-btn"
                        style={{ padding: '0.5rem 1rem', cursor: 'pointer' }}
                    >
                        Cerca
                    </button>
                    {(searchTitle || searchGenre) && (
                        <button
                            type="button"
                            onClick={() => {
                                setSearchTitle('');
                                setSearchGenre('');
                                // Necessario un piccolo timeout o chiamare fetchFilms direttamente con params vuoti perché setState è asincrono
                                // Ma meglio passare params espliciti a fetchFilms se volessimo farlo pulito.
                                // Per semplicità qui resettiamo e ricarichiamo "alla vecchia" o facciamo un reload sporco, 
                                // ma meglio fare set e poi fetch nella prossima render o passare argomenti.
                                // Qui facciamo il reset e triggeriamo manualmente un fetch "pulito"
                                setLoading(true);
                                axios.get(import.meta.env.VITE_API_URL + '/films')
                                    .then(res => {
                                        setFilms(res.data.data);
                                        setLoading(false);
                                        setSearchTitle('');
                                        setSearchGenre('');
                                    });
                            }}
                            className="view-details-btn"
                            style={{ backgroundColor: '#666', padding: '0.5rem 1rem' }}
                        >
                            Reset
                        </button>
                    )}
                </form>
            </div>

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