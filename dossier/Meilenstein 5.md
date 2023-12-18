### Aufgabe 1

|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |     60 min      |     20 min     |
| Simon   |     60 min      |    180 min     | 

#### 1)
```sql
CREATE TABLE benutzer
(
    id                int8 AUTO_INCREMENT,
    name              varchar(200) NOT NULL,
    email             varchar(100) NOT NULL UNIQUE,
    password          varchar(200) NOT NULL,
    admin             bool         NOT NULL DEFAULT false,
    anzahlfehler      int          NOT NULL DEFAULT 0,
    anzahlanmeldungen int          NOT NULL,
    letzteanmeldung   datetime,
    letzterfehler     datetime,
    PRIMARY KEY (id)
);
```

#### 2)
```sql
SET autocommit = 0;
```

#### 3)
```php
$salt = 'z7HjaGWj8P7S';
$admin_password = 'i9L05?QBZGD_';
```

```sql
INSERT INTO benutzer(name, email, password, admin, anzahlanmeldungen)
	VALUE (
		'Administrator',
		'admin@emensa.example',
		'19c9449c1bd8008c83e5303231e0d06bf9a37869',
		 true,
		 0);
```
	
### Aufgabe 2

|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      x min      |     x min      |
| Simon   |     20 min      |     30 min     | 

#### 1)

```sql
ALTER TABLE gericht
    ADD bildname VARCHAR(200) DEFAULT NULL AFTER beschreibung;
```
### Aufgabe 3

|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      30 min      |     35 min      |
| Simon   |      x min      |     x min      |

### Aufgabe 4

|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      10 min      |     15 min      |
| Simon   |     15 min      |     5 min      | 

#### a)

Erstellen Sie eine SQL-Sicht view_suppengerichte, die alle Suppen-Gerichte
(die ein \*suppe* im Namen tragen) darstellt

```sql
CREATE VIEW view_suppengericht AS
SELECT *
FROM gericht
WHERE name LIKE '%suppe%';
```

#### b)

Erzeugen Sie eine SQL-Sicht view_anmeldungen, die die Anzahl der
Anmeldungen pro Benutzer absteigend sortiert nach Anzahl der
Anmeldungen darstellt

```sql
CREATE VIEW view_anmeldungen AS
SELECT id, name, anzahlanmeldungen
FROM benutzer
ORDER BY anzahlanmeldungen;
```

#### c)
Erzeugen Sie die SQL-Sicht view_kategoriegerichte_vegetarisch, die alle vegetarischen Gerichte sowie die zugehörigen Kategorien zeigt. Stellen Sie immer alle Kategorien dar, auch wenn dieser Kategorie kein Gericht zugeordnet ist.
```sql
CREATE VIEW view_kategoriegerichte_vegetarisch AS
SELECT kategorie.name, gericht.name
FROM kategorie
LEFT JOIN gericht_hat_kategorie ON gericht_hat_kategorie.kategorie_id = kategorie.id
LEFT JOIN gericht ON gericht.id = gericht_hat_kategorie.gericht_id
AND gericht.vegetarisch = TRUE
ORDER BY kategorie.id;
```
### Aufgabe 5

|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      10 min      |     15 min      |
| Simon   |     10 min      |     10 min     | 

#### a)

Schreiben Sie eine Datenbank-Prozedur, die den Zähler bei einer Anmeldung anzahlanmeldungen in der Tabelle benutzer
inkrementiert. Übergeben Sie die notwendige id des betreffenden Datensatzes aus benutzer an die Prozedur

```sql
CREATE PROCEDURE track_anmeldung(IN nutzer_id INT)
BEGIN
    UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen + 1, letzteanmeldung = NOW() WHERE id = nutzer_id;
END;
```

#### c)
1. Besucher Statistiken
	- Das Hochzählen einer Besucherzahl mit internem Abgleich der IP-Adressen sollte datenbankseitig wesentlich schneller erfolgen.
	- Als Rückgabewert werden Besucherzahlen, Anzahl Newsletter Anmeldungen und Anzahl Speisen zurück gegeben. Diese infos sollten Die Datenbank ebenfalls scheller bereitstellen können.
2.  Letzte Fehlerhafte Anmeldung
	- Dies verhält sich wie a). So kann eine besser lesbarer Code entstehen.
	- Durch die Beschränkung der Logik auf den Inhalt der Datenbank kann eine höhere Effizienz erreicht werden. (Parallele ausführung?)
### Gesamt Aufwand

|         |   Benötigte Zeit   |
|:-------:|:------------------:|
| Henning |      85 min       |
|  Simon  |      225 min       |
|         |                    |
| Gesamt  | 310 min = 5.17std |
