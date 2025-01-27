/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/components/cinema/llistatPeliculaActors.ts":
/*!********************************************************!*\
  !*** ./src/components/cinema/llistatPeliculaActors.ts ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   llistatPeliculaActors: () => (/* binding */ llistatPeliculaActors)
/* harmony export */ });
var __awaiter = (undefined && undefined.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
// author book
function llistatPeliculaActors(id) {
    return __awaiter(this, void 0, void 0, function* () {
        let urlAjax = 'https://gestio.elliotfern.com/api/cinema/get/?actors-pelicula=' + id;
        try {
            // Obtener el token del localStorage
            let token = localStorage.getItem('token');
            // Realizar la solicitud fetch
            let response = yield fetch(urlAjax, {
                method: 'GET',
                headers: {
                    Accept: 'application/json',
                    Authorization: `Bearer ${token}`,
                },
            });
            if (!response.ok) {
                throw new Error('Error en la sol·licitud AJAX');
            }
            let data = yield response.json();
            let html = '';
            for (let i = 0; i < data.length; i++) {
                html += '<tr>';
                html += '<td><img src="https://media.elliotfern.com/img/cinema-actor/' + data[i].nameImg + '.jpg" alt="Descripción de la imagen" width="auto" height="150"></td>';
                html += '<td><a id="' + data[i].id + '" title="Book page" href="' + window.location.origin + '/biblioteca/llibre/' + data[i].slug + '">' + data[i].nom + ' ' + data[i].cognoms + '</a></td>';
                html += '<td>' + data[i].role + '</td>';
                html += '<td><a href="' + window.location.origin + '/biblioteca/modifica/llibre/' + data[i].id + '" class="btn btn-secondary btn-sm modificar-link">Modificar</a></td>';
                html += '<td><button type="button" onclick="btnDeleteBook(' + data[i].id + ')" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteBook" data-id="' + data[i].id + '">Elimina</button></td>';
                html += '</tr>';
            }
            // Actualizar el contenido del tbody
            const tbody = document.querySelector('#booksAuthor tbody');
            if (tbody) {
                tbody.innerHTML = html;
            }
            else {
                console.error('Elemento tbody no encontrado');
            }
        }
        catch (error) {
            console.error('Error al parsear JSON:', error); // Muestra el error de parsing
        }
    });
}


/***/ }),

/***/ "./src/components/cinema/llistatPelicules.ts":
/*!***************************************************!*\
  !*** ./src/components/cinema/llistatPelicules.ts ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   llistatPelicules: () => (/* binding */ llistatPelicules)
