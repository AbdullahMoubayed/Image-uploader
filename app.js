const inputs = document.querySelectorAll('input');

const patterns = {
  comment: /^[ a-z\d ]+$/i
};

function validate(field, regex, e) {
  if (regex.test(field.value)) {
    field.className = 'valid';
    document.querySelector(
      `#${field.attributes.name.value}-err`
    ).style.display = 'none';
  } else {
    field.className = 'invalid';
    document.querySelector(
      `#${field.attributes.name.value}-err`
    ).style.display = 'inline-block';
  }
}

inputs.forEach((input) => {
  input.addEventListener('keyup', (e) => {
    field = e.target.attributes.name.value;
    if (e.target.attributes.type !== 'submit') {
      validate(e.target, patterns[field], e);
    }
  });
});
