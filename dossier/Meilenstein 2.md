### Aufgabe 1

|         | Geschätzte Zeit | Benötigte Zeit |
| ------- | --------------- | -------------- |
| Henning | 5 min           | 4 min          |
| Simon   | X min           | X min          |

### Aufgabe 2

|         | Geschätzte Zeit | Benötigte Zeit |
| ------- | --------------- | -------------- |
| Henning | 20 min           | 30 min          |
| Simon   | X min           | X min          |

### Aufgabe 3
|         | Geschätzte Zeit | Benötigte Zeit |
| ------- | --------------- | -------------- |
| Henning | 120 min          | 30 min         |
| Simon   | X min           | X min          |

#### 1)
Zeile 12: Fehlende `` , `` am ende der Zeile.
Zeile 21: Fehlende  ``]`` .
Zeile 41: Fehlende ``)`` bei der if Bedingung.
Zeile 59:  Fehlende ```function``` am Anfang der Zeile.

#### 2)
Die Meal.php gibt eine Rezept mit Bewertungen. Die aus Text und einer Note bestehenden Bewertungen können durch Eingabe in einem Textfeld nach Inhalte Ihres Textes gefiltert werden.

#### 3)
```float``` : Gleitkommazahlen
```foreach``` : Schleife die jedes Elemente eines Arrays durchgeht.
```count()``` : Zählt alle Elemente in einem Array

#### 4)
a)
````php
<td class='rating_author'>{$rating['author']}</td>
````
b)
````php
<p>
	<?php echo "Allergen: ";  
    foreach ($meal['allergens'] as $allergen) {  
		echo $allergen . " ";  
    } ?>
</p>
````
c) Ersetze ```stripos()``` mit ```stripos()```.
d) Teilen durch die Anzahl der Elemente darf erst nach der Addition erfolgen. 
e) 