/* harmony export */ });
var __awaiter = (undefined && undefined.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
function llistatPelicules(tipus) {
    return __awaiter(this, void 0, void 0, function* () {
        // Si se selecciona "Tots", no pasamos ningún tipo de contacto como parámetro
        let urlAjax = '/api/cinema/get/';
        // Si 'tipus' es 10, añadir el parámetro adecuado a la URL
        if (tipus === 10) {
            urlAjax += '?pelicules';
        }
        else {
            urlAjax += '?type=generes&generes=' + tipus;
        }
        try {
            const response = yield fetch(urlAjax, {
                method: 'GET',
                headers: {
                    Accept: 'application/json',
                    Authorization: `Bearer ${localStorage.getItem('token') || ''}`,
                },
            });
            if (!response.ok) {
                throw new Error('Error en la solicitud AJAX');
            }
            const data = yield response.json();
            // Aquí puedes manejar los datos recibidos
            // Modificaciones del DOM
            let pelicules = '';
            data.forEach((pelicula) => {
                pelicules += `
      <div class="col-sm-3 col-md-3 quadre">
        <h6><span style="background-color:black;color:white;padding:5px;">${pelicula.genere_ca}</span></h6>
    
        <h3 class="links-contactes" style="margin-top: 15px;"> <a href="${window.location.origin}/cinema/fitxa-pelicula/${pelicula.id}" title="Fitxa de la pel·lícula" >${pelicula.pelicula}</a></h3>`;
                pelicules += `<p class="links-contactes autor"><strong>Director/a:</strong> <a href="${window.location.origin}/cinema/director/${pelicula.id}">${pelicula.nom} ${pelicula.cognoms}</a></p>`;
                pelicules += `<p><strong>Any: </strong> ${pelicula.any}</p>`;
                pelicules += `<p><strong>País: </strong> ${pelicula.pais_cat}</p>`;
                pelicules += `<p><strong>Idioma original: </strong> ${pelicula.idioma_ca}</p>`;
                pelicules += `
        <p><button type='button' class='btn btn-light btn-sm'>${pelicula.genere_ca}</button></p>`;
                pelicules += `
        <a href="${window.location.origin}/cinema/modifica-pelicula/${pelicula.id}" class="btn btn-secondary btn-sm modificar-link">Modificar</a>
        <button type='button' class='btn btn-dark btn-sm' onclick='eliminaContacte(${pelicula.id})'>Eliminar</button>
        </div>`;
            });
            const peliculesContainer = document.getElementById('peliculesContainer');
            if (peliculesContainer) {
                peliculesContainer.innerHTML = pelicules;
            }
        }
        catch (error) {
            console.error('Error:', error);
        }
    });
}


/***/ }),

/***/ "./src/components/lecturaDadesForm/mostrarDades/connexioApiDades.ts":
/*!**************************************************************************!*\
  !*** ./src/components/lecturaDadesForm/mostrarDades/connexioApiDades.ts ***!
  \**************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   connexioApiDades: () => (/* binding */ connexioApiDades)
/* harmony export */ });
/* harmony import */ var _utils_formataData__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../utils/formataData */ "./src/utils/formataData.ts");
/* harmony import */ var _utils_formataHtml__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../utils/formataHtml */ "./src/utils/formataHtml.ts");
var __awaiter = (undefined && undefined.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};


// FUNCIÓ PER DEMANAR PER GET INFORMACIO A LA BD I MOSTRAR-LA EN PANTALLA
/**
 * Funció per realitzar una sol·licitud GET a l'API i obtenir dades.
 * @param url - L'URL de l'API per obtenir les dades.
 * @param id - L'ID de l'element a obtenir.
 * @param urlImg1 - L'URL de la primera imatge.
 * @param urlImg2 - L'URL de la segona imatge.
 * @param callback - La funció de callback que es cridarà amb les dades obtingudes.
 */
