<?php
use App\Enums\PermissionsClass;

return [

    // Mailing lists permissions
    PermissionsClass::mailingListCreate()->value => 'Permet de créer une liste de diffusion',
    PermissionsClass::mailingListRead()->value => 'Permet de consulter l\'ensemble des listes de diffusion',
    PermissionsClass::mailingListEdit()->value => 'Permet de modifier une liste de diffusion',
    PermissionsClass::mailingListDelete()->value => 'Permet de supprimer une liste de diffusion',

    // SMS permissions
    PermissionsClass::smsSend()->value => 'Permet d\'envoyer un SMS',
    PermissionsClass::smsRead()->value => 'Permet de consulter la liste des SMS envoyés',

    // User Management permissions
    PermissionsClass::userCreate()->value => 'Permet de créer un compte utilisateur',
    PermissionsClass::userRead()->value => 'Permet de consulter la liste des utilisateurs',
    PermissionsClass::userEdit()->value => 'Permet d\'éditer un compte utilisateur',
    PermissionsClass::userDelete()->value => 'Permet de supprimer un compte utilisateur',

    // Staff Management permissions
    PermissionsClass::staffCreate()->value => 'Permet d\'ajouter un membre du personnel',
    PermissionsClass::staffRead()->value => 'Permet de consulter la liste des membres du personnel',
    PermissionsClass::staffEdit()->value => 'Permet d\'éditer les informations d\'un membre du personnel',
    PermissionsClass::staffDelete()->value => 'Permet de supprimer un membre du personnel',

];