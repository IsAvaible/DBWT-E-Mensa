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