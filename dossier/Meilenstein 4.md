### Aufgabe 1
|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      120 min      |     210 min      |
| Simon   |     x min      |     x min     |

#### 1)
![[m4_aufgabe1.drawio.png]]

**wunschgericht**(name, beschreibung, ersteldatum , <u>nummer</u>, {Femdschlüssel} ersteller:in)
**ersteller:in**(name, <u>email</u>)
#### 2)
```sql
create TABLE ersteller_in
(
    name  char(80)    DEFAULT 'anonym',
    email char(80)    PRIMARY KEY
);

create TABLE wunschgericht
(
    name            char(80)        NOT NULL,
    beschreibung    VARCHAR(800)    NOT NULL,
    erfasst_am      DATE            NOT NULL default now(),
    nummer          INTEGER         AUTO_INCREMENT,
    ersteller_in    char(80),
    PRIMARY KEY (nummer) ,
    FOREIGN KEY (ersteller_in)      REFERENCES ersteller_in(email)
);
```

#### 6)
a)
```sql
SELECT * FROM wunschgericht ORDER BY erfasst_am LIMIT 5;
```

b)
```sql
SELECT ersteller_in, count(*) From wunschgericht 
GROUP BY ersteller_in;
```

### Aufgabe 2

|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      60 min      |     20 min      |
| Simon   |     x min      |     x min     |

#### 1)
* XSS
	* htmlspecialchars() in newsletterbackend.php und wunschgreichtbackend.php bei wiedergabe der Eingaben eingebunden.
	* Einbindung von htmlspecialchars() in der index.php

* SQL-Injection
	* mysqli_real_escape_string() in wunschgreichtbackend.php eingebunden.

#### 2)
* CSRF
	* Dieser fall ist auf unsere Seite nicht wirklich vorhanden


### Aufgabe 4

|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      x min      |     x min      |
| Simon   |     20 min      |     20 min     |

#### 1)

In Tabelle gericht_hat_kategorie soll eine Kombination aus Gericht und
Kategorie einzigartig sein.

```sql
ALTER TABLE gericht_hat_kategorie
    ADD CONSTRAINT gericht_kategorie_unique UNIQUE (gericht_id, kategorie_id);
```

#### 2)

In der Tabelle gericht soll eine Abfrage nach Name beschleunigt werden.

```sql
CREATE INDEX gericht_name_idx ON gericht (name);
```

#### 3)

Bei Löschung eines Gerichts sollen 1) die zugehörigen Zuordnungen zu einer
Kategorie sowie 2) die zugehörigen Zuordnungen zu Allergenen automatisch
mit gelöscht werden.

```sql
ALTER TABLE gericht_hat_kategorie
    ADD CONSTRAINT fk_gericht_kategorie_cascade
        FOREIGN KEY (gericht_id) REFERENCES gericht (id)
            ON DELETE CASCADE;

ALTER TABLE gericht_hat_allergen
    ADD CONSTRAINT fk_gericht_allergen_cascade
        FOREIGN KEY (gericht_id) REFERENCES gericht (id)
            ON DELETE CASCADE;
```

#### 4)

Eine Kategorie kann nur dann gelöscht werden, wenn 1) dieser keine
Gerichte zugeordnet sind und 2) diese keine Kindkategorien besitzt.

```sql
ALTER TABLE gericht_hat_kategorie
    ADD CONSTRAINT fk_kategorie_gericht_restrict
        FOREIGN KEY (kategorie_id) REFERENCES kategorie (id)
            ON DELETE RESTRICT;

ALTER TABLE kategorie
    ADD CONSTRAINT fk_kategorie_eltern_restrict
        FOREIGN KEY (eltern_id) REFERENCES kategorie (id)
            ON DELETE RESTRICT;
```

#### 5)

Wird der Code eines Allergens verändert, so ändert sich dieser Code
automatisch in den referenzierenden Datensätzen.

```sql
ALTER TABLE gericht_hat_allergen
    ADD CONSTRAINT fk_gericht_allergen_update_cascade
        FOREIGN KEY (code) REFERENCES allergen (code)
            ON UPDATE CASCADE;
```

#### 6)

Eine Kombination aus gericht_id und kategorie_id in gericht_hat_kategorie
soll als Primärschlüssel dienen.

```sql
ALTER TABLE gericht_hat_kategorie
    ADD CONSTRAINT gericht_hat_kategorie_pkey PRIMARY KEY (gericht_id, kategorie_id);
```

### Aufgabe 5

|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |     30 min      |     20 min     |
| Simon   |      x min      |     x min      |

### Aufgabe 6

|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      x min      |     x min      |
| Simon   |     20 min      |     12 min     | 

### Aufgabe 7

|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      x min      |     x min      |
| Simon   |     70 min      |     50 min     | 
