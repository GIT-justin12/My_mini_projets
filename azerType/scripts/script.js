/**************************************************************
 * File of functions.
 * ************************************************************
 */

/**
 * printScore - Print score.
 * @param {number} number of propositions.
 * @param {number} the score of player.
 */
function printScore(score, nbProposition) {
    let spanScore = document.querySelector(".zoneScore span")
    let displayScore = `${score} / ${nbProposition}`
    spanScore.innerText =  displayScore
}

/**
 * printProposition - print the proposition  of words or sentences.
 * @param {Array} the array of proposition.
 */
function printProposition(proposition) {
    let zoneProposition = document.querySelector(".zoneProposition")
    zoneProposition.innerText = proposition
}

/**
 * validName - valid the user's name.
 * @param {string} the name of the user
 * @throws {Error}
 */
function validName(name) {
    if (name.length < 2) {
        throw new Error("Le nom est trop petit !!!")
    }
}


/**
 * validEmail - valid the user's email.
 * @param {string} the email of the user
 */
function validEmail(email) {
    let emailRegExp = new RegExp("[a-z0-9._-]+@[a-z0-9._-]+\\.[a-z0-9._-]+")
    if (!emailRegExp.test(email)) {
        throw new Error("L'email n'est pas valide !!!")
    }
}

/**
 * Cette fonction construit et affiche l'email.
 * @param {string} nom : le nom du joueur
 * @param {string} email : l'email de la personne avec qui il veut partager son score
 * @param {string} score : le score.
 */
function displayEmail(nom, email, score) {
    let mailto = `mailto:${email}?subject=Partage du score Azertype&body=Salut, je suis ${nom} et je viens de réaliser le score ${score} sur le site d'Azertype !`
    location.href = mailto
}

/**
 * diplayErrorMessage - print Error message.
 * @param {string} content the error message
 */
function diplayErrorMessage(message) {
    let spanErrorMessage = document.getElementById("errorMessage")
    if (!spanErrorMessage) {
        let popup = document.querySelector(".popup")
        let spanErrorMessage = document.createElement("span")
        spanErrorMessage.id = "errorMessage"
        popup.appendChild(spanErrorMessage)
    }
    document.getElementById("errorMessage").innerText = message
}

/**
 * manageForm - Manage form.
 * @param {string} The score of the player.
 */
function manageForm(scoreEmail) {
    try{
    let baliseNom = document.getElementById("nom")
        let nom = baliseNom.value
        validName(nom)

        let baliseEmail = document.getElementById("email")
        let email = baliseEmail.value
        validEmail(email)
        diplayErrorMessage("")
        displayEmail(nom, email, scoreEmail)
    } catch(error) {
        //Manage Error
        diplayErrorMessage(error.message)
    }
}

/**
 * startGame - Start the game.
 */
function startGame() {
    let score = 0
    let i = 0
    let listProposition = wordsList

    let btnValidatorMot = document.querySelector(".zoneSaisie button")
    let inputEcriture = document.getElementById("inputEcriture")

    printProposition(listProposition[i])
    btnValidatorMot.addEventListener("click", () => {
        console.log(inputEcriture.value)
        if (inputEcriture.value === listProposition[i]) {
            score++
        }
        i++
        printScore(score, i)
        inputEcriture.value = ""
        if (listProposition[i] === undefined) {
            printProposition("Le jeu est fini !")
            document.getElementById("btnValidatorMot").disabled = true
        } else {
            printProposition(listProposition[i])
        }
    })
    
    let listBtnRadio = document.querySelectorAll('.optionSource input')
    for (let index = 0; index < listBtnRadio.length; index++) {
        listBtnRadio[index].addEventListener("change", (event) => {
            console.log(event.target.value)
            if (event.target.value === "1") {
                listProposition = wordsList
            } else {
                listProposition = sentencesList
            }
            printProposition(listProposition[i])
        })
    }
    // Management of submit event on the sharing form
    let form = document.querySelector("form")
    form.addEventListener("submit", (event) => {
        event.preventDefault()
        let scoreEmail = `${score} / ${i}`
        manageForm(scoreEmail)
    })

    printScore(score, i)
}
