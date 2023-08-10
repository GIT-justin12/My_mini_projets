/**************************************************************
 * File of functions.
 * ************************************************************
 */

/**
 * chooseWordOrSentence - let use to choose his choice.
 * @return {string} return the choix of the player.
 */
function chooseWordOrSentence() {
    let choice 

    do {
        choice = prompt("Avec quel liste désirez-vous jouer?: \"mot\" ou \"phrase\"")
    }
    while (choice !== "mot" && choice !== "phrase")

    return choice
}

/**
 * startLoop - start a loop of preposition according to choice and increment a score.
 * @param {Array[string]} list of proposition.
 * @return {number} the score of the player.
 */
function startLoop(propositionList) {
    let score = 0
    for (let i = 0; i < propositionList.length; i++) {
        let userProposition = prompt("Saisir: "+ propositionList[i]);
        if (propositionList[i] === userProposition) {
            score++
        }
    }
    return score
}

/**
 * printScore - Print score.
 * @param {number} number of propositions.
 * @param {number} the score of player.
 */
function printScore(score, nbProposition) {
    console.log("Votre score: " + score + " sur " + nbProposition + " propositions.")
}

/**
 * startGame - Start the game.
 */
function startGame() {
    let choice =  chooseWordOrSentence()
    let score = 0
    let mode = 0
    let nbProposition = 0

    if (choice === "mot") {
        score = startLoop(wordsList)
        nbProposition = wordsList.length
    } else {
        mode = 1
        score = startLoop(sentencesList)
        nbProposition = sentencesList.length
    }

    printScore(score, nbProposition)
}
