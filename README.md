# 🎬 FilmSite

A full-stack web application for browsing and managing a film catalog, built with a **Laravel REST API** backend and a **React** frontend.

---

## 📌 Table of Contents

- [Overview](#overview)
- [Tech Stack](#tech-stack)
- [Features](#features)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Backend Setup](#backend-setup)
  - [Frontend Setup](#frontend-setup)
- [API Endpoints](#api-endpoints)
- [Screenshots](#screenshots)
- [Author](#author)

---

## Overview

FilmSite is a full-stack application that allows users to browse a catalog of films, search and filter by various criteria, and view detailed information for each title. The project is split into two independent modules:

- **FilmsBack** — Laravel REST API with MySQL database
- **FilmFront** — React (Vite) single-page application consuming the API

---

## Tech Stack

### Backend
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.x-4479A1?logo=mysql&logoColor=white)

### Frontend
![React](https://img.shields.io/badge/React-18.x-61DAFB?logo=react&logoColor=black)
![Vite](https://img.shields.io/badge/Vite-4.x-646CFF?logo=vite&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.x-38B2AC?logo=tailwind-css&logoColor=white)

### Tools
![Git](https://img.shields.io/badge/Git-F05032?logo=git&logoColor=white)
![Postman](https://img.shields.io/badge/Postman-FF6C37?logo=postman&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-885630?logo=composer&logoColor=white)

---

## Features

- 📋 **Film catalog** — paginated list of all available films
- 🔍 **Search & Filters** — filter films by title, genre, or other criteria
- 🔗 **RESTful API** — full CRUD operations exposed via Laravel
- 🗃️ **Relational Database** — 1:N and N:N relationships (e.g. films ↔ genres, films ↔ actors)
- 🖼️ **Image Upload** — cover images handled server-side
- 🔒 **CORS/CSRF** — properly configured for frontend-backend communication
- 📱 **Responsive UI** — mobile-friendly interface with Tailwind CSS

---

## Project Structure

```
FilmSite/
├── FilmsBack/          # Laravel backend
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/    # API Controllers
│   │   │   └── Requests/       # Form Request validation
│   │   └── Models/             # Eloquent Models
│   ├── database/
│   │   ├── migrations/         # Database schema
│   │   └── seeders/            # Seed data
│   ├── routes/
│   │   └── api.php             # API routes
│   └── storage/app/public/     # Uploaded images
│
└── FilmFront/          # React frontend
    ├── src/
    │   ├── components/         # Reusable UI components
    │   ├── pages/              # Page-level components
    │   └── api/                # Axios API calls
    ├── public/
    └── vite.config.js
```

---


## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/films` | Get all films (paginated) |
| GET | `/api/films/{id}` | Get a single film |
| POST | `/api/films` | Create a new film |
| PUT | `/api/films/{id}` | Update a film |
| DELETE | `/api/films/{id}` | Delete a film |
| GET | `/api/genres` | Get all genres |

> Full API documentation can be tested via Postman.

## Author

**Salvatore Agosta** — Junior Backend Developer

[![GitHub](https://img.shields.io/badge/GitHub-AgostaSalvatore-181717?logo=github)](https://github.com/AgostaSalvatore)
[![LinkedIn](https://img.shields.io/badge/LinkedIn-Salvatore%20Agosta-0A66C2?logo=linkedin)](https://www.linkedin.com/in/salvatore-agosta-08795b38a/)
[![Email](https://img.shields.io/badge/Email-Agosta.boolean@gmail.com-D14836?logo=gmail&logoColor=white)](mailto:Agosta.boolean@gmail.com)

---

> *Built as part of the Boolean Web Developer program — PHP/Laravel specialization track.*
