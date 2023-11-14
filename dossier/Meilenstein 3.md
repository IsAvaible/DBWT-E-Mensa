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
