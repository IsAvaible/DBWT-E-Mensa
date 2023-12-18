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