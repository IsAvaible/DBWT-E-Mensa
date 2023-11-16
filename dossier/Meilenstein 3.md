### Aufgabe 1

|         | Geschätzte Zeit | Benötigte Zeit |
| ------- | --------------- | -------------- |
| Henning | 2 min           | 2 min          |
| Simon   | x min          | x min         |

### Aufgabe 2
|         | Geschätzte Zeit | Benötigte Zeit |
| ------- | --------------- | -------------- |
| Henning | 20 min           | 40 min          |
| Simon   | x min          | x min         |

#### 1)
```sql
CREATE DATABASE emensawerbeseite
    CHARACTER SET UTF8mb4
    COLLATE utf8mb4_unicode_ci;
```

```sql
USE emensawerbeseite;
```
#### 2)
```sql
CREATE TABLE gericht
(
    id           INTEGER PRIMARY KEY,
    name         VARCHAR(80)     NOT NULL,
    beschreibung VARCHAR(800)    NOT NULL,
    erfasst_am   DATE            NOT NULL,
    vegetarisch  BOOL            NOT NULL DEFAULT FALSE,
    vegan        BOOL            NOT NULL DEFAULT FALSE,
    preisintern  DOUBLE UNSIGNED NOT NULL,
    preisextern  DOUBLE UNSIGNED NOT NULL,
    CHECK (preisintern <= preisextern)
);
```

```sql
CREATE TABLE allergen
(
    code char(4) PRIMARY KEY,
    name VARCHAR(300)  NOT NULL,
    typ  VARCHAR(20) NOT NULL DEFAULT 'allergen'
);
```

```sql
CREATE TABLE kategorie
(
    id        INTEGER PRIMARY KEY,
    name      VARCHAR(80) NOT NULL,
    eltern_id INTEGER,
    bildname  VARCHAR(200)
);
```

```sql
CREATE TABLE gericht_hat_allergen
(
    code       CHAR(4),
    gericht_id INTEGER NOT NULL
);
```

```sql
CREATE TABLE gericht_hat_kategorie
(
    gericht_id   INTEGER NOT NULL,
    kategorie_id INTEGER NOT NULL
);
```

#### 4)
```sql
SELECT * FROM gericht;
```

```sql
SELECT * FROM allergen;
```

```sql
SELECT * FROM kategorie;
```

```sql
SELECT * FROM gericht_hat_kategorie;
```

#### Backup/Git
```sql
mysqldump -u root -p emensawerbeseite > emensawerbeseite.sql
```

```sql
mysqldump -u root -p emensawerbeseite < emensawerbeseite.sql
```

### Aufgabe 3
|         | Geschätzte Zeit | Benötigte Zeit |
| ------- | --------------- | -------------- |
| Henning | 30 min           | 40 min          |
| Simon   | x min          | x min         |

#### 1)
```sql
SELECT * FROM gericht;
```

| id  | name                                  | beschreibung                                         | erfasst\_am | vegetarisch | vegan | preisintern | preisextern |
|:--- |:------------------------------------- |:---------------------------------------------------- |:----------- |:----------- |:----- |:----------- |:----------- |
| 1   | Bratkartoffeln mit Speck und Zwiebeln | Kartoffeln mit Zwiebeln und gut Speck                | 2020-08-25  | 0           | 0     | 2.3         | 4           |
| 3   | Bratkartoffeln mit Zwiebeln           | Kartoffeln mit Zwiebeln und ohne Speck               | 2020-08-25  | 1           | 1     | 2.3         | 4           |
| 4   | Grilltofu                             | Fein gewürzt und mariniert                           | 2020-08-25  | 1           | 1     | 2.5         | 4.5         |
| 5   | Lasagne                               | Klassisch mit Bolognesesoße und Creme Fraiche        | 2020-08-24  | 0           | 0     | 2.5         | 4.5         |
| 6   | Lasagne vegetarisch                   | Klassisch mit Sojagranulatsoße und Creme Fraiche     | 2020-08-24  | 1           | 0     | 2.5         | 4.5         |
| 7   | Hackbraten                            | Nicht nur für Hacker                                 | 2020-08-25  | 0           | 0     | 2.5         | 4           |
| 8   | Gemüsepfanne                          | Gesundes aus der Region, deftig angebraten           | 2020-08-25  | 1           | 1     | 2.3         | 4           |
| 9   | Hühnersuppe                           | Suppenhuhn trifft Petersilie                         | 2020-08-25  | 0           | 0     | 2           | 3.5         |
| 10  | Forellenfilet                         | mit Kartoffeln und Dilldip                           | 2020-08-22  | 0           | 0     | 3.8         | 5           |
| 11  | Kartoffel-Lauch-Suppe                 | der klassische Bauchwärmer mit frischen Kräutern     | 2020-08-22  | 1           | 0     | 2           | 3           |
| 12  | Kassler mit Rosmarinkartoffeln        | dazu Salat und Senf                                  | 2020-08-23  | 0           | 0     | 3.8         | 5.2         |
| 13  | Drei Reibekuchen mit Apfelmus         | grob geriebene Kartoffeln aus der Region             | 2020-08-23  | 1           | 0     | 2.5         | 4.5         |
| 14  | Pilzpfanne                            | die legendäre Pfanne aus Pilzen der Saison           | 2020-08-23  | 1           | 0     | 3           | 5           |
| 15  | Pilzpfanne vegan                      | die legendäre Pfanne aus Pilzen der Saison ohne Käse | 2020-08-24  | 1           | 1     | 3           | 5           |
| 16  | Käsebrötchen                          | schmeckt vor und nach dem Essen                      | 2020-08-24  | 1           | 0     | 1           | 1.5         |
| 17  | Schinkenbrötchen                      | schmeckt auch ohne Hunger                            | 2020-08-25  | 0           | 0     | 1.25        | 1.75        |
| 18  | Tomatenbrötchen                       | mit Schnittlauch und Zwiebeln                        | 2020-08-25  | 1           | 1     | 1           | 1.5         |
| 19  | Mousse au Chocolat                    | sahnige schweizer Schokolade rundet jedes Essen ab   | 2020-08-26  | 1           | 0     | 1.25        | 1.75        |
| 20  | Suppenkreation á la Chef              | was verschafft werden muss, gut und günstig          | 2020-08-26  | 0           | 0     | 0.5         | 0.9         |