// Función para realizar la solicitud Axios a la API
function connexioApiDades(url, id, urlImg1, urlImg2, callback) {
    return __awaiter(this, void 0, void 0, function* () {
        const urlAjax = `${url}${id}`;
        // Obtener el token del localStorage
        let token = localStorage.getItem('token');
        try {
            const response = yield fetch(urlAjax, {
                method: 'GET',
                headers: {
                    Accept: 'application/json',
                    Authorization: `Bearer ${localStorage.getItem('token') || ''}`,
                },
            });
            if (!response.ok) {
                throw new Error('Error en la sol·licitud AJAX');
            }
            const data = yield response.json();
            callback(data);
            // Asegúrate de que data sea un objeto o array adecuado
            const data2 = Array.isArray(data) ? data[0] : data;
            for (let key in data2) {
                if (data2.hasOwnProperty(key)) {
                    let value = data2[key];
                    // Buscar el elemento `<span>` con el ID correspondiente
                    const element = document.getElementById(key);
                    if (element) {
                        // Verificar que el elemento es un `<span>` antes de modificar
                        if (element.tagName === 'SPAN') {
                            // Decodificar HTML si es necesario y asignar solo el texto
                            value = (0,_utils_formataHtml__WEBPACK_IMPORTED_MODULE_1__.formataHTML)(value);
                            element.textContent = value; // Solo reemplazar el contenido del `span`
                        }
                    }
                    // Actualizar el DOM con la información recibida
                    if (key === 'nameImg') {
                        element.src = `http://media.elliotfern.com/${urlImg1}/${urlImg2}/${value}.jpg`;
                    }
                    // Casos especiales: Director/a
                    if (key === 'nom' || key === 'cognoms') {
                        const directorUrl = document.getElementById('directorUrl');
                        if (directorUrl && directorUrl.tagName === 'A') {
                            directorUrl.href = `/directors/${data2['director']}`; // Añadir la URL del director
                        }
                    }
                    // Casos especiales: País
                    if (key === 'pais_cat') {
                        const paisUrl = document.getElementById('paisUrl');
                        if (paisUrl && paisUrl.tagName === 'A') {
                            paisUrl.href = `/paisos/${data2['pais']}`; // Añadir la URL del país
                        }
                    }
                    // Formatear fechas si es necesario
                    if (key === 'dateCreated' || key === 'dateModified' || key === 'dataVista') {
                        const dateElement = document.getElementById(key);
                        if (dateElement && dateElement.tagName === 'SPAN') {
                            dateElement.textContent = (0,_utils_formataData__WEBPACK_IMPORTED_MODULE_0__.formatData)(value); // Formatear y agregar la fecha
                        }
                    }
                }
            }
            // Ejecutar la función de devolución de llamada si se proporciona
            if (typeof callback === 'function') {
                callback(data);
            }
        }
        catch (error) {
            console.error('Error al parsear JSON:', error); // Muestra el error de parsing
        }
    });
}


/***/ }),

/***/ "./src/components/lecturaDadesForm/omplirDadesForm.ts":
/*!************************************************************!*\
  !*** ./src/components/lecturaDadesForm/omplirDadesForm.ts ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   omplirDadesForm: () => (/* binding */ omplirDadesForm)
/* harmony export */ });
var __awaiter = (undefined && undefined.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
/**
 * Funció per omplir els inputs text i select de les pàgines de formularis de modificació.
 * @param url - L'URL de l'API per obtenir les dades.
 * @param id - L'ID de l'element a obtenir.
 * @param formId - L'ID del formulari HTML que s'omplirà.
 * @param callback - La funció de callback que es cridarà amb les dades obtingudes.
 */
function omplirDadesForm(url, id, formId, callback) {
    return __awaiter(this, void 0, void 0, function* () {
        const urlAjax = `${url}${id}`;
        try {
            const response = yield fetch(urlAjax, {
                method: 'GET',
                headers: {
                    Accept: 'application/json',
                    Authorization: `Bearer ${localStorage.getItem('token') || ''}`,
                },
            });
            if (!response.ok) {
                throw new Error('Error en la sol·licitud AJAX');
            }
            const data = yield response.json();
            callback(data);
            // Omplir el formulari amb les dades obtingudes
            const form = document.getElementById(formId);
            if (!form) {
                console.error(`Form with id ${formId} not found`);
                return;
            }
            Object.keys(data[0]).forEach((key) => {
                const input = form.querySelector(`[name="${key}"]`);
                if (input) {
                    input.value = data[0][key];
                }
            });
            // Carregar contingut en l'editor Trix si està present
            const trixEditor = document.querySelector('trix-editor');
            if (trixEditor) {
                const trixInput = document.querySelector('input[name="descripcio"]');
                if (trixInput) {
                    trixInput.value = data[0]['descripcio'];
                    trixEditor.editor.loadHTML(data[0]['descripcio']);
                }
            }
        }
        catch (error) {
            console.error('Error:', error);
        }
    });
}


/***/ }),

/***/ "./src/components/lecturaDadesForm/selectOmplirDades.ts":
/*!**************************************************************!*\
  !*** ./src/components/lecturaDadesForm/selectOmplirDades.ts ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   selectOmplirDades: () => (/* binding */ selectOmplirDades)
