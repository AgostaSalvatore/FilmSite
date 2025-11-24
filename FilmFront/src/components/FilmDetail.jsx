import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import axios from 'axios';
import './FilmDetail.css';

function FilmDetail() {
    const { id } = useParams();
    const navigate = useNavigate();
    const [film, setFilm] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        axios.get(`${import.meta.env.VITE_API_URL}/films/${id}`)
            .then(response => {
                const filmData = response.data.data;
                console.log('Film dettaglio:', filmData);
                setFilm(filmData);
                setLoading(false);
            })
            .catch(error => {
                console.error('Errore caricamento film:', error);
                setError(error);
                setLoading(false);
            });
    }, [id]);

    if (loading) {
        return (
            <div className="film-detail-container">
                <div className="loading-container">
                    <div className="loading-spinner"></div>
                    <p>Caricamento...</p>
                </div>
            </div>
        );
    }

    if (error || !film) {
        return (
            <div className="film-detail-container">
                <div className="error-container">
                    <p>Errore nel caricamento del film</p>
                    <button onClick={() => navigate('/films')} className="back-btn">
                        Torna alla lista
                    </button>
                </div>
            </div>
        );
    }

    return (
        <div className="film-detail-container">
            <button onClick={() => navigate('/films')} className="back-btn">
                ← Torna alla lista
            </button>

            <div className="film-detail-content">
                <div className="film-detail-poster">
                    <img
                        src={film.poster_url || `https://picsum.photos/seed/${film.id}/500/750`}
                        alt={film.title}
                        onError={(e) => {
                            e.target.onerror = null;
                            e.target.src = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="500" height="750"%3E%3Crect fill="%23333" width="500" height="750"/%3E%3Ctext fill="%23fff" x="50%25" y="50%25" text-anchor="middle" dominant-baseline="middle" font-size="24"%3ENessuna immagine%3C/text%3E%3C/svg%3E';
                        }}
                    />
                </div>

                <div className="film-detail-info">
                    <h1 className="film-detail-title">{film.title}</h1>

                    <div className="film-detail-meta">
                        <span className="film-year">{new Date(film.release_date).getFullYear()}</span>
                        <span className="film-rating">⭐ {film.rating}/10</span>
                    </div>

                    <div className="film-detail-section">
                        <h3>Regia</h3>
                        <p>{film.director?.name || 'N/D'}</p>
                    </div>

                    {film.genres && film.genres.length > 0 && (
                        <div className="film-detail-section">
                            <h3>Generi</h3>
                            <div className="genres-list">
                                {film.genres.map(genre => (
                                    <span key={genre.id} className="genre-badge">{genre.name}</span>
                                ))}
                            </div>
                        </div>
                    )}

                    <div className="film-detail-section">
                        <h3>Descrizione</h3>
                        <p>{film.description}</p>
                    </div>

                    <div className="film-detail-section">
                        <h3>Cast</h3>
                        <p>{film.cast}</p>
                    </div>

                    {film.trailer && (
                        <div className="film-detail-section">
                            <h3>Trailer</h3>
                            <a href={film.trailer} target="_blank" rel="noopener noreferrer" className="trailer-link">
                                Guarda il trailer
                            </a>
                        </div>
                    )}
                </div>
            </div>
        </div>
    );
}

export default FilmDetail;
