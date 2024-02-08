/*------------------------------------------------------
  tiposensor --> obtenerDatosSensor() --> datos:objeto

  recibe la ID del tipo de sensor (humedad, salinidad,
  entre otros) y tras el fetch devuelve un objeto con
  el array de medidas, la medida mas reciente y el
  tipo de sensor.
-------------------------------------------------------*/
async function obtenerDatosSensor(tiposensor) {
    try {
        const url = `../../api/medidas.php?id_tipo_sensor=${tiposensor}`;
        const respuesta = await fetch(url);
        //console.log("llega despues de la peticion")

        //console.log(respuesta)
        if (!respuesta.ok) {
            throw new Error(`Error ${respuesta.status}: ${respuesta.statusText}`);
        }
        const datos = await respuesta.json();
        console.log('Datos del sensor:', datos);
        return datos;
    } catch (error) {
        console.error('Error al obtener los datos del sensor:', error);
        return  null;
    }
}
/*---------------------------------------------------------------
    datos -->                         altera el valor del
              actualizarGrafica() --> texto que muestra
   grafica -->                        la medida mas reciente
---------------------------------------------------------------*/
function actualizarGrafica(datos, grafica) {
    let medidas = datos.medidas;
    let medidaReciente = datos.valorMedidaReciente;

    grafica.data.labels = medidas.map((medida) => medida.fecha);
    grafica.data.datasets[0].data = medidas.map((medida) => medida['valor-medida']);
    grafica.update();

    // dependiendo del tipo de sensor actualizo el h1 con el valor de esta medida
    const h1ValorMedidaActual = document.getElementById('valor-medida-actual-'+datos.tipoDeSensor);
    h1ValorMedidaActual.textContent = medidaReciente;
}

async function GraficaHumedad() {
    var ctx = document.getElementById('GrafHumedad').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["14:10", "14:15", "14:20", "14:25", "14:30", "14:35", "14:40"],
            datasets: [{
                data: [80, 74, 62, 74, 94, 77, 72],
                backgroundColor: 'rgba(255, 0, 0, 0)',
                borderColor: "rgba(45,106,79,10)",
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'category',
                    time: {
                        unit: 'hour',
                        displayFormats: {
                            hour: 'HH:mm'
                        },
                        tooltipFormat: 'HH:mm'
                    }
                }],
                yAxes: [{
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        min: 0,
                        max: 100
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });

    try {
        const datos = await obtenerDatosSensor(1);
        actualizarGrafica(datos, myChart);
    } catch (error) {
        console.error('Error al obtener los datos del sensor:', error);
    }
}
async function GraficaSalinidad() {
    var ctx = document.getElementById('GraficaSalinidad').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["14:10", "14:15", "14:20", "14:25", "14:30", "14:35", "14:40"],
            datasets: [{
                data: [10, 12, 16, 13, 9, 11, 14],
                backgroundColor: 'rgba(255, 0, 0, 0)',
                borderColor: "rgba(45,106,79,10)",
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'category',
                    time: {
                        unit: 'hour',
                        displayFormats: {
                            hour: 'HH:mm'
                        },
                        tooltipFormat: 'HH:mm'
                    }
                }],
                yAxes: [{
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        min: 0,
                        max: 50
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });

    try {
        const datos = await obtenerDatosSensor(2);
        actualizarGrafica(datos, myChart);
    } catch (error) {
        console.error('Error al obtener los datos del sensor:', error);
    }
}

async function GraficaTemperatura(){
    var ctx = document.getElementById('GraficaTemperatura').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["14:10", "14:15", "14:20", "14:25", "14:30", "14:35", "14:40"],
            datasets: [{
                data: [18, 19, 20, 21, 23, 24, 25],
                backgroundColor: 'rgba(255, 0, 0, 0)',
                borderColor: "rgba(45,106,79,10)",
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'category',
                    time: {
                        unit: 'hour',
                        displayFormats: {
                            hour: 'HH:mm'
                        },
                        tooltipFormat: 'HH:mm'
                    }
                }],
                yAxes: [{
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        min: 0,
                        max: 50
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });

    try {
        const datos = await obtenerDatosSensor(3);
        actualizarGrafica(datos, myChart);
    } catch (error) {
        console.error('Error al obtener los datos del sensor:', error);
    }
}
async function GraficaLuminosidad(){
    var ctx = document.getElementById('GraficaLuminosidad').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["14:10", "14:15", "14:20", "14:25", "14:30", "14:35", "14:40"],
            datasets: [{
                data: [350, 420, 370, 450, 400, 390, 410],
                backgroundColor: 'rgba(255, 0, 0, 0)',
                borderColor: "rgba(45,106,79,10)",
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'category',
                    time: {
                        unit: 'hour',
                        displayFormats: {
                            hour: 'HH:mm'
                        },
                        tooltipFormat: 'HH:mm'
                    }
                }],
                yAxes: [{
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        min: 0,
                        max: 50 // Aquí se define el valor máximo del eje Y
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });

    try {
        const datos = await obtenerDatosSensor(4);
        actualizarGrafica(datos, myChart);
    } catch (error) {
        console.error('Error al obtener los datos del sensor:', error);
    }
}
async function GraficapH(){
    var ctx = document.getElementById('GraficapH').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["14:10", "14:15", "14:20", "14:25", "14:30", "14:35", "14:40"],
            datasets: [{
                data: [8.0, 7.4, 6.2, 7.4, 9.4, 7.7, 8.4],
                backgroundColor: 'rgba(255, 0, 0, 0)',
                borderColor: "rgba(45,106,79,10)",
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'category',
                    time: {
                        unit: 'hour',
                        displayFormats: {
                            hour: 'HH:mm'
                        },
                        tooltipFormat: 'HH:mm'
                    }
                }],
                yAxes: [{
                    type: 'linear',
                    position: 'left',
                    ticks: {
                        min: 0,
                        max: 50
                    }
                }]
            },
            legend: {
                display: false
            }
        }
    });

    try {
        const datos = await obtenerDatosSensor(5);
        actualizarGrafica(datos, myChart);
    } catch (error) {
        console.error('Error al obtener los datos del sensor:', error);
    }
}

(async () => {
    await GraficaHumedad();
    await GraficaSalinidad();
    await GraficaTemperatura();
    await GraficaLuminosidad();
    await GraficapH();
})();


