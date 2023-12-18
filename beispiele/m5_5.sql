# a)
DROP PROCEDURE IF EXISTS track_anmeldung;

CREATE PROCEDURE track_anmeldung(IN nutzer_id INT)
BEGIN
    UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen + 1, letzteanmeldung = NOW() WHERE id = nutzer_id;
END;

