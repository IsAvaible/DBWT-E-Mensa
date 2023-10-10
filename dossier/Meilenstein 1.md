### Aufgabe 2

In jede `.html` Datei soll auf die Zeile `<!DOCTYPE html>` folgender Kommentar folgen:
````
<!--
- Praktikum DBWT. Autoren:
- Simon, Conrad, 3597903
- Henning, Schreiber, 3568055
-->
````

### Aufgabe 3

Jede Aufgabe soll eine Tabelle beinhalten in der die geschätzten so wie die benötigte Zeit
eingetragen werden soll.
Beispielsweise so: 

|         | Geschätzte Zeit | Benötigte Zeit |
| ------- | --------------- | -------------- |
| Henning | 5 min           | 7 min           |
| Simon   | 3 min           | 4 min           |


### Aufgabe 4

|         | Geschätzte Zeit | Benötigte Zeit |
|---------|-----------------|----------------|
| Henning | 30 min          | 0 min          |
| Simon   | 10 min          | 15 min         | 

a) Jedes Mal mit Google erster Treffer gelöst.
b) Mithilfe vom [Tabellen Generator](https://www.tablesgenerator.com/html_tables) erledigt
e) Länger gedauert wegen Styling.

### Aufgabe 5

|         | Geschätzte Zeit | Benötigte Zeit |
|---------|-----------------|----------------|
| Henning | x min           | x min          |
| Simon   | 25 min          | 23 min         | 

Mithilfe von [MDN Docs](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/form) gelöst.

### Aufgabe 6

#### 1)
##### Request Header:
```
GET /hochschule/bibliothek/ HTTP/1.1 Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7 Accept-Encoding: gzip, deflate, br Accept-Language: en-US,en;q=0.9,de;q=0.8 Cache-Control: no-cache Connection: keep-alive Cookie: fhac_cookiemodal-selection=[%22essential%22]; _pk_id.10.19d4=1b7992a522ea16cd.1682500819.; tier_badge_id=eyJfcmFpbHMiOnsibWVzc2FnZSI6IklqQmtZMk5sWXprM0xUZGpNRGt0TkRNeFpDMWhOV1E0TFRsa01EazBOR05sWVRobVppST0iLCJleHAiOm51bGwsInB1ciI6ImNvb2tpZS50aWVyX2JhZGdlX2lkIn19--18145dabe1da9140b6d43aa1eb06634cb1da3f62 DNT: 1 Host: www.fh-aachen.de Pragma: no-cache Sec-Fetch-Dest: document Sec-Fetch-Mode: navigate Sec-Fetch-Site: none Sec-Fetch-User: ?1 Upgrade-Insecure-Requests: 1 User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Edg/117.0.2045.60 sec-ch-ua: "Microsoft Edge";v="117", "Not;A=Brand";v="8", "Chromium";v="117" sec-ch-ua-mobile: ?0 sec-ch-ua-platform: "Windows"
```

##### Response Header:
```
HTTP/1.1 301 Moved Permanently Server: nginx/1.18.0 (Ubuntu) Date: Tue, 10 Oct 2023 10:39:16 GMT Content-Type: text/html; charset=UTF-8 Transfer-Encoding: chunked Connection: keep-alive X-Redirect-By: TYPO3 Redirect 8080 location: https://www.fh-aachen.de/fh-aachen/hochschulstruktur/zentrale-betriebseinheiten/bibliothek Strict-Transport-Security: max-age=31536000
```

##### Attribute
- Accept: Mit Accept gibt der Client an, welche Dateiformate er akzeptiert & präferiert. Diese teilen sich in Gruppen (text, application auf ...) und werden nach q-Faktor (0 bis 1) und Granularität sortiert.
- Accept-Language: Beschreibt die natürliche Sprache die der Nutzer präferiert.
- Cookie: Ein Cookie ist eine lokal gespeicherte Datei, welche Daten wie Nutzerpräferenzen beinhaltet. Der Cookie kann an den Server übertragen werden, um beispielsweise einen Sitzungszustand wiederherzustellen.
- User-Agent: Der User-Agent benennt die Applikationen, durch welche der Client die Abfrage initiiert hat (bspw. Webbrowser).
- Cache-Control: Bestimmt die Caching Policy (Nur Lokal / Auf Proxys, CDNs)

