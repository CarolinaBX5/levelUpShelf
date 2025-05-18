\connect bdsteam;

CREATE TABLE USERS (
    id_user SERIAL PRIMARY KEY,
    id_steam text,
    name TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE
);

CREATE TABLE genres (
    id_genre SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    slug TEXT NOT NULL
);

CREATE TABLE platforms (
    id_platform SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    slug TEXT NOT NULL
);

CREATE TABLE games (
    id_game SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    released TEXT,
    image TEXT,
    description TEXT
);

CREATE TABLE games_genres (
    id_game INT,
    id_genre INT,
    PRIMARY KEY (id_game, id_genre),
    FOREIGN KEY (id_game) REFERENCES games(id_game) ON DELETE CASCADE,
    FOREIGN KEY (id_genre) REFERENCES genres(id_genre) ON DELETE CASCADE
);

CREATE TABLE games_platforms (
    id_game INT,
    id_platform INT,
    PRIMARY KEY (id_game, id_platform),
    FOREIGN KEY (id_game) REFERENCES games(id_game) ON DELETE CASCADE,
    FOREIGN KEY (id_platform) REFERENCES platforms(id_platform) ON DELETE CASCADE
);

CREATE TABLE LIBRARY (
    id_library SERIAL PRIMARY KEY,
    id_user INT NOT NULL,
    date DATE NOT NULL,
    name TEXT NOT NULL,
    FOREIGN KEY (id_user) REFERENCES USERS(id_user) ON DELETE CASCADE
);

CREATE TABLE LIBRARY_GAME (
    id_library INT,
    id_game INT,
    FOREIGN KEY (id_library) REFERENCES LIBRARY(id_library) ON DELETE CASCADE,
    FOREIGN KEY (id_game) REFERENCES GAMES(id_game) ON DELETE CASCADE
);

CREATE TABLE REVIEWS (
    id_review SERIAL PRIMARY KEY,
    id_game INT NOT NULL,
    id_user INT NOT NULL,
    rating INT NOT NULL CHECK (rating BETWEEN 1 AND 10),
    comment TEXT,
    FOREIGN KEY (id_game) REFERENCES GAMES(id_game) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES USERS(id_user) ON DELETE CASCADE
);

create view "gameRating" as 
SELECT 
    g.id_game,
    g.name,
    g.released,
    g.image,
    g.description,
    CASE 
        WHEN COUNT(r.rating) = 0 THEN '-' 
        ELSE ROUND(AVG(r.rating)::numeric, 1)::text 
    END AS average_rating
FROM 
    games g
LEFT JOIN 
    reviews r ON g.id_game = r.id_game
GROUP BY 
    g.id_game, g.name, g.released, g.image, g.description
ORDER BY 
    g.id_game;
