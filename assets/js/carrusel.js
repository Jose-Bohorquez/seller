var radius = 240;
var autoRotate = true;
var rotateSpeed = -60;
var imgWidth = 290;
var imgHeight = 270;

setTimeout(init, 1000);

var odrag = document.getElementById('drag-container');
var ospin = document.getElementById('spin-container');
var aImg = ospin.getElementsByTagName('img');
var aVid = ospin.getElementsByTagName('video');
var aEle = [...aImg, ...aVid];

ospin.style.width = imgWidth + "px";
ospin.style.height = imgHeight + "px";

var ground = document.getElementById('ground');
ground.style.width = radius * 3 + "px";
ground.style.height = radius * 3 + "px";

function init(delayTime) {
    for (var i = 0; i < aEle.length; i++) {
        aEle[i].style.transform = "rotateY(" + (i * (360 / aEle.length)) + "deg) translateZ(" + radius + "px";
        aEle[i].style.transition = "transform 1s";
        aEle[i].style.transitionDelay = delayTime || (aEle.length - i) / 4 + "s";
    }

    // Obtener los parámetros de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const imagenRuta = urlParams.get('imagen');

    // Agregar la nueva oferta al carrusel si existe
    if (imagenRuta) {
        const spinContainer = document.getElementById('spin-container');

        // Crear un nuevo elemento <img> para la oferta
        const imagenOferta = document.createElement('img');
        imagenOferta.src = imagenRuta;
        imagenOferta.alt = 'Oferta';

        // Agregar la imagen al carrusel
        spinContainer.appendChild(imagenOferta);

        // Actualizar la lista de elementos del carrusel
        aImg = ospin.getElementsByTagName('img');
        aVid = ospin.getElementsByTagName('video');
        aEle = [...aImg, ...aVid];

        // Aplicar la transformación al nuevo elemento
        const nuevoIndice = aEle.length - 1; // Índice del nuevo elemento
        aEle[nuevoIndice].style.transform = "rotateY(" + (nuevoIndice * (360 / aEle.length)) + "deg) translateZ(" + radius + "px";
        aEle[nuevoIndice].style.transition = "transform 1s";
        aEle[nuevoIndice].style.transitionDelay = delayTime || (aEle.length - nuevoIndice) / 4 + "s";
    }
}

function applyTransform(obj) {
    if (tY > 180) tY = 180;
    if (tY < 0) tY = 0;

    obj.style.transform = "rotateX(" + (-tY) + "deg) rotateY(" + (tX) + "deg)";
}

function playSpin(yes) {
    ospin.style.animationPlayState = (yes ? 'running' : 'paused');
}

var sX, sY, nX, nY, desX = 0,
    desY = 0,
    tX = 0,
    tY = 10;

if (autoRotate) {
    var animationName = (rotateSpeed > 0 ? 'spin' : 'spinRevert');
    ospin.style.animation = `${animationName} ${Math.abs(rotateSpeed)}s infinite linear`;
}

document.onpointerdown = function(e) {
    clearInterval(odrag.timer);
    e = e || window.event;
    var sX = e.clientX,
        sY = e.clientY;

    this.onpointermove = function(e) {
        e = e || window.event;
        var nX = e.clientX,
            nY = e.clientY;
        desX = nX - sX;
        desY = nY - sY;
        tX += desX * 0.1;
        tY += desY * 0.1;
        applyTransform(odrag);
        sX = nX;
        sY = nY;
    };

    this.onpointerup = function(e) {
        odrag.timer = setInterval(function() {
            desX *= 0.95;
            desY *= 0.95;
            tX += desX * 0.1;
            tY += desY * 0.1;
            applyTransform(odrag);
            playSpin(false);
            if (Math.abs(desX) < 0.5 && Math.abs(desY) < 0.5) {
                clearInterval(odrag.timer);
                playSpin(true);
            }
        }, 17);
        this.onpointermove = this.onpointerup = null;
    };

    return false
};