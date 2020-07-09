/**
 * Shuffle children node elements of a node parent
 *
 * @param parent Node element of the parent
 * @param elements Node elements of the children
 */
function shuffle(parent, elements) {
    for (let i = 0; i < elements.length; i++) {
        let randomNumber = Math.round(Math.random() * i);
        let randomElement = elements[randomNumber];
        parent.appendChild(randomElement);
    }
}