/* harmony export */ });
var __awaiter = (undefined && undefined.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
/**
 * Funció per omplir un select amb dades auxiliars.
 * @param url - L'URL de l'API per obtenir les dades auxiliars.
 * @param selectedValue - El valor seleccionat actualment.
 * @param selectId - L'ID del select HTML que s'omplirà.
 * @param valueField - El camp de les dades que s'utilitzarà com a valor del select.
 * @param textField - El camp de les dades que s'utilitzarà com a text del select.
 */
function selectOmplirDades(url, selectedValue, selectId, textField) {
    return __awaiter(this, void 0, void 0, function* () {
        try {
            const response = yield fetch(url);
            if (!response.ok) {
                throw new Error('Error en la sol·licitud AJAX');
            }
            const data = yield response.json();
            const selectElement = document.getElementById(selectId);
            if (!selectElement) {
                console.error(`Select element with id ${selectId} not found`);
                return;
            }
            // Netejar les opcions actuals
            selectElement.innerHTML = '';
            // Afegir les noves opcions
            data.forEach((item) => {
                const option = document.createElement('option');
                option.value = item.id;
                option.text = item[textField];
                if (item.id === selectedValue) {
                    option.selected = true;
                }
                selectElement.appendChild(option);
            });
        }
        catch (error) {
            console.error('Error:', error);
        }
    });
}


/***/ }),

/***/ "./src/pages/cinema/funcions.ts":
/*!**************************************!*\
  !*** ./src/pages/cinema/funcions.ts ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   cinema: () => (/* binding */ cinema)
/* harmony export */ });
/* harmony import */ var _components_lecturaDadesForm_selectOmplirDades__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../components/lecturaDadesForm/selectOmplirDades */ "./src/components/lecturaDadesForm/selectOmplirDades.ts");
/* harmony import */ var _components_lecturaDadesForm_omplirDadesForm__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../components/lecturaDadesForm/omplirDadesForm */ "./src/components/lecturaDadesForm/omplirDadesForm.ts");
/* harmony import */ var _utils_actualitzarDades__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../utils/actualitzarDades */ "./src/utils/actualitzarDades.ts");
/* harmony import */ var _components_cinema_llistatPelicules__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../components/cinema/llistatPelicules */ "./src/components/cinema/llistatPelicules.ts");
/* harmony import */ var _components_lecturaDadesForm_mostrarDades_connexioApiDades__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../components/lecturaDadesForm/mostrarDades/connexioApiDades */ "./src/components/lecturaDadesForm/mostrarDades/connexioApiDades.ts");
/* harmony import */ var _components_cinema_llistatPeliculaActors__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../components/cinema/llistatPeliculaActors */ "./src/components/cinema/llistatPeliculaActors.ts");