#### 2)
##### Request Header
```
POST /E-Mensa%20Projekt/beispiele/newsletteranmeldung.html?_ijt=btok8g13vhk44ii85jreamt35i&_ij_reload=RELOAD_ON_SAVE HTTP/1.1 Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7 Accept-Encoding: gzip, deflate, br Accept-Language: en-US,en;q=0.9,de;q=0.8 Cache-Control: no-cache Connection: keep-alive Content-Length: 11 Content-Type: application/x-www-form-urlencoded Cookie: Clion-6f2e7728=46384d79-e6be-474f-a905-6b81b2833044; Phpstorm-d2ed8b2d=6c123eee-1e7b-4a2e-b186-1b4289055724 DNT: 1 Host: localhost:63342 Origin: http://localhost:63342 Pragma: no-cache Referer: http://localhost:63342/E-Mensa%20Projekt/beispiele/newsletteranmeldung.html?_ijt=btok8g13vhk44ii85jreamt35i&_ij_reload=RELOAD_ON_SAVE Sec-Fetch-Dest: document Sec-Fetch-Mode: navigate Sec-Fetch-Site: same-origin Sec-Fetch-User: ?1 Upgrade-Insecure-Requests: 1 User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/117.0.0.0 Safari/537.36 Edg/117.0.2045.60 sec-ch-ua: "Microsoft Edge";v="117", "Not;A=Brand";v="8", "Chromium";v="117" sec-ch-ua-mobile: ?0 sec-ch-ua-platform: "Windows"
```

##### Response Header
```
HTTP/1.1 200 OK content-type: text/html server: PhpStorm 2023.2.2 date: Tue, 10 Oct 2023 10:53:28 GMT x-frame-options: SameOrigin X-Content-Type-Options: nosniff x-xss-protection: 1; mode=block accept-ranges: bytes cache-control: no-cache last-modified: Tue, 10 Oct 2023 10:32:22 GMT content-length: 3379 access-control-allow-origin: http://localhost:63342 vary: origin access-control-allow-credentials: true
```

- POST: Die Methode, mit der die Anfrage gesendet wird. [POST bedeutet, dass Daten an den Server gesendet werden, um eine Ressource zu erstellen oder zu aktualisieren](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers)[1](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers).
- [/E-Mensa%20Projekt/beispiele/newsletteranmeldung.html?_ijt=btok8g13vhk44ii85jreamt35i&_ij_reload=RELOAD_ON_SAVE: Der Pfad und die Abfragezeichenfolge der angeforderten Ressource](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers)[1](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers).
- [HTTP/1.1: Die Version des HTTP-Protokolls, das von der Anfrage verwendet wird](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers)[1](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers).
- [Accept: Die Medientypen, die vom Client akzeptiert werden, nach Präferenz geordnet](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers)[2](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Cache-Control).
- [Accept-Encoding: Die Inhaltskodierungen, die vom Client akzeptiert werden, nach Präferenz geordnet](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers)[2](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Cache-Control).
- [Accept-Language: Die natürlichen Sprachen, die vom Client akzeptiert werden, nach Präferenz geordnet](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers)[2](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Cache-Control).
- Cache-Control: Direktiven für Caching-Mechanismen in Anfragen und Antworten. [no-cache bedeutet, dass der Client eine frische Antwort vom Server anfordert und nicht eine zwischengespeicherte Version verwendet](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers)[3](https://www.wpoven.com/blog/http-security-headers/).
- Connection: Eine Liste von Hop-by-Hop-Headern, die nicht von Proxys weitergeleitet werden sollen. [keep-alive bedeutet, dass die Verbindung nach der Anfrage offen gehalten werden soll](https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers)[4](https://developer.mozilla.org/en-US/docs/MDN/Writing_guidelines/Howto/Document_an_HTTP_header).
- Content-Length: Die Länge des Anfragekörpers in Bytes.
- Content-Type: Der Medientyp des Anfragekörpers.
- Cookie: Ein Header, der vom Client gesendete Cookies enthält.
- DNT: Ein Header, der angibt, ob der Client dem Tracking durch den Server oder Dritte zustimmt oder nicht. 1 bedeutet, dass der Client dem Tracking nicht zustimmt.
- Host: Der Hostname und die Portnummer des Servers, an den die Anfrage gesendet wird.
- Origin: Der Ursprung der Anfrage, d.h. das Schema, den Host und den Port des Clients.
- Pragma: Ein implementierungsspezifischer Header, der verschiedene Effekte entlang der Anfrage-Antwort-Kette haben kann. Wird für die Abwärtskompatibilität mit HTTP/1.0-Caches verwendet, wo der Cache-Control-Header noch nicht vorhanden ist. no-cache hat dieselbe Bedeutung wie im Cache-Control-Header.
- Referer: Die Adresse der vorherigen Webseite, von der aus ein Link zu der angeforderten Ressource gefolgt wurde.
- Upgrade-Insecure-Requests: Ein Header, der angibt, dass der Client lieber eine verschlüsselte und authentifizierte Antwort erhalten möchte.
- User-Agent: Ein Header, der den Client identifiziert, d.h. den Browser oder das Gerät des Benutzers.

### Aufgabe 7

Henning

### Aufgabe 8

|         | Geschätzte Zeit | Benötigte Zeit |
|---------|-----------------|----------------|
| Henning | x min           | x min          |
| Simon   | 10 min          | 15 min         |

### Aufgabe 9

|         | Geschätzte Zeit | Benötigte Zeit |
|---------|-----------------|----------------|
| Henning | x min           | x min          |
| Simon   | 30 min          | 20 min         |


