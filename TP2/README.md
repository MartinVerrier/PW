# Compte rendu du TP 2
Par DA COSTA Tom, MOTTINO Loris et VERRIER Martin


## Instructions
Les fichiers PHP et HTML présents dans ce dépôt git correspondent aux exercices du TP.
Ils sont nommés en fonction du numéro de la question.
Lorsqu'un fichier HTML est présent pour une question donnée, c'est en principe un formulaire web redirigeant vers le service PHP de la même question.
Les questions 11 à 15 correspondent respectivement aux questions 1 à 5 de la partie **Antennes GSM**.


### Question 1
```
tail -n +2 borneswifi_EPSG4326_20171004_utf8.csv | wc -l
```


### Question 2
```
tail -n +2 borneswifi_EPSG4326_20171004_utf8.csv | cut -d, -f2 | uniq | wc -l
tail -n +2 borneswifi_EPSG4326_20171004_utf8.csv | cut -d, -f2 | uniq -c | sort -r | head -n 1
```


### Question 13
Le fichier KML est valide conformément au résultat de la commande `xmllint`.
En effet, le fichier ne présente aucune erreur de balisage.


### Question 14
Ce fichier KML est plutôt lourd et contient beaucoup d'informations redondantes, ce qui peut être compliqué s'il faut le lire au format brut.
Cependant, en l'ouvrant avec Google Maps, ce fichier représente très bien son contenu, à savoir les antennes réseau ici.