function cinema() {
    // Verificar la URL y llamar a las funciones correspondientes
    const normalizedPath = window.location.pathname.replace(/\/$/, '');
    const pathArray = normalizedPath.split('/');
    const pageType = pathArray[pathArray.length - 2];
    const idElement = Number(pathArray[pathArray.length - 1]);
    console.log(pathArray);
    if (pageType === 'modifica-pelicula') {
        // Inicialitzar l'editor Trix
        (0,_components_lecturaDadesForm_omplirDadesForm__WEBPACK_IMPORTED_MODULE_1__.omplirDadesForm)('/api/cinema/get/?pelicula=', idElement, 'peli', function (data) {
            (0,_components_lecturaDadesForm_selectOmplirDades__WEBPACK_IMPORTED_MODULE_0__.selectOmplirDades)('/api/auxiliars/get/?type=directors', data[0].director, 'director', 'nomComplet');
            (0,_components_lecturaDadesForm_selectOmplirDades__WEBPACK_IMPORTED_MODULE_0__.selectOmplirDades)('/api/auxiliars/get/?type=imgPelis', data[0].img, 'img', 'alt');
            (0,_components_lecturaDadesForm_selectOmplirDades__WEBPACK_IMPORTED_MODULE_0__.selectOmplirDades)('/api/auxiliars/get/?type=generesPelis', data[0].genere, 'genere', 'genere_ca');
            (0,_components_lecturaDadesForm_selectOmplirDades__WEBPACK_IMPORTED_MODULE_0__.selectOmplirDades)('/api/auxiliars/get/?type=llengues', data[0].lang, 'lang', 'idioma_ca');
            (0,_components_lecturaDadesForm_selectOmplirDades__WEBPACK_IMPORTED_MODULE_0__.selectOmplirDades)('/api/auxiliars/get/?type=paisos', data[0].pais, 'pais', 'pais_cat');
        });
        const peli = document.getElementById('peli');
        if (peli) {
            peli.addEventListener('submit', function (event) {
                (0,_utils_actualitzarDades__WEBPACK_IMPORTED_MODULE_2__.formulariActualitzar)(event, 'peli', '/api/cinema/put/?type=pelicula');
            });
        }
    }
    else if (pageType === 'pelicules') {
        (0,_components_cinema_llistatPelicules__WEBPACK_IMPORTED_MODULE_3__.llistatPelicules)(10); // Pasar 10 como parámetro para mostrar todas las películas al cargar la página
        // Manejar clic en los botones de tipo de contacto
        document.querySelectorAll('button[data-tipus]').forEach((button) => {
            button.addEventListener('click', (event) => {
                const target = event.target;
                const tipus = target.getAttribute('data-tipus');
                if (tipus) {
                    (0,_components_cinema_llistatPelicules__WEBPACK_IMPORTED_MODULE_3__.llistatPelicules)(Number(tipus));
                    // Remover la clase 'active' de todos los botones
                    document.querySelectorAll('button[data-tipus]').forEach((btn) => {
                        btn.classList.remove('active');
                    });
                    // Agregar la clase 'active' solo al botón clicado
                    target.classList.add('active');
                }
            });
        });
    }
    else if (pageType === 'fitxa-pelicula') {
        (0,_components_lecturaDadesForm_mostrarDades_connexioApiDades__WEBPACK_IMPORTED_MODULE_4__.connexioApiDades)('/api/cinema/get/?pelicula=', idElement, 'img', 'cinema-movie', function (data) {
            // Actualiza el atributo href del enlace con el idDirector
            const directorUrl = document.getElementById('directorUrl');
            const paisUrl = document.getElementById('paisUrl');
            if (directorUrl) {
                directorUrl.href = `${window.location.origin}/cinema/director/${data[0].director}`;
            }
            if (paisUrl) {
                paisUrl.href = `${window.location.origin}/cinema/pelicules/pais/${data[0].pais}`;
            }
            // author book
            (0,_components_cinema_llistatPeliculaActors__WEBPACK_IMPORTED_MODULE_5__.llistatPeliculaActors)(data[0].id);
        });
    }
}


/***/ }),

/***/ "./src/utils/actualitzarDades.ts":
/*!***************************************!*\
  !*** ./src/utils/actualitzarDades.ts ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   formulariActualitzar: () => (/* binding */ formulariActualitzar)
