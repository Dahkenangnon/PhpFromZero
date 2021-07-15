# PhpFromZero

Créer un site de A à Z avec Php sans utiliser aucun framework en orienté objet

Notre site web affiche les 10 derniers message posté par des copains.

Voici un petit cahier de charge de notre site:

## Contexte

Deux amis du collège les "Hibiscus" de Parakou, tout nouveau étudiants développeur web
chez ePatriote se lancement un challenge.
Ils veulent savoir celui qui finira le plus tôt possible un site où ils pourront posté des message
de blague entre copain.

Le site doit être fait en PHP sans utiliser aucun framework et en orienté objet.
POur distinguer le meilleur développeur parmi les challengers, il sera tenu compte non seulement de la rapidité du codage mais aussi de l'organisation et du temps d'éxécution d'une même requête.

## Cible

Le site sera utilisé par des copains de classe à Hibiscus et il y aura un administraeur pour surveillé le système.

## Acteurs et cas d'utilisation

Voici les entités et acteurs du système:

- le visiteur: il peut consulter les page qui n'ont pas besoin de se connecter pour visualiser comme l'accueil, le login, la page  apropos
- le copain: represente un gar de la bande
- l'admin: c'est le big box en dev web. C'est pour ça que c'est lui qui doit surveiller le système.

- les messages: un message est caractérisé par un title, un contenu, l'heure auxquel il est posté et l'auteur

Voici les cas d'utilisation de chacun personnes:

- Visiteur:
  - consulter l'accueil du site 
  - consulter la page à propos
  - consulter la page de connexion
  - consulter la page d'inscription
  - consutler la page des details d'un message
  - s'inscrire
- Copain:
  - Se connecter
  - Poster un message
  - Voir son profil et le mettre à jour
  - Se déconnecter
  - voir les message qui lui même a posté
- Admin:
  - Consulter la liste des utilisateurs
  - Supprimer un utilisateur

## Contraintes imposée par le client

Le challange comporte les contraintes suivantes:

- le site doit être prêt en une semaine au  plus tard
- le site doit donner la possiblité de limiter les accès des utilisateur selon leur rôle: COPAIN ou ADMIN; l'admin seul ayant accès à la liste des utilisateurs

# 