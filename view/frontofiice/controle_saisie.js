document.addEventListener("DOMContentLoaded", function() {
  const form = document.querySelector("form");

  form.addEventListener("submit", function(event) {
      let valid = true;
      let errorMessage = "";

      // Référence produit (id)
      const id = document.getElementById("id").value;
      if (!id) {
          valid = false;
          errorMessage += "La référence produit est obligatoire.\n";
      }

      // Type de produit (type)
      const type = document.getElementById("type").value;
      if (!type) {
          valid = false;
          errorMessage += "Le type de produit est obligatoire.\n";
      }

      // Catégorie (category)
      const category = document.getElementById("category").value;
      if (!category) {
          valid = false;
          errorMessage += "La catégorie est obligatoire.\n";
      }

      // Couleur (color)
      const color = document.getElementById("color").value;
      if (!color) {
          valid = false;
          errorMessage += "La couleur est obligatoire.\n";
      }

      // Quantité (quantity)
      const quantity = document.getElementById("quantity").value;
      const quantityNumber = Number(quantity);
      if (!quantity) {
          valid = false;
          errorMessage += "La quantité est obligatoire.\n";
      } else if (isNaN(quantityNumber) || quantityNumber <= 0) {
          valid = false;
          errorMessage += "La quantité doit être un nombre positif.\n";
      }

      if (!valid) {
          alert(errorMessage);
          event.preventDefault(); // Prevent form submission
      }
  });
});