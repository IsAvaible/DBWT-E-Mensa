# a)
CREATE VIEW view_suppengericht AS
SELECT *
FROM gericht
WHERE name LIKE '%suppe%';

# b)
CREATE VIEW view_anmeldungen AS
SELECT id, name, anzahlanmeldungen
FROM benutzer
ORDER BY anzahlanmeldungen;

# c)
CREATE VIEW view_kategoriegerichte_vegetarisch AS
SELECT kategorie.name, gericht.name
FROM kategorie
         LEFT JOIN gericht_hat_kategorie ON gericht_hat_kategorie.kategorie_id = kategorie.id
         LEFT JOIN gericht ON gericht.id = gericht_hat_kategorie.gericht_id
    AND gericht.vegetarisch = TRUE
ORDER BY kategorie.id;