
// toast with default settings and event listener
window.addEventListener('swal:toast', event => {
  // default settings for toasts
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    background: 'white',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    }
  });

  // convert some attributes
  let config = Array.isArray(event.detail) ? event.detail[0] : event.detail;
  config = convertAttributes(config);

  // override default settings or add new settings
  Toast.fire(config);
});

function convertAttributes(attributes) {
  // convert predefined 'words' to a real color
  const colorMap = {
    danger: 'rgb(254, 226, 226)',
    error: 'rgb(254, 226, 226)',
    warning: 'rgb(255, 237, 213)',
    primary: 'rgb(207, 250, 254)',
    info: 'rgb(207, 250, 254)',
    success: 'rgb(220, 252, 231)'
  };

  if (colorMap[attributes.background]) {
    attributes.background = colorMap[attributes.background];
  }

  // if the attribute 'text' is set, convert it to the attribute 'html'
  if (attributes.text) {
    attributes.html = attributes.text;
    delete attributes.text;
  }

  return attributes;
}