# Practica 05

## Informacio
Enllaç al repositori public : https://github.com/mperalsapa/servidor-pt04

Enllaç a la versio online : https://sp4.mperalsapa.cf

Dintre d'aquest repositori tamb e es troba la documentacio, realitzada amb phpdocumentor. Si s'accedeix a la web, tambe es pot accedir a la documentacio. Per exemple: https://sp4.mperalsapa.cf/phpdoc

L'esquema i dades de la base de dades es [aqui](pt04_marc_peral.sql)


## Posar en martxa aquest servei
### Configurar les variables d'entorn
Primer de tot s'ha de configurar al fitxer env.php el domini amb el que s'accedeix i la ruta que es el fitxer index.php.
Per exemple si el meu domini es marc-pt.local en el fixer env posare en domini ```$baseDomain = "http://marc-pt.local"; ``` I si la ruta del fitxer es "servidor/web/uf2/pt04" al fitxer env haig de posar 
```php $baseUrl = "/servidor/UF2/pt04/";``` . Molt important que tingui barra al principi i al final. En cas de trobar-se en l'arrel nomes posarem una barra ```$baseUrl = "/";```

Una vegada configurades les variables de la url, afegirem les credencials de la base de dades per a un funcionament basic.
Aquestes credencials s'han de configurar en aquestes variables

```php
$mysqlUser = "usuari";
$mysqlPassword = "contrasenya";
$mysqlHost = "mysql.local";
$mysqlDB = "p04";
```

### Crear base de dades
Executarem el fitxer [sql](pt04_marc_peral.sql) en mysql per crear la base de dades amb les taules necessaries.
>** NOTA ** Si es troba que no hi han articles a la pagina, es probable que doni lloc a un loop infinit. Per aquesta raó s'incloeixen uns articles inicials.
---
# Parts del projecte
## Part Basica
- Paginacio dinamica
    - La paginacio s'ajusta al numero de pagines que hi ha, basades en el numero d'articles
- Autenticacio d'usuari
- Registre d'usuari
- Creacio, edicio i eliminacio de articles
- Captcha en intents de inici de sessio fallats
    - es fa servir hCaptcha

## Social Auth
En l'apartat de social auth, es fan servir variables d'entorn definides al fitcher [env.php](env.example.php). S'ha de configurar el domini, i la base del lloc en les variables ```$baseDomain``` i en ```$baseUrl```
### Oauth2
- (TODO) Discord (Oauth2)

### HybridAuth
- Google Auth (Oauth2)
- Github Auth (Oauth2)
- Twitter Auth (Oauth)

## Recuperacio de contrasenya
- La recuperacio de la contrasenya, de la mateixa manera que el login social, fa servir les variables d'entorn de ```$baseDomain``` i en ```$baseUrl``` definides al fitxer ```env.php```
- Sol·licitut de restablir contrasenya amb correu electronic existent. S'enviara un enllaç que permetra canviar la contrasenya.
    - aquest enllaç conte un token el qual caducara passats 15 minuts
    - el sistema de recuperacio de contrasenya limita els intents de recuperacio de contrasenya a 1 intent cada 5 minuts (configurable en una [variable](https://github.com/mperalsapa/servidor-pt04/blob/168546c0a881186fba8fc28e24d697636f9caf79/src/controllers/lost-password.php#L66))
- En comptes d'utilitzar SMTP, es fa servir l'API de [Sendinblue](https://es.sendinblue.com/) per l'enviament de correus.

## Millores
- Mostrar autor i data del article
- Si l'usuari ha iniciat sessio, permet escollir els articles a mostrar entre els propis articles o tots els del lloc web
- Ordre dels articles de mes nou a mes antic
- Perfil d'usuari, on es permet canviar dades personals, tancar sessio i esborrar el compte
    - Canvi de correu des del perfil, protegit per un token que s'envia al correu actual
    - Canvi de contrasenya des del perfil
    - L'eliminacio de compte, tambe requereix un enllaç al correu ja que aquesta accio es permanent e irreversible (no vingui la yaya a dir-nos que ha perdut els articles 😉)
- Enrutador de peticions des d'un mateix fitxer, permetent denegar els subdirectoris i nomes accedir a un unic php.