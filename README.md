Symfony2  beginning  project
==========

Mission:
------------


    L'objectif est de simuler un petit carnet d'adresses en ligne sous symfony2.
    
    * Identification (Inscription/Connexion/Déconnexion) de l'utilisateur par login/mot de passe (FOSUserbundle).
    * Ajouter/Afficher/Lister/Supprimer des contacts de son carnet d'adresses (membres qui pourront aussi devenir utilisateurs). 
    * Afficher/Modifier leurs informations (e-mail / adresse / téléphone / site web).

 
Achieve function:
---------------

* the default page will send you to login, if you don't have account, you can click link to go to register page
* you can use the navbar in the top to switch to the information list and address book
* in the information list page is the view of all the user, and you can choose one to edit
* in the address book page you can only see the address of the user who is logined now. 
    * you can edit and also delete the address the address in this page
    * if you click detail botton, you can view more information of the user rather than just one address. 


Installation   
-------------
Clone the project :

    git clone git@github.com:limin-liu/symfony2-test.git  symfony2-test
        
Update packages :
    
    cd symfony2-test
    php composer.phar install
    
Update schemas (FOSUserBundle) :
    
    php app/console doctrine:schema:create

Create and activate user :
    
    php app/console fos:user:create
    php app/console fos:user:activate
    


    


</br></br>


A Symfony project created on May 7, 2016, 11:08 pm.