#### 2)
```sql
SELECT erfasst_am FROM gericht;
```

| erfasst\_am |
|:----------- |
| 2020-08-25  |
| 2020-08-25  |
| 2020-08-25  |
| 2020-08-24  |
| 2020-08-24  |
| 2020-08-25  |
| 2020-08-25  |
| 2020-08-25  |
| 2020-08-22  |
| 2020-08-22  |
| 2020-08-23  |
| 2020-08-23  |
| 2020-08-23  |
| 2020-08-24  |
| 2020-08-24  |
| 2020-08-25  |
| 2020-08-25  |
| 2020-08-26  |
| 2020-08-26  |

#### 4)
```sql
SELECT name AS Gerichtname, erfasst_am FROM gericht GROUP BY Gerichtname ASC;
```

| Gerichtname | erfasst\_am |
| :--- | :--- |
| Bratkartoffeln mit Speck und Zwiebeln | 2020-08-25 |
| Bratkartoffeln mit Zwiebeln | 2020-08-25 |
| Drei Reibekuchen mit Apfelmus | 2020-08-23 |
| Forellenfilet | 2020-08-22 |
| Gemüsepfanne | 2020-08-25 |
| Grilltofu | 2020-08-25 |
| Hackbraten | 2020-08-25 |
| Hühnersuppe | 2020-08-25 |
| Kartoffel-Lauch-Suppe | 2020-08-22 |
| Käsebrötchen | 2020-08-24 |
| Kassler mit Rosmarinkartoffeln | 2020-08-23 |
| Lasagne | 2020-08-24 |
| Lasagne vegetarisch | 2020-08-24 |
| Mousse au Chocolat | 2020-08-26 |
| Pilzpfanne | 2020-08-23 |
| Pilzpfanne vegan | 2020-08-24 |
| Schinkenbrötchen | 2020-08-25 |
| Suppenkreation á la Chef | 2020-08-26 |
| Tomatenbrötchen | 2020-08-25 |

#### 5)
```sql
SELECT name AS Gerichtname, erfasst_am FROM gericht GROUP BY Gerichtname ASC LIMIT 10 OFFSET 5;
```

| Gerichtname | erfasst\_am |
| :--- | :--- |
| Grilltofu | 2020-08-25 |
| Hackbraten | 2020-08-25 |
| Hühnersuppe | 2020-08-25 |
| Kartoffel-Lauch-Suppe | 2020-08-22 |
| Käsebrötchen | 2020-08-24 |
| Kassler mit Rosmarinkartoffeln | 2020-08-23 |
| Lasagne | 2020-08-24 |
| Lasagne vegetarisch | 2020-08-24 |
| Mousse au Chocolat | 2020-08-26 |
| Pilzpfanne | 2020-08-23 |

#### 6)
```sql
SELECT distinct(typ) FROM allergen;
```

| typ |
| :--- |
| Getreide \(Gluten\) |
| Allergen |

#### 7)
```sql
SELECT * FROM gericht WHERE name LIKE 'k%';
```

