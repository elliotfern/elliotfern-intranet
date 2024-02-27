// AJAX PROCESS > PHP - MODAL FORM - UPDATE FORM
$(function () {
  $("#botoSave").click(function () {
    // check values
    $(".show_conversation2").hide();

    // Stop form from submitting normally
    event.preventDefault();

    $.ajax({
      type: "POST",
      url: "./php-process/book-update-process-form.php",
      data: {
        nomAutor: $("#nomAutor").val(),
        titol: $("#titol").val(),
        titolEng: $("#titolEng").val(),
        any: $("#any").val(),
        idEd: $("#idEd").val(),
        idGen: $("#idGen").val(),
        lang: $("#lang").val(),
        img: $("#img").val(),
        tipus: $("#tipus").val(),
        idBook: $("#idBook").val(),
      },
      success: function (response) {
        if (response.status == "success") {
          // Add response in Modal body
          $(".show_conversation").show();
          $("#booksTable").DataTable().ajax.reload();
          $("#modalFormDelete").hide();
          $("#modalFormBook").hide();
          $("#botoSave").hide();
        } else {
          $(".show_conversation2").show();
          $(".show_conversation").hide();
        }
      },
    });
  });
});



// UPLOAD IMAGE FORM
function divUploadImg(idType) {
  var idType = idType;
  $.ajax({
    url: "./forms/img-add.php", //the page containing php script
    type: "post", //request type,
    data: {
      image: "yes",
      idType: idType,
    },
    success: function (response) {
      // Add response in Modal body
      $("#uploadImg").html(response);
      $("#uploadImg").show();
    },
  });
}

// ADD PUBLISHER FORM
function divCreatePublisher() {
  $.ajax({
    url: "./forms/publisher-add.php", //the page containing php script
    type: "post", //request type,
    data: {
      publisherForm: "yes",
    },
    success: function (response) {
      // Add response in Modal body
      $("#createPublisher").html(response);
      $("#createPublisher").show();
    },
  });
}

// ADD A SECOND AUTHOR TO A BOOK
function divAnotherAuthor(idBook) {
  var idBook = idBook;
  $.ajax({
    url: "./forms/author-second-add.php", //the page containing php script
    type: "post", //request type,
    data: {
      image: "yes",
      idBook: idBook,
    },
    success: function (response) {
      // Add response in Modal body
      $("#addAnotherAuthor").html(response);
      $("#addAnotherAuthor").show();
    },
  });
}

// ADD A NEW COLLECTION TO A BOOK
function addCollectionBook(idBook) {
  var idBook = idBook;
  $.ajax({
    url: "./forms/book-collection-add.php", //the page containing php script
    type: "post", //request type,
    data: {
      bookCollection: "yes",
      idBook: idBook,
    },
    success: function (response) {
      // Add response in Modal body
      $("#bookCollection").html(response);
      $("#bookCollection").show();
    },
  });
}

// AJAX PROCESS > PHP - MODAL FORM - ADD NEW COLLECTION TO BOOK
$(function () {
  $("#btnAddCollectionBook").click(function () {
    // check values
    $("#addCollectionBookMessageErr").hide();

    // Stop form from submitting normally
    event.preventDefault();

    $.ajax({
      type: "POST",
      url: "./php-process/book-collection-insert-process-form.php",
      data: {
        ordre: $("#ordre").val(),
        idCollection: $("#idCollection").val(),
        idBook: $("#idBook").val(),
      },
      success: function (response) {
        if (response.status == "success") {
          // Add response in Modal body
          $("#addCollectionBookMessageOk").show();
          $("#addCollectionBookMessageErr").hide();
          $("#addCollectionBookForm").hide();
          $("#btnAddCollectionBook").hide();
          $("#booksTable").DataTable().ajax.reload();
        } else {
          $("#addCollectionBookMessageErr").show();
          $("#addCollectionBookMessageOk").hide();
        }
      },
    });
  });
});

// ADD A NEW COLLECTION
function divCreateNewCollection() {
  var idBook = idBook;
  $.ajax({
    url: "./forms/book-create-collection-add.php", //the page containing php script
    type: "post", //request type,
    data: {
      bookCollection: "yes",
    },
    success: function (response) {
      // Add response in Modal body
      $("#createNewCollection").html(response);
      $("#createNewCollection").show();
    },
  });
}


