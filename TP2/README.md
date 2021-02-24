# Compte rendu du TP 2
Par DA COSTA Tom, MOTTINO Loris et VERRIER Martin


## Instructions
Les fichiers PHP et HTML présents dans ce dépôt git correspondent aux exercices du TP.
Ils sont nommés en fonction du numéro de la question.
Lorsqu'un fichier HTML est présent pour une question donnée, c'est en principe un formulaire web redirigeant vers le service PHP de la même question.



### Question 1
```
tail -n +2 borneswifi_EPSG4326_20171004_utf8.csv | wc -l
```


### Question 2
```
tail -n +2 borneswifi_EPSG4326_20171004_utf8.csv | cut -d, -f2 | uniq | wc -l
tail -n +2 borneswifi_EPSG4326_20171004_utf8.csv | cut -d, -f2 | uniq -c | sort -r | head -n 1
```


### Question 3

