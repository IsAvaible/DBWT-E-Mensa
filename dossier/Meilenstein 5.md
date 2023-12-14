### Aufgabe 1
|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      60 min      |     10 min      |
| Simon   |     x min      |     x min     |

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
### Aufgabe 2
|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      x min      |     x min      |
| Simon   |     x min      |     x min     |

### Aufgabe 3
|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      x min      |     x min      |
| Simon   |     x min      |     x min     |

### Aufgabe 4
|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      x min      |     x min      |
| Simon   |     x min      |     x min     |

### Aufgabe 5
|         | Geschätzte Zeit | Benötigte Zeit |
|:--------|:---------------:|:--------------:|
| Henning |      x min      |     x min      |
| Simon   |     x min      |     x min     |

### Gesamt Aufwand

|         |   Benötigte Zeit   |
|:-------:|:------------------:|
| Henning |      415 min       |
|  Simon  |      242 min       |
|         |                    |
| Gesamt  | 657 min = 10.95std |
