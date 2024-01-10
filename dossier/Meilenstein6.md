### Aufgabe 1

|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      x min      |     x min      |
| Simon   |     25 min      |     40 min     | 

#### a)

![ER-Diagramm](./m6_aufgabe1.drawio.png)

#### b)

```sql
CREATE TABLE bewertung
(
    bemerkung     VARCHAR(500)                                          NOT NULL,
    sterne        ENUM ('sehr gut', 'gut', 'schlecht', 'sehr schlecht') NOT NULL,
    zeitpunkt     DATE DEFAULT NOW()                                    NOT NULL,
    hervorgehoben BOOL DEFAULT FALSE                                    NULL,
    benutzer_id   BIGINT                                                NOT NULL
        REFERENCES benutzer (id),
    gericht_id    INT                                                   NOT NULL
        REFERENCES gericht (id)
)
    COMMENT 'Enthält Bewertungen von Nutzern für Gerichte';
```

#### c)

### Aufgabe 2

|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      x min      |     x min      |
| Simon   |      x min      |     x min      | 

### Aufgabe 3

|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      x min      |     x min      |
| Simon   |      x min      |     x min      |

