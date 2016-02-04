SELECT COUNT(*) AS 'nb_abo', ROUND(AVG(prix), -1) AS 'moy_abo', SUM(duree_abo) % 42 as 'ft' FROM abonnement;