| id | name | beschreibung | erfasst\_am | vegetarisch | vegan | preisintern | preisextern |
| :--- | :--- | :--- | :--- | :--- | :--- | :--- | :--- |
| 11 | Kartoffel-Lauch-Suppe | der klassische Bauchwärmer mit frischen Kräutern | 2020-08-22 | 1 | 0 | 2 | 3 |
| 12 | Kassler mit Rosmarinkartoffeln | dazu Salat und Senf | 2020-08-23 | 0 | 0 | 3.8 | 5.2 |
| 16 | Käsebrötchen | schmeckt vor und nach dem Essen | 2020-08-24 | 1 | 0 | 1 | 1.5 |

#### 8)
```sql
SELECT id, name FROM gericht WHERE name LIKE '%suppe%';
```

| id | name |
| :--- | :--- |
| 9 | Hühnersuppe |
| 11 | Kartoffel-Lauch-Suppe |
| 20 | Suppenkreation á la Chef |

#### 9)
```sql
SELECT * FROM kategorie WHERE eltern_id IS NOT NULL;
```

| id | name | eltern\_id | bildname |
| :--- | :--- | :--- | :--- |
| 3 | Hauptspeisen | 2 | kat\_menu\_haupt.bmp |
| 4 | Vorspeisen | 2 | kat\_menu\_vor.svg |
| 5 | Desserts | 2 | kat\_menu\_dessert.pic |
| 6 | Mensastars | 1 | kat\_stars.tif |
| 7 | Erstiewoche | 1 | kat\_erties.jpg |

#### 10)
```sql
UPDATE allergen SET name = 'Kamut' WHERE code = 'a6';
```

#### 11)
```sql
INSERT INTO gericht (id, name, beschreibung, erfasst_am,vegetarisch, vegan, preisintern, preisextern)
VALUE (21, 'Currywurst mit Pommes', 'Würzige Wurst in süßer Sauce mit knusprigen Kartoffeln', '2023-11-16', false, false, 2.3, 4);
```

```sql
INSERT INTO gericht_hat_kategorie (gericht_id, kategorie_id) VALUE (21,3);
```

### Aufgabe 4)
|         | Geschätzte Zeit | Benötigte Zeit |
| ------- | --------------- | -------------- |
| Henning | 30 min           | 30 min          |
| Simon   | x min          | x min         |

### Aufgabe 5)
|         | Geschätzte Zeit | Benötigte Zeit |
| ------- | --------------- | -------------- |
| Henning | x min           | x min          |
| Simon   | x min          | x min         |

### Aufgabe 6)
|         | Geschätzte Zeit | Benötigte Zeit |
| ------- | --------------- | -------------- |
| Henning | 30 min           | 20 min          |
| Simon   | x min          | x min         |

#### 1)
```sql
SELECT gericht.name, gha.code FROM gericht
JOIN emensawerbeseite.gericht_hat_allergen gha on gericht.id = gha.gericht_id;
```

| name | code |
| :--- | :--- |
| Bratkartoffeln mit Speck und Zwiebeln | h |
| Bratkartoffeln mit Speck und Zwiebeln | a3 |
| Bratkartoffeln mit Speck und Zwiebeln | a4 |
| Bratkartoffeln mit Zwiebeln | f1 |
| Bratkartoffeln mit Zwiebeln | a6 |
| Bratkartoffeln mit Zwiebeln | i |
| Grilltofu | a3 |
| Grilltofu | f1 |
| Grilltofu | a4 |
| Grilltofu | h3 |
| Lasagne vegetarisch | d |
| Hackbraten | h1 |
| Hackbraten | a2 |
| Hackbraten | h3 |
| Hackbraten | c |
| Gemüsepfanne | a3 |
| Forellenfilet | h3 |
| Forellenfilet | d |
| Forellenfilet | f |
| Kassler mit Rosmarinkartoffeln | f2 |
| Kassler mit Rosmarinkartoffeln | h1 |
| Kassler mit Rosmarinkartoffeln | a5 |
| Bratkartoffeln mit Speck und Zwiebeln | c |
| Hühnersuppe | a2 |
| Pilzpfanne | i |
| Bratkartoffeln mit Speck und Zwiebeln | f1 |
| Pilzpfanne vegan | a1 |
| Pilzpfanne vegan | a4 |
| Pilzpfanne vegan | i |
| Pilzpfanne vegan | f3 |
| Pilzpfanne vegan | h3 |


#### 2)
```sql
SELECT gericht.name, gha.code FROM gericht
LEFT JOIN emensawerbeseite.gericht_hat_allergen gha on gericht.id = gha.gericht_id;
```