// AUTHOR NEW FORM 
function formProfessionAuthor(AutOcupacio) {
  let urlAjax = devDirectory + "/api/library/profession/profession";
  $.ajax({
    url: urlAjax,
    method: "GET",
    dataType: "json",
    beforeSend: function (xhr) {
      let token = localStorage.getItem('token');
      xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    },
    success: function (data) {
      try {
        const select = document.getElementById('ocupacio');
        select.innerHTML = '';  // Limpiar el contenido previo

        // Agregar el primer option como marcador de posición
        const placeholderOption = document.createElement('option');
        placeholderOption.value = '';
        placeholderOption.textContent = 'Select an option:';
        select.appendChild(placeholderOption);

        if (Array.isArray(data) && data.length > 0) {
          data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name;
            select.appendChild(option);
          });

          // Seleccionar la opción por valor (topicId)
          if (AutOcupacio) {
            select.value = AutOcupacio;
          }

        } else {
          console.error('Error: La estructura de datos no es válida.');
        }

      } catch (error) {
        console.error('Error al parsear JSON:', error);
      }
    }
  });
}

function formMovimentAuthor(idMovement) {
  let urlAjax = devDirectory + "/api/library/movement/movement";
  $.ajax({
    url: urlAjax,
    method: "GET",
    dataType: "json",
    beforeSend: function (xhr) {
      let token = localStorage.getItem('token');
      xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    },
    success: function (data) {
      try {
        const select = document.getElementById('moviment');
        select.innerHTML = '';  // Limpiar el contenido previo

        // Agregar el primer option como marcador de posición
        const placeholderOption = document.createElement('option');
        placeholderOption.value = '';
        placeholderOption.textContent = 'Select an option:';
        select.appendChild(placeholderOption);

        if (Array.isArray(data) && data.length > 0) {
          data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.movement;
            select.appendChild(option);
          });

          if (idMovement) {
            select.value = idMovement;
          }

        } else {
          console.error('Error: La estructura de datos no es válida.');
        }

      } catch (error) {
        console.error('Error al parsear JSON:', error);
      }
    }
  });
}

function formCountry(idPais) {
  let urlAjax = devDirectory + "/api/places/country";
  $.ajax({
    url: urlAjax,
    method: "GET",
    dataType: "json",
    beforeSend: function (xhr) {
      let token = localStorage.getItem('token');
      xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    },
    success: function (data) {
      try {
        const select = document.getElementById('paisAutor');
        select.innerHTML = '';  // Limpiar el contenido previo

        // Agregar el primer option como marcador de posición
        const placeholderOption = document.createElement('option');
        placeholderOption.value = '';
        placeholderOption.textContent = 'Select an option:';
        select.appendChild(placeholderOption);

        if (Array.isArray(data) && data.length > 0) {
          data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.country;
            select.appendChild(option);
          });

          if (idPais) {
            select.value = idPais;
          }

        } else {
          console.error('Error: La estructura de datos no es válida.');
        }

      } catch (error) {
        console.error('Error al parsear JSON:', error);
      }
    }
  });
}

function formImageAuthor(idImg) {
  let urlAjax = devDirectory + "/api/biblioteca/get/?imageAuthor";
  $.ajax({
    url: urlAjax,
    method: "GET",
    dataType: "json",
    beforeSend: function (xhr) {
      let token = localStorage.getItem('token');
      xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    },
    success: function (data) {
      try {
        const select = document.getElementById('img');
        select.innerHTML = '';  // Limpiar el contenido previo

        // Agregar el primer option como marcador de posición
        const placeholderOption = document.createElement('option');
        placeholderOption.value = '';
        placeholderOption.textContent = 'Select an option:';
        select.appendChild(placeholderOption);

        if (Array.isArray(data) && data.length > 0) {
          data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.alt;
            select.appendChild(option);
          });

          if (idImg) {
            select.value = idImg;
          }

        } else {
          console.error('Error: La estructura de datos no es válida.');
        }

      } catch (error) {
        console.error('Error al parsear JSON:', error);
      }
    }
  });
}


function inserirLlibre() {
  window.location.href = '/biblioteca/nou/llibre';
}

function inserirAutor() {
  window.location.href = '/biblioteca/nou/autor';
}