# TpPhpObjet

1 Récupérer le projet SHH/HTTPS

2 Changer le .envtest en .env

3 lancer docker -docker compose up

4 docker exec -it "ID container" composer init
  docker exec -it "ID container" composer dump-autoload

5 docker exec -it "ID container" require miladrahimi/phprouter

6 docker exec -it "ID container" require vlucas/phpdotenv

7 Connection a la BDD
  Restauration ./backup.sh
