/**************************************************************
 * File of functions.
 * ************************************************************
 */

/**
 * chooseWordOrSentence - let use to choose his choice.
 * @return {choice} return the choix of the user.
 */
function chooseWordOrSentence() {
    let choice 
    
    do {
        choice = prompt("Avec quel liste désirez-vous jouer?: \"mots\" ou \"phrases\"")
    }
    while (choice !== "mots" && choice !== "phrases")

    return choice
}
let test
test = chooseWordOrSentence()
console.log(test)