| name | code |
| :--- | :--- |
| Bratkartoffeln mit Speck und Zwiebeln | h |
| Bratkartoffeln mit Speck und Zwiebeln | a3 |
| Bratkartoffeln mit Speck und Zwiebeln | a4 |
| Bratkartoffeln mit Zwiebeln | f1 |
| Bratkartoffeln mit Zwiebeln | a6 |
| Bratkartoffeln mit Zwiebeln | i |
| Grilltofu | a3 |
| Grilltofu | f1 |
| Grilltofu | a4 |
| Grilltofu | h3 |
| Lasagne vegetarisch | d |
| Hackbraten | h1 |
| Hackbraten | a2 |
| Hackbraten | h3 |
| Hackbraten | c |
| Gemüsepfanne | a3 |
| Forellenfilet | h3 |
| Forellenfilet | d |
| Forellenfilet | f |
| Kassler mit Rosmarinkartoffeln | f2 |
| Kassler mit Rosmarinkartoffeln | h1 |
| Kassler mit Rosmarinkartoffeln | a5 |
| Bratkartoffeln mit Speck und Zwiebeln | c |
| Hühnersuppe | a2 |
| Pilzpfanne | i |
| Bratkartoffeln mit Speck und Zwiebeln | f1 |
| Pilzpfanne vegan | a1 |
| Pilzpfanne vegan | a4 |
| Pilzpfanne vegan | i |
| Pilzpfanne vegan | f3 |
| Pilzpfanne vegan | h3 |
| Lasagne | null |
| Kartoffel-Lauch-Suppe | null |
| Drei Reibekuchen mit Apfelmus | null |
| Käsebrötchen | null |
| Schinkenbrötchen | null |
| Tomatenbrötchen | null |
| Mousse au Chocolat | null |
| Suppenkreation á la Chef | null |
| Currywurst mit Pommes | null |

#### 3)
```sql
SELECT gericht.name, gha.code FROM gericht
RIGHT JOIN emensawerbeseite.gericht_hat_allergen gha on gericht.id = gha.gericht_id;
```

| name | code |
| :--- | :--- |
| Bratkartoffeln mit Speck und Zwiebeln | h |
| Bratkartoffeln mit Speck und Zwiebeln | a3 |
| Bratkartoffeln mit Speck und Zwiebeln | a4 |
| Bratkartoffeln mit Zwiebeln | f1 |
| Bratkartoffeln mit Zwiebeln | a6 |
| Bratkartoffeln mit Zwiebeln | i |
| Grilltofu | a3 |
| Grilltofu | f1 |
| Grilltofu | a4 |
| Grilltofu | h3 |
| Lasagne vegetarisch | d |
| Hackbraten | h1 |
| Hackbraten | a2 |
| Hackbraten | h3 |
| Hackbraten | c |
| Gemüsepfanne | a3 |
| Forellenfilet | h3 |
| Forellenfilet | d |
| Forellenfilet | f |
| Kassler mit Rosmarinkartoffeln | f2 |
| Kassler mit Rosmarinkartoffeln | h1 |
| Kassler mit Rosmarinkartoffeln | a5 |
| Bratkartoffeln mit Speck und Zwiebeln | c |
| Hühnersuppe | a2 |
| Pilzpfanne | i |
| Bratkartoffeln mit Speck und Zwiebeln | f1 |
| Pilzpfanne vegan | a1 |
| Pilzpfanne vegan | a4 |
| Pilzpfanne vegan | i |
| Pilzpfanne vegan | f3 |
| Pilzpfanne vegan | h3 |

#### 4)
```sql
SELECT kategorie.name, count(gericht_id) AS anzahl_gerichte FROM kategorie
LEFT JOIN emensawerbeseite.gericht_hat_kategorie ghk on kategorie.id = ghk.kategorie_id
GROUP BY kategorie.name ASC;
```

| name | anzahl_gerichte |
| :--- | :--- |
| Aktionen | 0 |
| Desserts | 3 |
| Erstiewoche | 0 |
| Hauptspeisen | 8 |
| Mensastars | 0 |
| Menus | 0 |
| Vorspeisen | 3 |

#### 5)
```sql
SELECT kategorie.name, count(gericht_id) AS anzahl_gerichte FROM kategorie
LEFT JOIN emensawerbeseite.gericht_hat_kategorie ghk on kategorie.id = ghk.kategorie_id
GROUP BY kategorie.name ASC
HAVING anzahl_gerichte > 2;
```

| name | anzahl\_gerichte |
| :--- | :--- |
| Desserts | 3 |
| Hauptspeisen | 8 |
| Vorspeisen | 3 |

#### 6)
```sql
SELECT gericht.name FROM gericht
JOIN emensawerbeseite.gericht_hat_allergen gha on gericht.id = gha.gericht_id
GROUP BY gericht.name ASC
HAVING count(gha.gericht_id) > 3;
```
