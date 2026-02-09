// Este script envía las respuestas del test al servidor, anima el sombrero y redirige al resultado.
async function enviarRespuestas(respuestas) {
  const fd = new FormData();

  // Respuestas: { 1:2, 2:4, 3:1 ... }
  for (const id in respuestas) {
    fd.append(`respuestas[${id}]`, respuestas[id]);
  }

  const resp = await fetch('index.php?view=ajax_guardar', {
    method: 'POST',
    body: fd
  });

  return resp.json();
}

document.addEventListener('DOMContentLoaded', () => {

  const enviarBtn = document.getElementById('enviarBtn');

  if (enviarBtn) {

    enviarBtn.addEventListener('click', async () => {

      const form = document.getElementById('testForm');
      const inputs = form.querySelectorAll('input[type=radio]');

      const preguntas = {};

      // Convertir q1 → id_pregunta real: 1
      inputs.forEach(i => {
        if (i.checked) {
          const idPregunta = i.name.replace("q", "");
          preguntas[idPregunta] = i.value;
        }
      });

      const numPreg = new Set(Array.from(inputs).map(i => i.name)).size;

      if (Object.keys(preguntas).length !== numPreg) {
        alert('Contesta todas las preguntas.');
        return;
      }

      const hatArea = document.getElementById('hatArea');
      const hatImg = document.getElementById('hatImg');

      hatArea.hidden = false;
      hatImg.classList.add('thinking');

      let audio;
      try {
        audio = new Audio('audio/thinking.wav');
        audio.play().catch(() => {});
      } catch(e){}

      await new Promise(r => setTimeout(r, 3000));

      const respuesta = await enviarRespuestas(preguntas);

      if (respuesta.ok) {
        if (audio) { audio.pause(); audio.currentTime = 0; }
        window.location.href = 'index.php?view=resultado&casa=' + encodeURIComponent(respuesta.casa);
      } else {
        alert('Error guardando resultado: ' + (respuesta.msg || ''));
      }

    });
  }

});
