function salutation(){
    // Récupération des boutons
    const addToCartButton = document.getElementById('add-to-cart');
    const addToFavoritesButton = document.getElementById('add-to-fav');

    // Ajout d'un écouteur d'événement sur le clic du bouton "Ajouter au panier"
    addToCartButton.addEventListener('click', (event) => {
    //const sneakerId = event.target.dataset.id;
    // Faire quelque chose avec l'ID de la sneaker, comme l'ajouter au panier
    alert(`Ajout de la sneaker avec l'ID ${sneakerId} au panier`);
    });

    // Ajout d'un écouteur d'événement sur le clic du bouton "Ajouter aux favoris"
    addToFavoritesButton.addEventListener('click', (event) => {
    const sneakerId = event.target.dataset.id;
    // Faire quelque chose avec l'ID de la sneaker, comme l'ajouter aux favoris
    alert(`Ajout de la sneaker avec l'ID ${sneakerId} aux favoris`);
    });
}