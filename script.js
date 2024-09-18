//confirmation du mot de passe
//Vérification si le mot de passe et la confirmation sont conformes

var mdp1 = document.querySelector('.mdp1');
var mdp2 = document.querySelector('.mdp2');

mdp2.onkeyup = function() 
{
    //évenement lorsqu'on écrit dans le champs : confirmation du mot de passe
    message_error = document.querySelector('.message_error');
    
    if (mdp1.value != mdp2.value)
    {
        message_error.innerText = "Les mots de passe ne sont pas identiques";
    } else {
        message_error.innerText = "";
    }

}


