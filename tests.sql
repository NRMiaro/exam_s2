-- liste d'objets avec date de retour si emprunt en cours

SELECT 
	o.nom_objet as objet,
    e.date_retour as date_retour
FROM emprunts_objet as o
LEFT JOIN emprunts_emprunt as e
    ON e.id_objet = o.id_objet