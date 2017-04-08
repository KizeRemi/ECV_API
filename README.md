# API

**API créée par Mavillaz Rémi, Paul Girardin et Ludovic Lacouture**

Github KizeRemi: https://github.com/KizeRemi  
GitHub PaulGirardin: https://github.com/PaulGirardin

Projet API développé en Master Développement Web Developer à l'ECV Digitale - Paris.


##  API Externes
- Bing
- Deezer
- Dailymotion

## Installation
Ouvrez le terminal/ligne de commande, et à la racine du projet:


```
git pull https://github.com/KizeRemi/ECV_API.git

composer install

```

Puis allez sur
```
localhost\web\index.php

```

## Attention, dans web/index.php. Bien vérifier que la config base_uri de Guzzle corresponde bien à la racine de votre projet !

```
$client = new Client([
    'base_uri' => 'http://localhost:8888',
    'timeout'  => 2.0,
]);
```