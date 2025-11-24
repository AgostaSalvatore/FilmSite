import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom'
import './index.css'
import App from './App.jsx'
import FilmIndex from './FilmIndex.jsx'
import FilmDetail from './components/FilmDetail.jsx'

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <Router>
      <Routes>
        <Route path="/" element={<App />} />
        <Route path="/films" element={<FilmIndex />} />
        <Route path="/films/:id" element={<FilmDetail />} />
      </Routes>
    </Router>
  </StrictMode>,
)