/* harmony export */ });
var __awaiter = (undefined && undefined.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
// AJAX PROCESS > PHP API : PER ACTUALIZAR FORMULARIS A LA BD
function formulariActualitzar(event, formId, urlAjax) {
    return __awaiter(this, void 0, void 0, function* () {
        event.preventDefault();
        const form = document.getElementById(formId);
        if (!form) {
            console.error(`Form with id ${formId} not found`);
            return;
        }
        // Crear un objeto para almacenar los datos del formulario
        const formData = {};
        new FormData(form).forEach((value, key) => {
            formData[key] = value; // Agregar cada campo al objeto formData
        });
        const jsonData = JSON.stringify(formData);
        const token = localStorage.getItem('token');
        if (!token) {
            console.error('Token not found in localStorage');
            return;
        }
        try {
            const response = yield fetch(urlAjax, {
                method: 'PUT',
                headers: {
                    Accept: 'application/json',
                    Authorization: `Bearer ${token}`,
                },
                body: jsonData,
            });
            if (!response.ok) {
                throw new Error('Error en la sol·licitud AJAX');
            }
            const data = yield response.json();
            // Aquí pots afegir el codi per gestionar la resposta
            const missatgeOk = document.getElementById('missatgeOk');
            const missatgeErr = document.getElementById('missatgeErr');
            if (data.status === 'success') {
                if (missatgeOk && missatgeErr) {
                    missatgeOk.style.display = 'block';
                    missatgeErr.style.display = 'none';
                }
            }
            else {
                if (missatgeOk && missatgeErr) {
                    missatgeErr.style.display = 'block';
                    missatgeOk.style.display = 'none';
                }
            }
        }
        catch (error) {
            const missatgeOk = document.getElementById('missatgeOk');
            const missatgeErr = document.getElementById('missatgeErr');
            if (missatgeOk && missatgeErr) {
                console.error('Error:', error);
                missatgeErr.style.display = 'block';
                missatgeOk.style.display = 'none';
            }
        }
    });
}


/***/ }),

/***/ "./src/utils/formataData.ts":
/*!**********************************!*\
  !*** ./src/utils/formataData.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   formatData: () => (/* binding */ formatData)
/* harmony export */ });
function formatData(inputDate) {
    // Analizar la fecha en formato 'YYYY-MM-DD HH:mm:ss'
    const date = new Date(inputDate);
    // Extraer los componentes de la fecha
    const day = String(date.getDate()).padStart(2, '0');
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const year = date.getFullYear();
    // Formatear la fecha en formato 'DD-MM-YYYY'
    const formattedDate = `${day}-${month}-${year}`;
    return formattedDate;
}


/***/ }),

/***/ "./src/utils/formataHtml.ts":
/*!**********************************!*\
  !*** ./src/utils/formataHtml.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   formataHTML: () => (/* binding */ formataHTML)
/* harmony export */ });
function formataHTML(texto) {
    var temp = document.createElement('div');
    temp.innerHTML = texto;
    return temp.textContent || temp.innerText || '';
}


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!*********************!*\
  !*** ./src/main.ts ***!
  \*********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _pages_cinema_funcions__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./pages/cinema/funcions */ "./src/pages/cinema/funcions.ts");

document.addEventListener('DOMContentLoaded', () => {
    // Verificar la URL y llamar a las funciones correspondientes
    const normalizedPath = window.location.pathname.replace(/\/$/, '');
    const pathArray = normalizedPath.split('/');
    const pageType = pathArray[pathArray.length - 3]; // Obtenemos el nombre de la página
    if (pageType === 'cinema') {
        (0,_pages_cinema_funcions__WEBPACK_IMPORTED_MODULE_0__.cinema)();
    }
});
// AJAX PROCESS > PHP API : PER INSERIR FORMULARIS A LA BD
/*
function formulariInserir(event, formId, urlAjax) {
  // Stop form from submitting normally
  event.preventDefault();
  let formData = $('#' + formId).serialize();

  $.ajax({
    type: 'POST',
    url: urlAjax,
    dataType: 'json',
    beforeSend: function (xhr) {
      // Obtener el token del localStorage
      let token = localStorage.getItem('token');

      // Incluir el token en el encabezado de autorización
      xhr.setRequestHeader('Authorization', 'Bearer ' + token);
    },
    data: formData,
    success: function (response) {
      if (response.status == 'success') {
        // Add response in Modal body
        $('#creaOk').show();
        $('#creaErr').hide();
      } else {
        $('#creaErr').show();
        $('#creaOk').hide();
      }
    },
  });
}
*/

})();

/******/ })()
;
//# sourceMappingURL=bundle.js.map